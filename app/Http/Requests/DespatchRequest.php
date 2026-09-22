<?php

namespace App\Http\Requests;

use App\Models\Scop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DespatchRequest extends FormRequest
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
     * Deja `scops` siempre como una lista limpia de números, venga como lista
     * de textos, lista de objetos {nroScop} o como un `nroScop` suelto.
     */
    protected function prepareForValidation()
    {
        if ($this->has('scops') || $this->has('nroScop')) {
            $this->merge([
                'scops' => Scop::normalizar($this->input('scops', $this->input('nroScop'))),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'serie'       => 'required|string',
            'correlativo' => [
                'required',
                Rule::unique('despatches')->where(function ($query) {
                    return $query->where('serie', $this->serie);
                }),
            ],
            // Una guía puede no traer ninguno o traer varios; lo único que se
            // exige es que cada número esté libre.
            'scops'       => ['sometimes', 'array'],
            'scops.*'     => ['string', 'max:50', 'distinct', Scop::reglaLibre()],

        ];
    }

    public function messages(): array
    {
        return [
            'correlativo.unique' => 'Ya existe un despacho con esta serie y correlativo.',
            'scops.*.unique' => 'El número de SCOP :input ya está usado en otra guía.',
            'scops.*.distinct' => 'El número de SCOP :input está repetido en esta guía.',
        ];
    }
}
