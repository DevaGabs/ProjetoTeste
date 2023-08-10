<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class StateCitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90'
            ],
            'longitude' => [
                'required',
                'numeric',
                'between:-180,180'
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'latitude.required' => 'A latitude da cidade é um campo obrigatório!',
            'latitude.numeric' => 'A latitude da cidade deve ser um valor númerico!',
            'latitude.between' => 'A latitude da cidade deve estar entre -90 e 90!',
            'longitude.required' => 'A longitude da cidade é um campo obrigatório!',
            'longitude.numeric' => 'A longitude da cidade deve ser um valor númerico!',
            'longitude.between' => 'A longitude da cidade deve estar entre -180 e 180!',
        ];
    }
}
