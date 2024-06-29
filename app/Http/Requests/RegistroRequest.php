<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
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
            //
            'name' => ['required','string'],
            'email' => ['required','email'],
            'documento'=>['required','unique:users,documento'],
            'password' => [
                'required',
                PasswordRules::min(8),
            ],
            'id_empresa'=>['required']
        ];
    }
}
