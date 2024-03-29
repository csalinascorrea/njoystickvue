<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('idProductos');
                $table->string('nombreProductos', 100)->unique();
                $table->string('descripcionProductos', 200);
                $table->integer('stockNuevoProductos')->nullable();
                $table->integer('stockUsadoProductos')->nullable();
                $table->integer('precioNuevoProductos')->nullable();
                $table->integer('precioUsadoProductos')->nullable();
                $table->timestamps();
                $table->unsignedInteger('idPlataformas');
                $table->foreign('idPlataformas')->references('idPlataformas')->on('plataformas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
