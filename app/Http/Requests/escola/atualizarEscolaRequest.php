<?php

namespace App\Http\Requests\escola;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class atualizarEscolaRequest extends FormRequest
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
            'cod_inep' => ['numeric',
                Rule::unique('escola')->ignore(request('id_escola'))],
            'nome' => ['required', 'string', 'min:3', 'max:80'],
            'email' => [ 'email',
                Rule::unique('escola')->ignore(request('id_escola'))],
            'telefone' => [ 'digits:11'],
            'endereco' => [ 'string', 'max:255'],
            'cre' => ['string'],
            'id_municipio' => ['required'],
            'uf' => ['required'],
        ];
    }
    public function messages()
    {
        return ['required' => 'Campo obrigatório!',
            'cod_inep.unique' => 'Já existe uma escola cadastrada com esse código!',
            'email.unique' => 'Já existe uma escola cadastrada com esse email!',];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["success" => false, 'message' => $validator->errors()], 400));
    }
}
