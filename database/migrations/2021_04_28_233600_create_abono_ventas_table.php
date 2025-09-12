<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonoVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abono_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('venta_id');
            $table->unsignedInteger('valor');
            $table->unsignedInteger('empleado_id');
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('empleado_id')->references('id')->on('users');
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
        Schema::dropIfExists('abono_ventas');
    }
}
