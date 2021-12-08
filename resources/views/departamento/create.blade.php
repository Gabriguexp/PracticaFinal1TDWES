@extends('admin.base')

@section('content')
<h4>Añadir departamento</h4>
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
<form action="{{url('departamento')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre del departamento</label>
        <input value="{{ old('nombre') }}" class="form-control"  type="text" name="nombre"/>
    </div>
    <div class="form-group">
        <label for="localizacion">Localización</label>
        <input value="{{ old('localizacion') }}" class="form-control" type="text" name="localizacion"/>
    </div>
    <div class="form-group">
        <label for="idempleadojefe">Jefe</label>    
        <select value="{{ old('idempleadojefe') }}"class="form-control" name="idempleadojefe">
            @foreach($workers as $worker)
                <option value="{{ $worker->id }}">{{ $worker->nombre }}</option>
            @endforeach
        </select>
    </div>
    
    <input type="submit" value="Añadir departamento" class="btn btn-primary"/>
</form>
@endsection

