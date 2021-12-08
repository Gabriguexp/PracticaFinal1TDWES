@extends('admin.base')

@section('content')
<h2>Departamentos</h2>

@if(Session::has('message'))
    <div class="alert alert-{{session()->get('type')}}" role="alert">
        {{session()->get('message')}}
    </div>
@endif
<div class="modal" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar borrado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Está a punto de borrar el departamento <span id="deleteData"></span>. ¿Está seguro?</p>
      </div>
      <div class="form-control">
        <label for="all" form="modalDeleteResourceForm">¿Borrar tambien empleados?</label>
        <input type="checkbox" name="all" form="modalDeleteResourceForm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @csrf    
            @method('delete')
            
            <input type="submit" class="btn btn-primary" value="Borrar"/>
        </form>
      </div>
    </div>
  </div>
</div>
<form method="get" action="{{ url('departamento/search/search') }}">
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>Orden:</label>
                    <select name="order" class="select2" style="width: 100%;">
                        <option value="asc" selected>ASC</option>
                        <option value="desc">DESC</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label>Buscar por:</label>
                    <select name="where" class="select2" style="width: 100%;">
                        <option value="nombre" selected>Nombre</option>
                        <option value="localizacion">localizacion</option>
                        <option value="idempleadojefe">Jefe</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-lg">
                <input type="search" name="busqueda" class="form-control form-control-lg" placeholder="Buscar">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-lg btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <td scope="col">Nombre</td>
            <td scope="col">Localización</td>
            <td scope="col">Jefe</td>
            <td scope="col" rowspan="3">Opciones</td>
        </tr>
    </thead>
    <tbody>
    @foreach($departamentos as $departamento)
        <tr>
            <td>{{ $departamento->nombre }}</td>
            <td>{{ $departamento->localizacion }}</td>
            @if (isset($departamento->jefe->nombre))
            <td>{{ $departamento->jefe->nombre }}</td>
            @else
            <td></td>
            @endif
            <td><a href="{{ url('departamento/' . $departamento->id) }}">Ver</a></td>
            <td><a href="{{ url('departamento/' . $departamento->id .'/edit') }}">Editar</a></td>
            <td><a href="javascript: void(0);" data-name="{{ $departamento->nombre }}" data-url="{{ url('departamento/' . $departamento->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{url('departamento/create')}}">Crear nuevo departamento</a>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection