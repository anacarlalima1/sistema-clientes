<?php

namespace App\Http\Requests\video;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurtirVideoRequest extends FormRequest
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
            'id_video' => 'required',
            'like' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'id_video.required' => 'Ausência de parâmetros',
            'like.required' => 'Ausência de parâmetros',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException (response()->json(["success" => false, 'message' => $validator->errors() ], 400));
    }

}
