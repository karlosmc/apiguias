<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'documento'=>['required','exists:users,documento'],
            'password' =>['required'],
            'id_empresa' =>['required']
            //
        ];
    }
    public function messages()
    {
        return [
            'documento.required'=>'El documento es obligatorio',
            'documento.exists'=>'El documento no está registrado',
            'password.required'=>'El password es obligatorio',
            'id_empresa.required'=>'La empresa es obligatoria'
        ];
    }
}
