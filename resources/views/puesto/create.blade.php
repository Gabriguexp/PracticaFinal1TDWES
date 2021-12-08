@extends('admin.base')

@section('content')
<h4>Añadir puesto</h4>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{url('puesto')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre del puesto</label>
        <input value="{{ old('nombre')}}" class="form-control" type="text" name="nombre"/>
    </div>
    <div class="form-group">
        <label for="salariominimo">Salario minimo</label>
        <input value="{{ old('salariominimo')}}" class="form-control" type="number" name="salariominimo"/>
    </div>
    <div class="form-group">
        <label for="salariomaximo">Salario máximo</label>
        <input value="{{ old('salariomaximo')}}" class="form-control" type="number" name="salariomaximo"/>
    </div>
    <input type="submit" value="Añadir puesto" class="btn btn-primary"/>
</form>
@endsection