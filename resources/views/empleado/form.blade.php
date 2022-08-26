@extends('layouts.app')
@section('content')
<div class="container py-5">
    @if (isset($empleado))
    <div class="card">
        <div class="card-header">
           <h3 class="text-center">Formulario de Actualizacion de Informacion de empleado</h3> 
        </div>
    </div> 
    @else
    <div class="card">
        <div class="card-header">
           <h3 class="text-center">Formulario de registro de empleados</h3> 
        </div>
    </div>
    @endif

    @if (isset($empleado))
    <form action="{{ route('empleado.update', $empleado)}}" method="post">
        @method('PUT')
    @else
    <form action="{{ route('empleado.store')}}" method="post">
    @endif

        @csrf

        <div class="row">
            <div class="col-md-4">
                <label for="identificacion" class="form-label"># identificacion</label>
                <input type="integer" name="identificacion" class="form-control" value="{{ old('identificacion') ?? @$empleado->identificacion }}">
                @error('identificacion')
                <p class="form-text text-danger"> {{ $message }} </p>
                @enderror
        </div>
            <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') ?? @$empleado->nombre }}">
                    @error('nombre')
                    <p class="form-text text-danger"> {{ $message }} </p>
                    @enderror
            </div>
            <div class="col-md-4">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" name="apellido" class="form-control" value="{{ old('apellido') ?? @$empleado->apellido }}">
                @error('apellido')
                <p class="form-text text-danger"> {{ $message }} </p>
                @enderror
            </div>
           
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="integer" name="direccion" class="form-control" value="{{ old('direccion') ?? @$empleado->direccion }}">
                @error('direccion')
                <p class="form-text text-danger"> {{ $message }} </p>
                @enderror
        </div>
            <div class="col-md-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') ?? @$empleado->telefono }}">
                    @error('telefono')
                    <p class="form-text text-danger"> {{ $message }} </p>
                    @enderror
            </div>
            <div class="col-md-6">
                <div class="row">
                <label for="id_pais" class="form-label">Lugar de nacimiento</label>
                <div class="col-md-6">
                    <select id="select-pais" class="form-select" name="id_pais" aria-label="Default select example">
                        <option value=" - "> Seleccione Pais </option>
                        @foreach($paises as $pais)
                        <option value=" {{$pais->id}} "> {{$pais->nombre_pais}} </option>
                        @endforeach
                      </select>
                </div>
                <div class="col-md-6">
                    <select id="select-ciudad" class="form-select" name="id_ciudad" aria-label="Default select example">
                        <option value=" - "> Seleccione ciudad </option>
                      </select>
                </div>
            </div>
            </div>
            @error('id_ciudad')
                <p class="form-text text-danger"> {{ $message }} </p>
                @enderror
            
           
        </div>
        <div class="row">
            
            <div class="col-md-6">
                <label for="id_cargo" class="form-label">Jefe Inmediato</label>
                <select  class="form-select" name="id_jefe" aria-label="Default select example">
                    @foreach($jefes as $jefe)
                    <option value=" {{$jefe->id}} "> {{$jefe->nombre}} {{$jefe->apellido}}-{{$jefe->nombre_c}} </option>
                    @endforeach
                  </select>
            </div>
            <div class="col-md-3">
                <label for="id_cargo" class="form-label">Cargo</label>
                <select multiple class="form-select"  name="id_cargo[]" aria-label="Default select example">
                    @foreach($cargos as $cargo)
                    <option value=" {{$cargo->id}} "> {{$cargo->nombre_c}} </option>
                    @endforeach
                  </select>
            </div>
            <div class="col-md-3">
                <br>
                <p>Para seleccionar varios cargos tenga presionada la tecla ctrl y selecciones los que considere necesarios</p>
            </div>
        </div>
        
        
        <br>
        @if (isset($empleado))
        <div class="mb-3">
        <button class="btn btn-primary form-control" type="submit">Actualizar informacion del Empleado</button>
        </div>  
         @else
        <div class="mb-3">
        <button class="btn btn-primary form-control" type="submit">Guardar datos del Empleado</button>
        @endif

    </div>  
        

    </form>
   
</div>

<script src=""></script>

@endsection