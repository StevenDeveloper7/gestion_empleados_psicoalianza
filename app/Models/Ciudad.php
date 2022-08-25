<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    public function rel_empleado()
    {
        return $this->belongsTo('App\Models\Empleado');
    }
}
