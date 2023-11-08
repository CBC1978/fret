<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class formCar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'registration' => 'required|string',
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'string',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'registration.required' => 'L\'immatriculation duc camion est requise',
            'type.required' => 'Le type du camion est requis',
            'brand.required' => 'La marque du camion est requise',
        ];
    }
}
