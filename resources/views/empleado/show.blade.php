@extends('admin.base')

@section('content')

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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="modalDeleteResourceForm" action="" method="post">
            @method('delete')
            @csrf
            <input type="submit" class="btn btn-primary" value="Borrar"/>
        </form>
      </div>
    </div>
  </div>
</div>

<table class="table">
    <thead>
        <tr>
            <td scope="col">Id</td>
            <td scope="col">Nombre</td>
            <td scope="col">Apellidos</td>
            <td scope="col">Email</td>
            <td scope="col">Telefono</td>
            <td scope="col">Fecha de contratación</td>
            <td scope="col">Puesto</td>
            <td scope="col">Departamento</td>
            <td scope="col">Opciones</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $empleado->id }}</td>
            <td>{{ $empleado->nombre }}</td>
            <td>{{ $empleado->apellidos }}</td>
            <td>{{ $empleado->email }}</td>
            <td>{{ $empleado->telefono }} </td>
            <td>{{ date('d-m-Y', strtotime($empleado->fechacontrato)) }}</td>
            @if (isset($empleado->puesto->nombre))
              <td>{{ $empleado->puesto->nombre }}</td>
            @else
              <td></td>
            @endif
            @if (isset($empleado->departamento->nombre))
              <td>{{ $empleado->departamento->nombre }}</td>
            @else
              <td></td>
            @endif
            
            <td><a href="{{ url('empleado/' . $empleado->id .'/edit') }}">Editar</a></td>
            <td><a href="javascript: void(0);" data-name="{{ $empleado->nombre }}" data-url="{{ url('empleado/' . $empleado->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a></td>

        </tr>
    </tbody>
</table>

@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection