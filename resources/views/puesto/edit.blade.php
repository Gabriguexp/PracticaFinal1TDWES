@extends('admin.base')

@section('content')
<h4>Editar puesto</h4>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('message'))
    <div class="alert alert-{{session()->get('type')}}" role="alert">
        {{session()->get('message')}}
    </div>
@endif
<form action="{{url('puesto/' . $puesto->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="nombre">Nombre del puesto</label>
        <input class="form-control" value="{{$puesto->nombre}}" type="text" name="nombre"/>
    </div>
    <div class="form-group">
        <label for="salariominimo">Salario minimo</label>
        <input class="form-control"value="{{$puesto->salariominimo}}" type="number" name="salariominimo"/>
    </div>
    <div class="form-group">
        <label for="salariomaximo">Salario máximo</label>
        <input class="form-control" value="{{$puesto->salariomaximo}}"type="number" name="salariomaximo"/>
    </div>
    <input type="submit" class="btn btn-primary" value="Editar puesto"/>
</form>
@endsection