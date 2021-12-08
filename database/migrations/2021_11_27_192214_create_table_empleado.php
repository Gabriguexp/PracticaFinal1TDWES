<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
        //empleado: id, nombre, apellidos, email, telefono, fechacontrato, idpuesto, iddepartamento

            $table->id();
            $table->string("nombre", 50);
            $table->string("apellidos", 50);
            $table->string("email", 50);
            $table->integer("telefono");
            $table->date('fechacontrato');
            $table->bigInteger('idpuesto')->unsigned()->nullable();
            $table->bigInteger('iddepartamento')->unsigned()->nullable();
            $table->foreign('idpuesto')->references('id')->on('puesto')->nullOnDelete();
            $table->foreign('iddepartamento')->references('id')->on('departamento')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}
