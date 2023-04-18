<?php

namespace App\Http\Requests\turma;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class adicionarTurmaRequest extends FormRequest
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
            'descricao' => ['required', 'string', 'min:3', 'max:80'],
            'id_ano' => ['required'],
            'id_turno' => ['required'],
        ];
    }
    public function messages()
    {
        return ['required' => 'Campo obrigatório!'];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["success" => false, 'message' => $validator->errors()], 400));
    }
}
