@extends('admin.base')

@section('content')
<h4>Editar departamento</h4>
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
<form action="{{url('departamento/' . $department->id)}}" method="post">
    @csrf
    @method('put')
        <div class="form-group">
        <label for="nombre">Nombre del departamento</label>
        <input class="form-control" value="{{ $department->nombre }}" type="text" name="nombre"/>
        </div>
        <div class="form-group">
        <label for="localizacion">Localización</label>
        <input class="form-control" value="{{ $department->localizacion }}" type="text" name="localizacion"/>
        </div>
        <div class="form-group">
        <label for="idempleadojefe">Jefe</label>
        
        <select class="form-control" name="idempleadojefe">
            @foreach($workers as $worker)
                @if(isset($department->jefe->nombre) && $worker->id == $department->jefe->id)
                <option value="{{ $worker->id }}"selected>{{ $worker->nombre }}</option>
                @else
                <option value="{{ $worker->id }}">{{ $worker->nombre }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <input type="submit" value="Editar departamento" class="btn btn-primary"/>
</form>
@endsection

