@extends('layouts.app')
@section('content')
<div class="container py-5 ">
    @if (Session::has('mensaje'))
    <div class="alert alert-info my-5">
        {{ Session::get('mensaje')}}
    </div>
         
    @endif
    <div class="card">
        <div class="card-header">
           <h3 class="text-center">Empleados Registrados</h3> 
        </div>

    </div>
    
    <a  href="{{ route('empleado.create')}}" class="btn btn-primary">Agregar nuevo empleado</a>
  

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <th>Identificacion</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Ciudad</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{$empleado->identificacion}}</td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->apellido}}</td>
                <td>{{$empleado->direccion}}</td>
                <td>{{$empleado->telefono}}</td>
                <td>{{$empleado->nombre_ciudad}}</td>
                <td>{{$empleado->nombre_c}}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('empleado.edit', $empleado)}}">Editar</a>
                    <form action="{{ route('empleado.destroy', $empleado) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Estas seguro de eliminar este empleado')" >Eliminar</button>
                        
                    </form>
                </td>
            </tr> 

            @endforeach
           
        </tbody>
    </table>
    @if ($empleados->count())
    {{ $empleados->links() }}
    @endif
</div>
</div>
@endsection