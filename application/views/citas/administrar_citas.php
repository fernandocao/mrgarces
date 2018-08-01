      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Citas</a>
        </li>
        <li class="breadcrumb-item active">Administrador de citas</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-9 col-sm-8 mb-3" ></div>
        <div class="col-xl-3 col-sm-4 mb-3" >          
          <div class="card text-white bg-info o-hidden h-75">
            <a class="card-footer text-white clearfix small z-1" id="btnagendarcita" href="#" data-toggle="modal" data-target="#modalagendarcita">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-calendar"></i>
              </div>              
              <div>Agendar cita
              </div>
            </div>
            </a>
          </div>          
        </div>
      </div>
      <div class="card">
        <div class="card-header" ><i class="fa fa-calendar"></i> Citas agendadas</div>
        <div class="card-body">
          
          <div id='calendar' ></div>                            
<!--          
          <div class="table-responsive" >
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
              <tbody>
            
              </tbody>
            </table>
          </div>
-->              
        </div>
        <div class="card-footer small text-muted">* Las citas agendadas se mostraran durante todo el mes</div>   
    </div>   

<!--Modal registrar personal-->
<div class="modal fade" id="modalagendarcita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="container-fluid">
                   <div class="card">
                    <div class="card-header">
                        <p>Agendar cita</p>
                    </div>
                    <div class="card-body">
                        <form method="post" id="frmagendarcita">
                            <input type="text" id="id_cita" name="id_cita" value="0" hidden />
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="row" >
                                        <div class="form-group col-md-8">
                                            <label>Barbero</label>
                                            <input type="text" id="id_barbero" name="id_barbero" value="0" hidden />
                                            <input type="text" id="correobarbero" name="correobarbero" value="" hidden />
                                            <input type="text" class="form-control" id="barbero" name="barbero" >
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Fecha y hora</label>
                                            <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d').' 9:00';?>">
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Cliente</label>
                                            <input type="text" id="id_cliente" name="id_cliente" value="0" hidden="" />
                                            <input type="text" id="correocliente" name="correocliente" value="" hidden />
                                            <input type="text" class="form-control" id="cliente" name="cliente">
                                        </div>                                        
                                    </div>
                                    <div class="row" >
                                        <div class="form-group col-md-12">
                                            <label>servicio</label>
                                            <input type="text" class="form-control" id="id_servicio" name="id_servicio" hidden />
                                            <input type="text" class="form-control" id="duracion" name="duracion" hidden />
                                            
                                            <div class="input-group">                                                
                                              <input type="text" class="form-control" id="servicio" name="servicio" />
                                              <i id="btnagregarservicio" class="fa fa-plus btn"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                            <div class="col-md-8"><label>Servicios solicitados</label></div>
                                            <div class="col-md-4"><label>Duración(Min.)</label></div>
                                            <div id="divservicios" class="col-md-12"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4" id="divcitas" > </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <input type="submit" class="btn btn-secondary  float-right" value="Agendar Cita" id="btnregistrarcita" name="registrarbarbero">
                                    <a type="button" class="btn btn-outline-secondary  float-right mr-3"  data-dismiss="modal">Cerrar</a>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- container wrapper cabecera   -->          
    </div>
</div>


<div class="modal fade " id="modalverperfil" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white ">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">PERFIL PERSONA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
            <div class="row"id="contenedorperfil"> 
                </div>
                   <div class="row mt-3">
                        <div class="form-group col-12">
                            <input type="submit" class="btn btn-secondary  float-right" value="Registrar usuario" id="btnregistrarbarbero" name="registrarbarbero">                        
                            <a type="button" class="btn btn-secondary  float-right mr-3 text-white" data-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">var url="Administrar_citas";</script>    