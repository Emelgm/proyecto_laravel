<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table='modelos';
    protected $fillable=['nombre'];

    public function colores(){
    	return $this->belongsToMany('App\Color','id_modelo','id_color');
    }
}
