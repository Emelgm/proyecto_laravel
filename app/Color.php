<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table='colores';
    protected $fillable=['nombre'];

    public function talla(){
    	return $this->belongsToMany('App\Talla','productos','id_talla','id_color');
    }
}
