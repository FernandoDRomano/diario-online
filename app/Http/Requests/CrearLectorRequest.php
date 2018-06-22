<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearLectorRequest extends FormRequest
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
            'nombreApellido' => 'required|min:4|max:45',
            'fechaNacimiento' => 'required',
            'email' => 'required|min:4|max:45|unique:users',
            'password' => 'required|min:4|max:45'
        ];
    }
}
