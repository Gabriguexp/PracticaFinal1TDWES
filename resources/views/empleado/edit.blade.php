@extends('admin.base')

@section('content')
<h4>Editar Empleado</h4>

@if(Session::has('message'))
    <div class="alert alert-{{session()->get('type')}}" role="alert">
        {{session()->get('message')}}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{url('empleado/' . $empleado->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="nombre">Nombre</label>    
        <input class="form-control"  value="{{ $empleado->nombre }}" type="text" name="nombre"/>
    </div>
    <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input class="form-control"  value="{{ $empleado->apellidos }}"type="text" name="apellidos"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control"  value="{{ $empleado->email}}"type="email" name="email"/>
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input class="form-control"  value="{{ $empleado->telefono }}"type="tel" name="telefono"/>
    </div>
    <div class="form-group">
        <label for="fechacontrato">Fecha de contrato</label>
        <input class="form-control"  value="{{ $empleado->fechacontrato }}"type="date" name="fechacontrato"/>
    </div>
    <div class="form-group">
    <label for="idpuesto">Puesto</label>
        <select class="form-control"  name="idpuesto">
            Añadir que se marque el suyo
            @foreach ($puestos as $puesto)
                @if ($puesto->id == $empleado->idpuesto)
                    <option value="{{ $puesto->id }}" selected>{{ $puesto->nombre }}</option>
                @else
                    <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
    <label for="iddepartamento">Departamento</label>
        <select class="form-control" name="iddepartamento">
            
            @foreach ($departamentos as $departamento)
                @if ($departamento->id == $empleado->iddepartamento)
                    <option value="{{ $departamento->id }}"selected>{{ $departamento->nombre }}</option>
                @else
                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <input type="submit" value="Editar" class="btn btn-primary"/>
</form>
@endsection

