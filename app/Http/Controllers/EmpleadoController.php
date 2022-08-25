<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Ciudad;
use App\Models\Cargo;
use App\Models\AsignacionCargo;
use App\Models\Pais;
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
        $jefes = Empleado::join('asignacion_cargos', 'asignacion_cargos.id_empleado', '=', 'empleados.id')
        ->join('cargos', 'cargos.id', '=', 'asignacion_cargos.id_cargo')
        ->select("empleados.*","cargos.nombre_c","asignacion_cargos.id_cargo")
        ->where("asignacion_cargos.id_cargo", "!=", 1)
        ->paginate(10);
        $paises = Pais::all();
        $ciudades = Ciudad::all();
        $cargos = Cargo::all();
        return view('empleado.form')->with('cargos', $cargos)->with('ciudades', $ciudades)->with('jefes', $jefes)->with('paises', $paises);
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
            'identificacion' => 'required|max:15|integer',
            'nombre' => 'required|max:40',
            'apellido' => 'required|max:40',
            'direccion' => 'required|max:50',
            'telefono' => 'required|max:12|integer',
            'id_ciudad' => 'required'
        ]);

        $empleado = Empleado::create($request->only('identificacion','nombre', 'apellido', 'direccion', 'telefono', 'id_ciudad'));
        
        $ultimo_empleado = Empleado::select('id')->orderBy('id', 'desc')->first();
        $id_empleado = $ultimo_empleado -> id;

        $cargo = $request->id_cargo;
        $x = count($cargo);

        for ($i=0; $i < $x ; $i++) { 
            $asignacion = new AsignacionCargo();
            $asignacion->id_empleado = $id_empleado;
            $asignacion->id_cargo = $cargo[$i];
            $asignacion->id_jefe = $request->id_jefe;
            $asignacion->save();
        }
       

        
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
            'identificacion' => 'required|max:15|integer',
            'nombre' => 'required|max:40',
            'apellido' => 'required|max:40',
            'direccion' => 'required|max:50',
            'telefono' => 'required|max:12|integer',
            'id_ciudad' => 'required'
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
        Session::flash('mensaje', 'Empleado Eliminado con exito');
        return redirect()->route('empleado.index');
    }
}
