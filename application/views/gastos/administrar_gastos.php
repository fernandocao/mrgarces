
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Gastos</a>
        </li>
        <li class="breadcrumb-item active">Administrador de gastos</li>
      </ol>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!--<p class="h3">Administrador de proveedores</p>-->
        </div>
    </div>
    <div class="row pr-0">
    <div class="col-xl-3 col-sm-6 mb-3 ml-auto pr-0">
          <div class="card text-white bg-info o-hidden h-100">
            <a class="card-body text-white" id="btnagregargasto" data-toggle="modal" data-target=".agregargasto" href="">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-money"></i>
              </div>
              <div class="mr-5">Nuevo Gasto
              </div>
            </a>
          </div>
        </div>
    </div>
</div>
<div  class="container-fluid">
<nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active activos" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="obtenergastos('1')" >Activos</a>
        <a class="nav-item nav-link bajas" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="obtenergastos('0')" >Bajas</a>
        <a class="nav-item nav-link todos" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="obtenergastos('2')">Todos</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Gastos activos</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 reporte " ></div>  
            </div>
            <div class="card-footer small text-muted">Gastos activos</div>   
        </div>
      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Gastos inactivos</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 p-0 reporte"></div>  
            </div>
            <div class="card-footer small text-muted">Gastos inactivos</div>   
        </div>
      
      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Todos los gastos</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 reporte" ></div>  
            </div>
            <div class="card-footer small text-muted">Todos los gastos</div>   
        </div>
      
      </div>

    </div>
</div>
<!--Modal Agregar Proveedor-->
<div class="modal fade agregargasto rounded-0" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <input type="text" id="id_tipogasto" name="id_tipogasto" value="0" hidden>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="text-small">Fecha</label>
                            <input type="text" class="form-control border-none" id="fecha" name="fecha" value="<?php echo date("Y-m-d H:i:s");?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            
                            <label for="gastostipo"> Tipo de gasto</label>
                            <input type="text" class="form-control" name="gastostipo" id="gastostipo">
                        </div>
                    </div>



                    <div class="row mb-5">
                        <div class="col-md-12">
                            <label for="tipopago">Tipo de pago</label>
                            <select class="form-control" name="tipopago" id="tipopago">
                                <option value="0">Efectivo</option>
                                <option value="1">Tarjeta</option>
                                <option value="2">Caja chica</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-right mr-0">
                            <label class="lead font-weight-bold">Monto total:</label>
                        </div>
                        <div class="form-group col-md-6 ml-auto">
                            <input type="text" class="form-control rounded-0" id="monto" name="monto" maxlength="50" required >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Observaciones</label>
                            <textarea class="form-control rounded-0" id="observaciones"  rows="4" name="observaciones"></textarea>
                        </div>
                    </div>
       
                    <div class="row mt-3">
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-secondary rounded-0 float-right" id="btnregistrargasto" name="btnregistrargasto">
                            <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--
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
-->
