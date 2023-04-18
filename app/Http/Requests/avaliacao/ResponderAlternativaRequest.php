<?php

namespace App\Http\Requests\avaliacao;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResponderAlternativaRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'id_questao_avaliacao' => 'required',
            'id_avaliacao' => 'required',
            'alternativa' => 'required',
        ];
    }

    public function messages()
    {
        return [
                'id_questao_avaliacao.required' => 'Campo obrigatório',
                'id_avaliacao.required' => 'Campo obrigatório',
                'alternativa.required' => 'Campo obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       throw new HttpResponseException (response()->json(["success" => false, 'message' => $validator->errors() ], 400));
    }
}
