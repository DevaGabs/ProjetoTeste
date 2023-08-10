<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class CompanyRequest extends FormRequest
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
            'name' => 'required',
            'cnpj' => [
                'required',
                'unique:companies',
                'digits:14',
            ],
            'representantive_user' => 'required',
            'email' => [
                'required',
                'email',
                'unique:companies'
            ],
            'city_id' => [
                'required',
                'exists:cities,id'
            ],
            'state_id' => [
                'required',
                'exists:states,id'
            ],
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
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
            'whatsapp_phone' => [
                'required',
                'digits:11'
                // 'nullable', 'regex:/^[\d\+\(\)\-]+$/'
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da empresa é um campo obrigatório!',

            'representantive_user.required' => 'O representante é um campo obrigatório!',

            'cnpj.required' => 'O CNPJ da empresa é um campo obrigatório!',
            'cnpj.unique' => 'O CNPJ informado já possui cadastrado!',
            'cnpj.digits' => 'O CNPJ deve ser informado um total de 14 dígitos!',

            'email.required' => 'O email da empresa é um campo obrigatório!',
            'email.email' => 'O email informado é inválido!',
            'email.unique' => 'O email informado já possui cadastrado!',

            'city_id.required' => 'A cidade é um campo obrigatório!',
            'city_id.exists' => 'A cidade informada é inválida!',

            'state_id.required' => 'O Estado(UF) é um campo obrigatório!',
            'state_id.exists' => 'O Estado(UF) informado é inválido!',

            'latitude.required' => 'A latitude é um campo obrigatório!',
            'latitude.numeric' => 'A latitude deve ser um valor númerico!',
            'latitude.between' => 'A latitude deve estar entre -90 e 90!',

            'longitude.required' => 'A longitude é um campo obrigatório!',
            'longitude.numeric' => 'A longitude deve ser um valor númerico!',
            'longitude.between' => 'A longitude deve estar entre -180 e 180!',

            // 'whatsapp_phone.regex' => 'O campo telefone deve conter apenas números e os sinais + ( ) -',
            'whatsapp_phone.required' => 'O whatsapp é um campo obrigatório',
            'whatsapp_phone.digits' => 'O campo whatsapp deve ser informado uma quantidade de 11 caracteres (DD + Número de Telefone).',

            'category_id.required' => 'A categoria é um campo obrigatório!',
            'category_id.exists' => 'A categoria informada é inválida!',
        ];
    }
}
