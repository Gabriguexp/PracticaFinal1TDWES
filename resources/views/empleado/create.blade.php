@extends('admin.base')

@section('content')
<h4>Añadir nuevo empleado</h4>

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
<!--//empleado: id, nombre, apellidos, email, telefono, fechacontrato, idpuesto, iddepartamento-->

<form action="{{url('empleado')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input value="{{ old('nombre') }}" class="form-control" type="text" name="nombre"/>
    </div>
    <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input value="{{ old('apellidos') }}"  class="form-control" type="text" name="apellidos"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input value="{{ old('email') }}"  class="form-control" type="email" name="email"/>
    </div>
    <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input value="{{ old('telefono') }}"  class="form-control" type="tel" name="telefono"/>
    </div>
    <div class="form-group">
    <label for="fechacontrato">Fecha de contrato</label>
    <input value="{{ old('fechacontrato') }}"  class="form-control" type="date" name="fechacontrato"/>
    </div>
    <div class="form-group">
        <label for="idpuesto">Puesto</label>
        <select value="{{ old('idpuesto') }}"  class="form-control" name="idpuesto">
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="iddepartamento">Departamento</label>
        <select value="{{ old('iddepartamento') }}"  class="form-control" name="iddepartamento">
            @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
            @endforeach
        </select>
    </div>
    <input class="btn btn-primary" type="submit" value="Añadir"/>
</form>
@endsection

