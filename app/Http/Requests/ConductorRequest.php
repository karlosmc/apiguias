<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConductorRequest extends FormRequest
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
            'nroDoc' => ['required', 'unique:conductores'],
            'licencia'=>['required', 'unique:conductores'],

            //
        ];
    }

    public function messages(): array
    {
        return [
            'nroDoc.required' => 'Se requiere del número de documento',
            'nroDoc.unique' => 'Ya existe un conductor con el mismo número de documento',
            'licencia.required' => 'Se requiere del número de licencia',
            'licencia.unique' => 'Ya existe un conductor con el mismo número de licencia',
        ];
    }
}
