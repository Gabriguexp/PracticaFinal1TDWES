<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDepartamentoRequest extends FormRequest
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

    function attributes(){
        return [
            'nombre' => 'Nombre del departamento',
            'localizacion'=> 'Localización del departamento',
        ];
    }
        function messages(){
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        $required = 'El campo :attribute es requerido';
        $unique = 'El campo :attribute debe ser unico';
        
        return [
            'nombre.required' => $required,
            'nombre.max' => $max,
            'nombre.unique' => $unique,
            'localizacion.required' => $required,
            'localizacion.max' => $max,

        ];
    }
    
    public function rules()
    {
        return [
            'nombre' => 'required|max:50|unique:departamento,nombre,'. $this->departamento,
            'localizacion' => 'required|max:50',
        ];
    }
}
