<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'numDoc' => ['required', 'unique:clientes'],

            //
        ];
    }

    public function messages(): array
    {
        return [
            'numDoc.required' => 'Se requiere del número de documento',
            'numDoc.unique' => 'Ya existe un cliente con el mismo número de documento',
        ];
    }
}
