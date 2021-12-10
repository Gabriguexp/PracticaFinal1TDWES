<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePuestoRequest extends FormRequest
{
    function attributes(){
        return [
            'nombre' => 'Nombre del puesto',
            'salariominimo' => 'Salario mínimo',
            'salariomaximo'=> 'Salario máximo',
        ];
    }
    
    function messages(){
        $gte = "El campo :attribute debe ser mayor o igual que :value";
        $integer = "El campo :attribute ha de ser un numero entero";
        $lte = 'El campo :attribute debe ser menor o igual que :lte';
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $numeric = 'El campo :attribute debe ser numerico';
        $required = 'El campo :attribute es requerido';
        $unique = 'El campo :attribute debe ser unico';

        return [
            'nombre.required' => $required,
            'nombre.min' => $min,
            'nombre.max' => $max,
            'nombre.unique' => $unique,
            'salariominimo.numeric' => $numeric,
            'salariominimo.required' => $required,
            'salariominimo.gte' => $gte,
            'salariomaximo.numeric' => $numeric,
            'salariomaximo.required' => $required,
            'salariomaximo.gte' => $gte,
        ];
    }
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
            'nombre' => 'required|min:5|max:50|unique:puesto,nombre',
            'salariominimo' => 'required|gte:1000|numeric',
            'salariomaximo' => 'required|gte:salariominimo|numeric'
        ];
    }
}
