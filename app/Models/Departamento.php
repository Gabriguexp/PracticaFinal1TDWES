<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model{
    use HasFactory;
    
    protected $table = "departamento";
    
    protected $fillable = ['nombre', 'localizacion', 'idempleadojefe'];
    
    public function jefe(){
        return $this->belongsTo('App\Models\Empleado', 'idempleadojefe');
    }
    //departamento: id, nombre, localizacion, idempleadojefe

}
