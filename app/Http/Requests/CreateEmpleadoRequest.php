<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpleadoRequest extends FormRequest
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
         function messages(){
        $gte = "El campo :attribute debe ser mayor o igual que :value";
        $integer = "El campo :attribute ha de ser un numero entero";
        $lte = 'El campo :attribute debe ser menor o igual que :value';
        $max = 'El campo :attribute no puede tener más de :max caracteres';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $numeric = 'El campo :attribute debe ser numerico';
        $required = 'El campo :attribute es requerido';
        $unique = 'El campo :attribute debe ser unico';
        $date = 'El campo :attribute debe ser una fecha'; 
        $email = 'El campo :attribute debe ser un email valido';

        return [
            'nombre.required' => $required,
            'nombre.max' => $max,
            'apellidos.required' => $required,
            'apellidos.max' => $max,
            'email.required' => $required,
            'email.max' => $max,
            'email.email' => $email,
            'telefono.required' => $required,
            'telefono.integer' => $integer,
            'telefono.lte' => $lte,
            'telefono.gte' => $gte,
            'fechacontrato.required' => $required,
            'fechacontrato.date' => $date,
            
        ];
    }
     
    function attributes(){
        return [
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'email'=> 'Email del empleado',
            'telefono' => "Telefono del empleado", 
            'fechacontrato' => "Fecha de contratación"
        ];
    }
    public function rules()
    {
        return [
            'nombre' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'email' => 'required|max:50|email',
            'telefono' => 'required|lte:999999999|integer|gte:100000000',
            'fechacontrato' => 'required|date',
        ];
    }
}
