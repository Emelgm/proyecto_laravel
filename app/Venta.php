<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='ventas';
    protected $fillable=['id_empleado','id_cliente', 'total','estado'];

    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }

    public function user(){
        return $this->belongsTo('App\User','id_empleado');
    }

    public function venta_producto(){
    	return $this->hasMany('App\VentaProducto','id_venta');
    }

    public function productos(){
    	return $this->belongsTo('App\VentaProducto','id_producto');
    }

    public function abonos()
    {
        return $this->hasMany('App\AbonoVenta','venta_id');
    }
}
