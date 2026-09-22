<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class NumeracionRequest extends FormRequest
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
            'serie' => ['required', 'unique:numeracion'],

            //
        ];
    }

    public function messages(): array
    {
        $inputValue = $this->input('serie');
        return [
            'serie.required' => 'Debe escribir una serie TXXX',
            'serie.unique' => "La serie $inputValue ya está siendo utilizada"
            
        ];
    }

    
}
