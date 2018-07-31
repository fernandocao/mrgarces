
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Gastos</a>
        </li>
        <li class="breadcrumb-item active">Administrador de gastos</li>
      </ol>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
    <div class="row pr-0">
    <div class="col-xl-3 col-sm-6 mb-3 ml-auto pr-0">
          <div class="card text-white bg-info o-hidden h-100">
            <a class="card-body text-white" id="btnagregarproveedor" data-toggle="modal" data-target=".agregarproveedor" href="">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div class="mr-5">Registrar gasto
              </div>
            </a>
          </div>
        </div>
    </div>
</div>
<div  class="container-fluid p-0">
    <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-money"></i> Administrador de gastos</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2" id="reporte"></div>  
            </div>
            <div class="card-footer small text-muted">Administrador de gastos</div>   
        </div>
    </div>

<!--Modal Agregar Proveedor-->a
<div class="modal fade agregarproveedor rounded-0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header rounded-0">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Registrar gastos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">

                <form method="post" id="frmregistrargasto" name="frmregistrargasto">
                    <input type="text" id="id_gasto" name="id_gasto" value="0" hidden>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="text-small">Fecha</label>
                            <input type="text" class="form-control border-none" id="fecha" name="fecha" readonly="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Tipo de gasto</label>
                            <select class="form-control" name="tipo_gasto" id="tipo_gasto">
                                <option value="0">Seleccione un tipo de gasto</option>
                                <option value="0">Producto</option>
                                <option value="1">Fijo</option>
                                <option value="2">General</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Concepto</label>
                            <input type="text" class="form-control rounded-0" id="descripcion" name="descripcion" required>
                        </div>
                    </div>

                    <div class="row cantidad">
                        <div class="form-group col-md-6">
                            <label>Cantidad</label>
                            <input type="number" class="form-control rounded-0" min="1" max="999" id="cantidad" name="cantidad" value="1" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Costo Unitario</label>
                            <input type="number" class="form-control rounded-0" id="costo_unitario" name="costo_unitario" maxlength="50" value="50" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 text-right mr-0">
                            <label class="lead font-weight-bold">Monto total:</label>
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            
                            <input type="text" class="form-control rounded-0" id="monto_total" name="monto_total" maxlength="50" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Comentarios</label>
                            <textarea class="form-control rounded-0" id="comentario"  rows="4" name="comentario">
                            </textarea>
                        </div>
                    </div>
       
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-secondary rounded-0 float-right" id="btnregistrarproveedor" name="btnregistrarproveedor">
                            <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal del perfil del proveedor-->
<div class="modal fade perfilproveedor rounded-0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white rounded-0">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">PERFIL PROVEEDOR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
            <div class="row" id="contenedorperfil"> 
                </div>
                   <div class="row mt-3">
                        <div class="form-group col-12">
                            <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


      