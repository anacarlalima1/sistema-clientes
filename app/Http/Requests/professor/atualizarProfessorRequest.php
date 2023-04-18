<?php

namespace App\Http\Requests\professor;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class atualizarProfessorRequest extends FormRequest
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
            'email' => [Rule::unique('user', 'email')->ignore($this['id_user'])],
            'matricula' => [Rule::unique('user', 'matricula')->ignore($this['id_user'])],
            'password' => 'max:255|confirmed',
//            'password_confirmation' => ''
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo obrigatório!',
            'email' => 'Informe um endereço de email válido!',
            'max' => 'Número de caracteres atingido!',
            'email.unique' => 'Esse email já foi cadastrado!',
            'password.confirmed' => 'As senhas não coincidem!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (response()->json(["success" => false, 'message' => $validator->errors()], 400));
    }
}

