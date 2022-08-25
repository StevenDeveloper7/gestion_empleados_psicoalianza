<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = [ 'identificacion','nombre', 'apellido', 'direccion', 'telefono', 'id_ciudad'];


    public function rel_ciudad()
    {
        return $this->hasOne('App\Models\Ciudad');
    }

    public function rel_cargo()
    {
        return $this->belongsToMany('App\Models\Cargo');
    }
}
