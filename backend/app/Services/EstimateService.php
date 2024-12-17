<?php

namespace App\Services;

use App\Models\Estimate;
use App\Models\EstimateField;
use Illuminate\Support\Facades\Log;

class EstimateService
{
    /**
     * Sum the values of the given keys in the given array.
     *
     * @param array $array
     * @param array $keys
     * @return float|int
     */
    private function sum(array $array, array $keys): float|int
    {
        return array_reduce($array, function ($itemsSum, $item) use ($keys) {
            return $itemsSum + array_reduce($keys, function ($keysSum, $key) use ($item) {
                    return $keysSum + ($item[$key] ?? 0);
                }, 0);
        }, 0);
    }

    /**
     * Create line with the given data.
     *
     * @param array $data
     * @param $type
     * @return array
     */
    private function createLines(array $data, $type): array
    {
        return array_map(function ($element) use ($type) {
            return [
                'label' => $element['label'],
                'time' => $element['time'],
                'type' => $type
            ];
        }, $data);
    }

    /**
     * @param $form
     * @return Estimate
     */
    public function create($form): Estimate
    {
        $lines = [];
        $fields = EstimateField::all();
        $specifications = [];
        $generics = [];
        $additional = [];

        // Iterate over the fields to create the lines and hydrate the variables.
        foreach ($fields as $field)
        {
            // The type of the field is used to determine how to handle it.
            switch($field->type)
            {
                case 'Name':
                    // The name is the only field that is not an array/object.
                    $name = $form[$field->slug];
                    break;
                case 'Specification':
                    $value = $form[$field->slug];
                    // The name is added to the value to be able to display it in the line.
                    $value['name'] = $field->name;
                    $specifications[] = $value;
                    // The line is not created here because it requires the total time.
                    break;
                case 'Generic':
                    // The result is an array of arrays, so we need to flatten it.
                    $values = array_values($form[$field->slug]);
                    $generics = array_merge($generics, $values);
                    // The lines are created for each value.
                    $lines = array_merge($lines, $this->createLines($values, $field->type));
                    break;
                case 'Additional':
                    // The result is an array of arrays, so we need to flatten it.
                    $values = array_values($form[$field->slug]);
                    $additional = array_merge($additional, $values);
                    // The lines are created for each value.
                    $lines = array_merge($lines, $this->createLines($additional, $field->type));
                    break;
                default:
                    Log::error('Type de champs inconnu: ' . $field->type);
            }
        }
        // The arrays are merged to be able to sum the values.
        $dataset = array_merge($specifications, $generics, $additional);

        // The startup time is calculated by summing the values of the startup_time key.
        $startup = $this->sum($dataset, ['startup_time']);

        // The startup line is created.
        $lines[] = [
            'label' => 'Mise en place du projet',
            'time' => $startup,
            'type' => 'Startup'
        ];

        // The total time is calculated by summing the values of the time key.
        $total = $this->sum($dataset, ['time']) + $startup;

        // The percentage is calculated by summing the values of the total_percentage key.
        $percentage = $this->sum($dataset, ['total_percentage']);

        // The lines are created for each specification.
        $lines = array_merge($lines, array_map(function ($specification) use ($total) {
            return [
                'label' => $specification['name'] . ' : ' . $specification['label'],
                'time' => $total * $specification['total_percentage'] / 100,
                'type' => 'Specification'
            ];
        }, $specifications));

        // The total time is updated with the percentage.
        $total = $total + ($total * $percentage / 100);

        // The estimate is created in the database.
        $estimate = Estimate::create([
            'name' => $name,
            'total_time' => $total,
        ]);

        // The lines are created in the database.
        $estimate->lines()->createMany($lines);

        // The estimate is returned.
        return $estimate;
    }

}
