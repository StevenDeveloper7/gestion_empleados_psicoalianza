<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Ciudad;
use App\Models\Cargo;
use App\Models\AsignacionCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::join('ciudads', 'ciudads.id', '=', 'empleados.id_ciudad')
                    ->select("empleados.*","ciudads.nombre_ciudad")
                    ->paginate(10);
        return view('empleado.index')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudades = Ciudad::all();
        $cargos = Cargo::all();
        return view('empleado.form')->with('cargos', $cargos)->with('ciudades', $ciudades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = Empleado::create($request->only('identificacion','nombre', 'apellido', 'direccion', 'telefono', 'id_ciudad'));
        
        $ultimo_empleado = Empleado::select('id')->orderBy('id', 'desc')->first();
        $id_empleado = $ultimo_empleado -> id;
        $asignacion = new AsignacionCargo();
        $asignacion->id_empleado = $id_empleado;
        $asignacion->id_cargo = $request->id_cargo;
        $asignacion->save();

        
        Session::flash('mensaje', 'Empleado Registrado con exito');

        return redirect()->route('empleado.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $ciudades = Ciudad::all();
        $cargos = Cargo::all();
        return view('empleado.form')->with('empleado', $empleado)->with('ciudades', $ciudades)->with('cargos', $cargos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required|max:30',
            'telefono' => 'required|max:12'
        ]);

        $empleado->identificacion = $request['identificacion'];
        $empleado->nombre = $request['nombre'];
        $empleado->apellido = $request['apellido'];
        $empleado->direccion = $request['direccion'];
        $empleado->telefono = $request['telefono'];
        $empleado->id_ciudad = $request['id_ciudad'];
        $empleado->save();

        Session::flash('mensaje', 'Empleado Actualizado con exito');

        return redirect()->route('empleado.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        Session::flash('mensaje', 'Empleado Actualizado con exito');
        return redirect()->route('empleado.index');
    }
}
