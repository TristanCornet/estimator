<?php

namespace App\Http\Controllers;

use App\Models\EstimateField;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstimateFieldController extends Controller
{
    /**
     * Get all the fields and load the values.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return EstimateField::with('values')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(["name" => "POST /api/fields : Création d'un champ pour l'estimation."]);
    }

    /**
     * Get the specified field and load the values.
     *
     * @param EstimateField $field
     * @return EstimateField
     */
    public function show(EstimateField $field): EstimateField
    {
        return $field->load('values');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json(["name" => "PUT|PATCH /api/fields/{field} : Mise à jour d'un champ pour l'estimation."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(["name" => "DELETE /api/fields/{field} : Suppression d'un champ pour l'estimation."]);
    }
}
