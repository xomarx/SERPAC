<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('IdPersona')->unique();
            $table->string('paterno',60)->nullable();
            $table->string('materno', 60)->nullable();
            $table->string('nombre', 60)->nullable();
            $table->char('dni', 8)->nullable();
            $table->date('fec_nac')->nullable();
            $table->char('sexo')->nullable();
            $table->text('direccion')->nullable();
            $table->text('referencia')->nullable();
            $table->char('telefono', 9);
            $table->char('celular', 9);
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
        Schema::drop('persona');
    }
}
