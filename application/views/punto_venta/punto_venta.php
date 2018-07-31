      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Punto de Venta</a>
        </li>
        <li class="breadcrumb-item active">Realizar una venta</li>
      </ol>
      <div class="card">
        <form method="post" id="frmrealizarventa">
        <input type="text" name="id_venta" id="id_venta" value="0" hidden />
        <div class="card-header" >
          <div class="row">

            <div class="col-md-8 input-group">                  
              <input type="text" name="id_articulo" id="id_articulo" value="0" hidden />
              <input type="text" name="id_servicio" id="id_servicio" value="0" hidden />
              <input type="text" name="servicios" id="servicios" value="0" hidden />
              <input type="text" class="input form-control" name="articulo" id="articulo" placeholder="Escriba la descripción del articulo, servicio, promoción o paquete." />
              <input type="text" name="tipo" id="tipo" value="0" hidden />
              <input type="text" name="precio" id="precio" value="0" hidden />
              <input type="text" name="existencia" id="existencia" value="0" hidden />
              <i class="fa fa-shopping-cart btn" id="btnagregararticulo"> Agregar a la venta</i> 
            </div>              
            <div class="col-md-4   text-right">                  
<!--               <?php echo date('l j \of F Y');?> -->
              <select class="form-control" id="barbero" name="barbero"></select>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="row mt-3">
                <div class="col-md-12 table-responsive" id="divarticulos"></div>                
              </div>
            </div>
            <div class="col-md-4 p-3">
              <div class="row" >
              <div class="col-md-12 p-3 " style="border: 2px dashed #ccc; ">

              <div class="row mb-2">              
                <div class="col-md-12  input-group">                                
                  <input type="text" name="id_cliente" id="id_cliente" value="0" hidden />
                  <input type="text" class="input form-control" name="cliente" id="cliente" placeholder="Público en general" />
                  <i class="fa fa-user-plus btn" id="btnagregarpersonal" data-toggle="modal" data-target="#modalagregarpersonal"></i> 
                  <i class="fa fa-search btn" id="btnmostrarhistorial" data-toggle="modal" data-target="#modalverhistorial" hidden></i>
                </div>
              </div>

              <div class="row" >
                <div class="col-md-12">
                  <div class="row" >
                    <div class="col-md-6">                                                          
                    <p class = "float-right" style="color: #491">Descuento:</p>
                    </div>
                    <div class="col-md-6">                                                          
                      <div class="input-group">
                        <i class="btn">%</i> 
                        <input type="number" min="0" max="100" class="input form-control" name="descuento" id="descuento" value="0" />
                      </div>
                    </div>

                    <div class="col-md-6">                      
                      <p class = "float-right" style="color: #491">Subtotal:</p>
                    </div>
                    <div class="col-md-6">                      
                      <div class="input-group">
                        <i class="fa fa-dollar btn"></i> 
                        <input type="text" class="input form-control" name="gsubtotal" id="gsubtotal" value="0" readonly />
                      </div>
                    </div>
                    <div class="col-md-6">                      
                      <p class = "float-right" style="color: #491">Total:</p>
                    </div>
                    <div class="col-md-6">                      
                      <div class="input-group">
                        <i class="fa fa-dollar btn"></i> 
                        <input type="text" class="input form-control"  name="gtotal" id="gtotal" value="0" readonly />
                      </div>
                    </div>                    

                    <div class="col-md-6">                      
                      <p class = "float-right" style="color: #491">Pago:</p>
                    </div>
                    <div class="col-md-6">                      
                      <div class="input-group">
                        <i class="fa fa-dollar btn"></i> 
                        <input type="text" class="input form-control"  name="pago" id="pago" value="0" />
                      </div>
                    </div>                    

                    <div class="col-md-6">                      
                      <p class = "float-right" style="color: #491">Cambio:</p>
                    </div>
                    <div class="col-md-6">                      
                      <div class="input-group">
                        <i class="fa fa-dollar btn"></i> 
                        <input type="text" class="input form-control"  name="cambio" id="cambio" value="0" readonly />
                      </div>
                    </div>                    

                  </div>
                </div>  
              </div>
             <div class="row mt-2">
                <div class="col-md-12 input-group">                  
                  <textarea type="text" class="input form-control" row=3 name="observaciones" id="observaciones" placeholder="Observaciones"></textarea>
                </div>
              </div>  
              </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-12 input-group">                  
                  <button class="btn btn-info form-control">Completar venta</button>
                </div>
              </div>  


            </div>
            
          </div>
        </div>
        <div class="card-footer small text-muted">Todas las ventas deben contener al menos un articulo, paquete o promoción.</div>   
        </form>
    </div>   

    <div class="modal fade" id="modalverhistorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="card">
                  <div class="card-header">
                      <p class="h4">Historial de servicios</p>
                  </div>
                  <div class="card-body">   
                      <div class="row" id="divhistorial"> </div>
                  </div>
                  <div class="modal-footer">
                      <div class="form-group col-md-12">
                          <a type="button" class="btn btn-secondary rounded-0 float-right mr-3 text-white" data-dismiss="modal">Cerrar</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>

<script type="text/javascript">
  var url="Punto_venta";
  var urlpersonas="<?php echo site_url('personas/Administrar_clientes'); ?>";
</script>