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

@if(count($empleados) == 0)
  <h3>Actualmente no hay empleados en este puesto</h3>
@else
<h3>Miembros del Puesto</h3>
  <form method="post" action="{{ url('puesto/transferencia/'. $puesto->id) }}">    
    @csrf
    <table class="table">
      <div class="hidden" id="form-selector">
        <label>Selecciona el puesto al que deseas enviar a los empleados</label>
        <select name="destino">
        @foreach ($puestos as $p)
          @if($puesto->id != $p->id)
          <option value="{{$p->id}}">{{ $p->nombre }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <thead>
        <td>Empleado</td>
        <td class="hidden" id="thead-transferir">Transferir</td>
    </thead>
      @foreach ($empleados as $empleado)
      
      <tr>
        <td><a href="{{ url('empleado/'. $empleado->id) }}"> {{$empleado->nombre}} {{ $empleado->apellidos}} </a></td>  
        <td><input type="checkbox" class="hidden checkbox"name="{{$empleado->id}}"></td>
      </tr>
      @endforeach
      </table>
      <input type="button" id="transferenciabtn"class="btn btn-primary" value="Habilitar edición"> 
      <input type="button" id="check-all" class="hidden btn btn-info" value="Seleccionar todos"> 
      <input type="button" id="uncheck-all" class="hidden btn btn-info" value="Deseleccionar todos"> <br><br>
      <input type="submit" id="submit" class="hidden submit btn btn-primary" value="Transferir empleados">
  </form>
@endif
  
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/delete.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/transferencia.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection