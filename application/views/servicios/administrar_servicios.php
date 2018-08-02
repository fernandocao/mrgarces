   
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Tienda</a>
        </li>
        <li class="breadcrumb-item active">Administrador de servicios</li>
      </ol>
      <!-- Boton -->
    <div class="row mb-3">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="card text-white bg-info o-hidden h-100">
              <a class="card-body text-white" id="" data-toggle="modal" data-target="#registrarservicio" href="">
              <div class="card-body-icon">
                 <i class="fa fa-fw fa-tags"></i>
              </div>
              Registrar Servicio
            </a>
          </div>
        </div>
    </div>

    <!-- fIN BOTON -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-tags"></i> Servicios
        </div>
        <div class="card-body p-0">
            <div id="divreporte" > </div>                                
        </div>
    </div>

    <!--INICIO MODAL-->
    <!--MODAL REGISTRAR SERVICIO-->

    <div class="modal fade" id="registrarservicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Servicios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" id="frmregistrarservicio" name="frmregistrarservicio" method="POST">
                <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="id_servicio" id="id_servicio" value="0" hidden />
                            <label>Descripción (Las sugerencias mostradas son de referencia)</label>
                            <input type="text" placeholder="Describa el servicio" name="descripcion" id="descripcion" class="form-control" required />
                        </div>
                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Precio</label>
                                <input type="number" min="0" value="0" placeholder="Precio" name="precio" id="precio" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Duración</label>
                                <div class="input-group">
                                    <input type="number" min="1" value="1" placeholder="Duracion" name="duracion" id="duracion" class="form-control" required><label> Minuto(s)</label>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="submit" name="btnagregarservicio" id="btnagregarservicio" class="btn btn-secondary float-right" value="Finalizar">
                    </div>                      
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--MODAL REGISTRAR SERVICIO-->
    <!--FIN MODAL-->

