@extends('admin.base')

@section('content')
<h2>Empleados</h2>
<a href="{{ url('empleado') }}">Ver todos</a>
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
        <p>Está a punto de borrar al empleado <span id="deleteData"></span>. ¿Está seguro?</p>
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
<form method="get" action="{{ url('empleado/search/search') }}">
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label>Orden:</label>
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
                    <label>Buscar por:</label>
                    <select name="where" class="select2" style="width: 100%;">
                    @if ($where == 'nombre')
                        <option value="nombre" selected>Nombre</option>
                    @else
                        <option value="nombre">Nombre</option>
                    @endif
                    
                    @if ($where == 'apellidos')
                        <option value="apellidos" selected>Apellidos</option>
                    @else
                        <option value="apellidos">Apellidos</option>
                    @endif

                    @if ($where == 'email')
                        <option value="email" selected>Email</option>
                    @else
                        <option value="email">Email</option>
                    @endif

                    @if ($where == 'telefono')
                        <option value="telefono" selected>Telefono</option>
                    @else
                        <option value="telefono">Telefono</option>
                    @endif

                    @if ($where == 'fechacontrato')
                        <option value="fechacontrato" selected>Fecha Contrato</option>
                    @else
                        <option value="fechacontrato">Fecha Contrato</option>
                    @endif
                    
                    @if ($where == 'idpuesto')
                        <option value="idpuesto" selected>Puesto</option>
                    @else
                        <option value="idpuesto">Puesto</option>
                    @endif                                        
                    @if ($where == 'iddepartamento')
                        <option value="iddepartamento" selected>Departamento</option>
                    @else
                        <option value="iddepartamento">Departamento</option>
                    @endif
                        
                        
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
            <td scope="col">Apellidos</td>
            <td scope="col">Departamento</td>
            <td scope="col" rowspan="3">Opciones</td>
        </tr>
    </thead>
    <tbody>
    @foreach($empleados as $empleado)
        <tr>

<!--//empleado: id, nombre, apellidos, email, telefono, fechacontrato, idpuesto, iddepartamento-->
            <td>{{ $empleado->nombre }}</td>
            <td>{{ $empleado->apellidos }}</td>
            @if (isset($empleado->departamento->nombre))
            <td>{{ $empleado->departamento->nombre }}</td>
            @else
              <td></td>
            @endif
            <td><a href="{{ url('empleado/' . $empleado->id) }}">Ver</a></td>
            <td><a href="{{ url('empleado/' . $empleado->id .'/edit') }}">Editar</a></td>
            <td><a href="javascript: void(0);" data-name="{{ $empleado->nombre }}" data-url="{{ url('empleado/' . $empleado->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{{url('empleado/create')}}">Añadir nuevo empleado</a>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection