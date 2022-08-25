@extends('layouts.app')
@section('content')
<div class="container py-5">
    @if (isset($cargo))
    <h1 class="text-center">
        Editar Cargo
    </h1>  
    @else
    <div class="card">
        <div class="card-header">
           <h3 class="text-center">Formulario de registro de Cargos</h3> 
        </div>
    </div>
    @endif

    @if (isset($cargo))
    <form action="{{ route('cargo.update', $cargo)}}" method="post">
        @method('PUT')
    @else
    <form action="{{ route('cargo.store')}}" method="post">
    @endif

        @csrf

        <div class="row">
            <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre del Cargo</label>
                    <input required type="text" name="nombre_c" class="form-control" value="{{ old('nombre_c') ?? @$cargo->nombre_c }}">
                    @error('nombre_c')
                    <p class="form-text text-danger"> {{ $message }} </p>
                    @enderror
            </div>
            <div class="col-md-8">
                <label for="descripcion_c" class="form-label">Descripcion</label>
                <input required type="text" name="descripcion_c" class="form-control" value="{{ old('descripcion_c') ?? @$cargo->descripcion_c }}">
                @error('descripcion_c')
                <p class="form-text text-danger"> {{ $message }} </p>
                @enderror
            
            </div>
                    
           
        </div>
        
        <br>
        @if (isset($cargo))
        <div class="mb-3">
        <button class="btn btn-primary" type="submit">Actualizar informacion del cargo</button>
        </div>  
         @else
        <div class="mb-3">
        <button class="btn btn-primary" type="submit">Guardar cargo</button>
        @endif

    </div>  
        

    </form>
   
</div>
@endsection