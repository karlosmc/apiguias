<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'placa' => ['required', 'unique:vehiculos'],
            // Sin regla `boolean` a propósito: el front puede mandar "true"/"false"
            // como texto. El controlador los normaliza con filter_var.
            'tracto' => ['sometimes', 'nullable'],
            'glp' => ['sometimes', 'nullable'],

            //
        ];
    }

    public function messages(): array
    {
        return [
            'numDoc.required' => 'Se requiere del número de placa',
            'numDoc.unique' => 'Ya existe una placa registrada',
        ];
    }
}
