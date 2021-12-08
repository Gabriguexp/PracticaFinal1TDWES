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
        <p>Está a punto de borrar el puesto <span id="deleteData"></span>. ¿Está seguro? </p>
      </div>
      <div class="form-control">
        <label for="all" form="modalDeleteResourceForm">¿Borrar tambien empleados?</label>
        <input type="checkbox" name="all" form="modalDeleteResourceForm">
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
            <td scope="col">Nombre del puesto</td>
            <td scope="col">Salario minimo</td>
            <td scope="col">Salario maximo</td>
            <td scope="col">Opciones</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $puesto->id }}</td>
            <td>{{ $puesto->nombre }}</td>
            <td>{{ $puesto->salariominimo }} €</td>
            <td>{{ $puesto->salariomaximo }} €</td>
            <td><a href="{{ url('puesto/' . $puesto->id .'/edit') }}">Editar</a></td>
            <td><a href="javascript: void(0);" data-name="{{ $puesto->nombre }}" data-url="{{ url('puesto/' . $puesto->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a></td>

        </tr>
    </tbody>
</table>

@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/delete.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection