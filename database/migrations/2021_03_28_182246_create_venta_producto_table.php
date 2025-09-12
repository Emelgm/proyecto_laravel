<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('cantidad');
            $table->Integer('descuento');
            $table->unsignedInteger('id_venta');
            $table->String('id_producto');
            $table->Integer('p_detalle');
            $table->timestamps();
            $table->foreign('id_venta')->references('id')->on('ventas');
            $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_producto');
    }
}
