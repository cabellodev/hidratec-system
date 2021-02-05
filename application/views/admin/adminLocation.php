<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Recursos / Ubicaciones</li>
    </ol>

    <div class="accordion" id="accordionExample">
      <div class="card mb-3">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              INSTRUCCIONES
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
           En esta sección podra cargar todas las ubicaciones existentes donde se puede encontrar almacenada una orden a nivel de taller.
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de ubicaciones
      </div>
      <div class="card-body ">
        <div class="table-responsive">
          <table class="table table-bordered" id="table-location" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Bloquear/Desbloquear</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div style="padding-right: 40px">
      <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#addLocation" id="btn"><i class="fas fa-plus"></i> Crear ubicación</button>
    </div>
    <div class="row mb-3"></div>

  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Crear ubicación</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
            <p id="UserModalInfo"></p>
          </div>
        </div>
        <div class="form-group">
          <div class="row mb-2">
              <input type="hidden" class="form-control" id="id" name="id" >
            <div class="col-md-12 col-lg-6 control-label">
              <label for="actividad">Nombre</label>
              <input type="text" class="form-control" id="name" name="name">
              <div class="invalid-feedback name" style="display: none;  color:red">
                Ingrese un nombre porfavor.
              </div>
            </div>
            <div class="col-md-12 col-lg-6 control-label">
              <label for="actividad">Descripcion</label>
              <textarea type="text" class="form-control" name="description" id="description"></textarea>
              <div class="invalid-feedback description" style="display: none;  color:red">
                Ingrese su descripcion  porfavor.
              </div>
            </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="createLocation" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo base_url(); ?>assets/js_admin/adminLocation.js"></script>
