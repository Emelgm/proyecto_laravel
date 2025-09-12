<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonoVenta extends Model
{
    protected $fillable = ['venta_id','valor','empleado_id'];

    public function empleado()
    {
    	return $this->hasOne('App\User','id','empleado_id');
    }
}
