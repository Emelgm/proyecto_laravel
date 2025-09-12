<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table='tallas';
    protected $fillable=['nombre'];

    public function productos(){
    	return $this->hasMany('App\Producto','id_talla');
    }
}
