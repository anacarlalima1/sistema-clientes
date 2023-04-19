<?php

namespace App\Http\Requests\user;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class adicionarUserRequest extends FormRequest
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
            'nome_social' => 'required|string|max:255',
            'cpf' =>'required|unique:user'
        ];
    }
    public function messages()
    {
        return ['required' => 'Campo obrigatório!',
            'cpf.unique' => 'Esse CPF já foi cadastrado!',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (response()->json(["success" => false, 'message' => $validator->errors() ], 400));
    }
}
