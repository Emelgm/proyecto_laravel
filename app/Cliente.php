<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'id';
    protected $table='clientes';
    protected $fillable=['id','nombres', 'apellidos','telefono'];
    public $incrementing=false;
}
