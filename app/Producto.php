<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'id';
    protected $table='productos';
    protected $fillable=['id', 'id_modelo', 'nombre','id_color', 'id_talla', 'cantidad','p_compra', 'p_venta', 'id_proveedor'];
    public $incrementing=false;

    public function color(){
    	return $this->belongsTo('App\Color','id_color','id');
    }

    public function talla(){
    	return $this->belongsTo('App\Talla','id_talla','id');
    }

    public function modelo(){
    	return $this->belongsTo('App\Modelo','id_modelo','id');
    }

     public function proveedor(){
        return $this->belongsTo('App\Proveedor','id_proveedor','id');
    }

    public function colorVenta(){
        return $this->belongsTo('App\Color','id_color','id');
    }

    public function tallaVenta(){
        return $this->belongsTo('App\Talla','id_talla','id');
    }

    public function modeloVenta(){
        return $this->belongsTo('App\Modelo','id_modelo','id');
    }
}
