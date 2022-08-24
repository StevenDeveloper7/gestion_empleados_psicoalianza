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
           <h3 class="text-center">Cargos Disponibles</h3> 
        </div>

    </div>
    
    <a  href="{{ route('cargo.create')}}" class="btn btn-primary">Agregar nuevo cargo</a>
  

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
            <tr>
                <td>{{$cargo->id}}</td>
                <td>{{$cargo->nombre_c}}</td>
                <td>{{$cargo->descripcion_c}}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('cargo.edit', $cargo)}}">Editar</a>
                    <form action="{{ route('cargo.destroy', $cargo) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Estas seguro de eliminar este cargo')" >Eliminar</button>
                        
                    </form>
                </td>
            </tr> 

            @endforeach
           
        </tbody>
    </table>
    @if ($cargos->count())
    {{ $cargos->links() }}
    @endif
</div>
</div>
@endsection