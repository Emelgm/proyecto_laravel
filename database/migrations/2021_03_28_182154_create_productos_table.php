<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->String('id');
            $table->String('nombre');
            $table->unsignedInteger('id_modelo');
            $table->unsignedInteger('id_color');
            $table->unsignedInteger('id_talla');
            $table->Integer('cantidad');
            $table->Integer('p_compra');
            $table->Integer('p_venta');
            $table->unsignedInteger('id_proveedor');
            $table->timestamps();
            $table->foreign('id_color')->references('id')->on('colores');
            $table->foreign('id_talla')->references('id')->on('tallas');
            $table->foreign('id_modelo')->references('id')->on('modelos');
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
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
