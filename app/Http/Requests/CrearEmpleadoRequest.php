<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearEmpleadoRequest extends FormRequest
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
            'apellido' => 'required|min:3|max:45',
            'nombre' => 'required|min:3|max:45',
            'dni' => 'required|max:9|min:8',
            'email' => 'required|min:4|max:45|unique:users',
            'password' => 'required|min:4|max:45',
            'fechaNacimiento' => 'required',
            'role_id' => 'required'
        ];
    }
}
