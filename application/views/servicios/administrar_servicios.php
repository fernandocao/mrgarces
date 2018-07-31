  
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Servicios</a>
        </li>
        <li class="breadcrumb-item active">Administrador de servicios</li>
      </ol>
      <!-- Boton -->

    <div class="col-xl-3 col-sm-6  ml-auto mb-3 pr-0">
        <div class="card text-white bg-info o-hidden h-100">
          <a class="card-body text-white" id="" data-toggle="modal" data-target="#registrarservicio" href="">
          <div class="card-body-icon">
             <i class="fa fa-fw fa-tags"></i>
          </div>
          <div class="">Registrar Servicio
          </div>
        </a>
      </div>
    </div>
    <!-- fIN BOTON -->

        <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-calendar"></i> Administrador de servicios
        </div>
        <div class="card-body p-0">
            <div id="divreporte" > </div>                                
        </div>
    </div

<!--
    <div class="container-fluid">
        <div class="card rounded-0 mt-2 mb-3">
      
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-10">
                        <p class="lead text-justify"><b>Nota:</b> Al Agregar un servicio, añada una duración promedio del servicio, esto facilitara una mejor atención de clientes en la agenda de citas.</p>
                    </div>
                    <div class="form-group col-md-2">
                        <button id="add" name="add" class="btn btn-info float-right" data-target=".registrarservicio" data-toggle="modal" onclick="reset();">Agregar servicio</button>
                    </div>
                </div>                                                       
                <div class="row">
                    <div class="form-group col-md-12">
                        <p class="h2 text-center">SERVICIOS | PAQUETES</p>
                    </div>                    
                </div>                
                <hr class="featurette-divider">
                <div class="row">
                    <div class="col-md-7">
                        <p class="h2 text-center">Lista de servicios</p>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar servicio. . .">
                            </div>
                        </div>
                        <div class="row">
                            <div class="container-fluid" id="reporte">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <p class="h2 text-center">Crear paquete</p>
                        <form action="" method="post" id="frmcrearpaquete" name="frmcrearpaquete">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <input type="text" name="buscar_servicio" class="form-control" id="buscar_servicio" placeholder="Buscar servicio . . .">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="btnagregarservicio" name="btnagregarservicio">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="container-fluid" id="inputs">
                                
                            </div>
                        </div>
                        <hr class="featurette-divider">                       
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" placeholder="Nombre paquete" id="descripcion" name="descripcion" required>
                            </div>                                                                                                     
                        </div>     
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input required type="text" class="form-control" placeholder="Precio paquete" id="precio" name="precio">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="id_servicio" name="id_servicio" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="id_paquete" name="id_paquete" value="0">
                            </div>
                        </div>                           
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="submit" class="btn btn-secondary btn-lg btn-block float-right" value="Finalizar">
                            </div>
                        </div>                
                       </form>                        
                    </div>
                </div>
                <hr class="featurette-divider">
                <p class="h2 text-center">Paquetes disponibles</p>                
                <div class="row">
                    <div class="container-fluid" id="reporte_2">

                    </div>
                </div>                              
            </div>
            <div class="card-footer">
                <button class="btn btn-info" data-toggle="modal" data-target=".servicios_inhab">Servicios inhabilitados</button>                
                <button class="btn btn-primary float-right" id="btngenerarreporte" name="btngenerarreporte">Generar reporte</button>                
            </div>
        </div>
    </div>
-->    
    <div class="modal fade servicios_inhab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark rounded-0 text-white">
                    <h5 class="modal-title" id="exampleModalLabel">SERVICIOS INHABILITADOS</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="container-fluid" id="servicios_baja"></div>
                    </div>        
                </div>      
            </div>
        </div>
    </div>
    
                    
    
    <!--INICIO MODAL-->
    <!--MODAL REGISTRAR PAQUETE-->

    <div class="modal fade detallepaquete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white rounded-0">
                    <h5 class="modal-tittle" id="exampleModalLabel">PAQUETES DISPONIBLES</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"></button><span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">

                </div>
                <!--<div class="modal-footer">                    
                </div>-->
            </div>
        </div>
    </div>
    
    <!--MODAL REGISTRAR PAQUETE--> 
    <!--FIN MODAL-->

    <!--INICIO MODAL-->
    <!--MODAL REGISTRAR SERVICIO-->

    <div class="modal fade" id="registrarservicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark rounded-0">
                    <h5 class="modal-title text-white" id="exampleModalLabel">AGREGAR SERVICIO</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" id="frmregistrarservicio" name="frmregistrarservicio" method="POST">
                        <div class="form-group">
                            <input type="text" placeholder="Descripcion" name="descripcion" id="descripcionservicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Precio" name="precio" id="precioservicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Duracion" name="duracion" id="duracion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnagregarservicio" id="btnagregarservicio" class="btn btn-secondary float-right" value="Finalizar">
                        </div>  
                        <div class="form-group">
                            <input type="text" class="form-control" id="id_serviciop" name="id_serviciop" value="0" hidden>
                        </div>                      
                    </form>        
                </div>
            </div>
        </div>
    </div>

    <!--MODAL REGISTRAR SERVICIO-->
    <!--FIN MODAL-->

    
    <!--INICIO MODAL-->
    <!--MODAL PERFIL PRODUCTO-->
    
    <div class="modal fade perfilservicio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header bg-dark rounded-0 text-white">
                    <h5 class="modal-title">DETALLE PRODUCTO</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"></button><span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" id="perfil">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-0" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--MODAL PERFIL PRODUCTO-->
    <!--FIN MODAL-->
    
    <!--INICIO MODAL-->
    <!--MODAL PRODUCTOS ELIMINADOS-->
    
    <div class="modal fade paquetes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark rounded-0 text-white">
                    <h5 class="modal-title">LISTA DE PRODUCTOS ELIMINADOS</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"></button><span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" id="productos_eliminados">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-0" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--FIN MODAL-->
    <!--MODAL PRODUCTOS ACTUALIZADOS-->
