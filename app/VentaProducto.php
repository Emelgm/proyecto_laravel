<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    protected $table='venta_producto';
    protected $fillable=['cantidad','descuento', 'estado','id_venta', 'id_producto','p_detalle'];

    public function productos(){
    	return $this->belongsTo('App\Producto','id_producto');
    }
}
