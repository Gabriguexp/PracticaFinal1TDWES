@extends('admin.base')

@section('content')
<h2>Puestos</h2>
<a href="{{ url('puesto') }}">Ver todos</a>
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
        <p>Está a punto de borrar el puesto <span id="deleteData"></span> ¿Está seguro?</p>
      </div>
      <div class="form-control">
        <label for="all" form="modalDeleteResourceForm">¿Borrar tambien empleados?</label>
        <input type="checkbox" name="all" form="modalDeleteResourceForm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar"/>
        </form>
      </div>
    </div>
  </div>
</div>
<form method="get" action="{{ url('puesto/search/search') }}">
@csrf
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="where">Orden:</label>
                    <select name="order" class="select2" style="width: 100%;">
                        @if ($order == 'asc')
                        <option value="asc" selected>ASC</option>
                        <option value="desc">DESC</option>
                        @else
                        <option value="asc">ASC</option>
                        <option value="desc" selected>DESC</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="where">Buscar por:</label>
                    <select name="where" class="select2" style="width: 100%;">
                        @if ($where == 'nombre')
                            <option value="nombre" selected>Nombre</option>
                        @else
                            <option value="nombre">Nombre</option>
                        @endif
                        
                        @if ($where == 'salariominimo')
                        <option value="salariominimo" selected>Salario minimo</option>
                        @else
                        <option value="salariominimo">Salario minimo</option>
                        @endif

                        @if ($where == 'salariomaximo')
                        <option value="salariomaximo" selected>Salario máximo</option>
                        @else
                        <option value="salariomaximo">Salario máximo</option>
                        @endif

                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group input-group-lg">
                <input value="{{ $input }}" type="search" name="busqueda" class="form-control form-control-lg" placeholder="Buscar">
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
            <td scope="col">Nombre del puesto</td>
            <td scope="col">Salario minimo</td>
            <td scope="col">Salario maximo</td>
            <td scope="col" rowspan="3">Opciones</td>
        </tr>
    </thead>
    <tbody>
    @foreach($puestos as $puesto)
        <tr>
            <td>{{ $puesto->nombre }}</td>
            <td>{{ $puesto->salariominimo }} €</td>
            <td>{{ $puesto->salariomaximo }} €</td>
            <td><a href="{{ url('puesto/' . $puesto->id) }}">Ver</a></td>
            <td><a href="{{ url('puesto/' . $puesto->id .'/edit') }}">Editar</a></td>
            <td><a href="javascript: void(0);" data-name="{{ $puesto->nombre }}" data-url="{{ url('puesto/' . $puesto->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{url('puesto/create')}}">Crear nuevo puesto</a>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection