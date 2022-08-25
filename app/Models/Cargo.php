<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_c', 'descripcion_c'];

    public function rel_empleado()
    {
        return $this->belongsToMany('App\Models\Empleado');
    }
}
