<?php

namespace App\Http\Controllers;

use\App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function SearchCity($id){
        return Ciudad::where('id_pais', $id)->get();
    }
}
