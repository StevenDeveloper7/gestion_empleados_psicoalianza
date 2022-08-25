<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionCargo extends Model
{
    use HasFactory;
    protected $fillable = ['id_empleado', 'id_cargo'];

    public function rel_empleado()
    {
        return $this->belongsToMany('App\Models\Empleado');
    }
    public function rel_cargo()
    {
        return $this->belongsToMany('App\Models\Cargo');
    }
}
