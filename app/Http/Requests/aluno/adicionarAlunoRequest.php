<?php

namespace App\Http\Requests\aluno;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class adicionarAlunoRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'email' => 'email|max:100|unique:user',
            'matricula' => 'unique:user',
            'password' => 'max:255|confirmed',
        ];
    }
    public function messages()
    {
        return ['required' => 'Campo obrigatório!',
            'email' => 'Informe um endereço de email válido!',
            'email.unique' => 'Esse email já foi cadastrado!',
            'matricula.unique' => 'Já existe um professor cadastrado com essa matrícula!',
            'password.confirmed' => 'As senhas não coincidem!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (response()->json(["success" => false, 'message' => $validator->errors() ], 400));
    }
}
