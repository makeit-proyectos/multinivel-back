<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('admin')->default(False);
            //Datos Personales
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('tipoDocumento',['DNI','CI','LE','LC']);
            $table->string('nroDocumento');
            $table->string('nroCelular');
            $table->date('fechaNacimiento');

            //Quien te recomienda?
            $table->string('idReferente');

            //Datos complementarios
            $table->string('nombreFavorito')->nullable();
            $table->string('nroFijo')->nullable();
            $table->enum('genero',['Masculino','Femenino']);
            
            $table->string('departamento');
            $table->string('ciudad');
            $table->string('barrio');
            $table->string('direccion');
            $table->enum('tipoVia',['Calle','Carrera','Diagonal','Transversal']);
            $table->string('referencia');

            $table->rememberToken();
            $table->timestamps();

            //Login
            $table->string('nombreUsuario');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
