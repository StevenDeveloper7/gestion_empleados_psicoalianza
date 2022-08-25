<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::paginate(5);
        return view('cargo.index')->with('cargos', $cargos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargo.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_c' => 'required|max:30',
            'descripcion_c' => 'required|max:120'
        ]);
    
        $cargo = Cargo::create($request->only('nombre_c','descripcion_c'));
        Session::flash('mensaje', 'Cargo creado con exito');
    
        return redirect()->route('cargo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        return view('cargo.form')->with('cargo', $cargo);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        $request->validate([
            'nombre_c' => 'required|max:30',
            'descripcion_c' => 'required|max:70'
        ]);
        $cargo->nombre_c = $request['nombre_c'];
        $cargo->descripcion_c = $request['descripcion_c'];
        $cargo->save();

        Session::flash('mensaje', 'Cargo Actualizado con exito');

        return redirect()->route('cargo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        Session::flash('mensaje', 'Cargo Eliminado con exito');
        return redirect()->route('cargo.index');

    }
}
