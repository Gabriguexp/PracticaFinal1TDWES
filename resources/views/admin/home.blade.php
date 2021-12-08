  @extends('admin.base')
  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Changelog</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Login</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                Habilitado login para añadir seguridad a la gestión de la empresa
            </div>
            <div class="card-footer">
                07/12/2021
            </div>
        </div>
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Empleados</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
            Habilitada la creación, edición, borrado y visionado de empleados. <a href="{{ url('empleado') }}">Ir a empleados</a>
            </div>
            <div class="card-footer">
            07/12/2021
            </div>
        </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Departamentos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Habilitada la creación, edición, borrado y visionado de departamentos. <a href="{{ url('departamento') }}">Ir a departamentos</a>
        </div>
        <div class="card-footer">
            05/12/2021
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Puestos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Habilitada la creación, edición, borrado y visionado de puestos. <a href="{{ url('puesto') }}">Ir a puestos</a>
        </div>
        <div class="card-footer">
            03/12/2021
        </div>
      </div>

      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection