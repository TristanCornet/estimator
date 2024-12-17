<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpsertEstimateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $name = Str::slug("Nom du projet");
        $stack = Str::slug("Stack technique");
        $design = Str::slug("Type de design");
        $generics = Str::slug("Développements génériques");
        $additional = Str::slug("Développements supplémentaires");

        return [
            $name => 'required|string',
            $stack => 'required|array',
            $design => 'required|array',
            $generics => 'array|required_without:' . $additional,
            $additional => 'array|required_without:' . $generics,
        ];
    }

    public function messages(): array
    {
        $name = Str::slug("Nom du projet");
        $generics = Str::slug("Développements génériques");
        $additional = Str::slug("Développements supplémentaires");

        return [
            $name . '.required' => 'Le nom de projet ne doit pas être vide.',
            $generics . '.required_without' => 'Au moins un développement générique (ou spécifique) est requis.',
            $additional . '.required_without' => 'Au moins un développement spécifique (ou générique) est requis.',
        ];
    }
}
