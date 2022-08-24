<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('identificacion',15);
            $table->string('nombre',40);
            $table->string('apellido',40);
            $table->string('direccion',50);
            $table->string('telefono',12);
            $table->unsignedBigInteger('id_ciudad');
            $table->foreign('id_ciudad')->references('id')->on('ciudads');
            $table->timestamps();
        });
    }

    
   
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
