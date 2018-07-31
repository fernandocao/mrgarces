      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Productos</a>
        </li>
        <li class="breadcrumb-item active">Administrador de productos</li>
      </ol>
      <!-- Boton -->
         
    <div class="row">
        <div class="form-group col-md-12">
            <p class="lead float-right">¿Nuevo proveedor?.Clic<a href=".agregarproveedor" data-toggle="modal"> aquí</a></p>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6  ml-auto mb-3 pr-0">
        <div class="card text-white bg-info o-hidden h-100">
          <a class="card-body text-white" onclick="resetearFormulario();" id="btnagrearproducto" data-toggle="modal" data-target=".registrarproducto" href="">
          <div class="card-body-icon">
             <i class="fa fa-fw fa-cart-plus"></i>
          </div>
          <div class="">Registrar Producto
          </div>
        </a>
      </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fa fa-calendar"></i> Productos</div>
        <div class="card-body">

            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="obtener_producto(1)" >En inventario</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="obtener_producto(0)" >Bajas</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="obtener_producto(2)">Todos</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">              
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" >
                <div class="container-fluid" id="divinventario"></div>  
            </div>              

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">                
                <div class="container-fluid" id="divbajas"></div>  
            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="container-fluid" id="divtodos"></div>  
            </div>
        </div>
    </div>
</div>

    
   
                    
    
    <!--INICIO MODAL-->
    <!--MODAL REGISTRAR PRODUCTO-->

    <div class="modal fade registrarproducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-tittle" id="exampleModalLabel"><b>INFORMACION PRODUCTO</b></h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"></button><span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <form action="" id="frmregistrarproducto" name="frmregistrarproducto" method="POST" >
                        <div class="row">
                           <div class="col-md-12">
                               <div class="row">
                                   <div class="form-group col-md-12">                                      
                                       <select name="sucursal" id="sucursal" class="form-control" required >
                                          <option value="">Sucursal</option>
                                           <option value="1">1</option>
                                           <option value="2">2</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">                                      
                                       <select name="id_proveedor" id="id_proveedor" class="form-control"></select>
                                   </div>
                               </div>   
                           </div>
                           <div class="col-md-6" id="foto_div">
                                <div class="row">
                                    <div class="form-group col-md-12" id="div_foto">
                                        <img alt="" class="rounded mx-auto d-block rounded-0" id="img_producto">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="btn_foto" id="label_foto" class="btn btn-info btn-lg btn-block rounded-0">IMAGEN PRODUCTO</label>
                                        <input value="Añadir foto" id="btn_foto" name="btn_foto" type="file" style="visibility: hidden;" accept=".jpg" required>
                                    </div>
                                </div>
                            </div>
                            <style type="text/css">
                                #foto_div{                                    
                                    width: 100%;
                                    height: 300px;
                                    margin-bottom: 25px;
                                }
                                
                                #div_foto{
                                    height: 300px;
                                    width: 190px;
                                }
                                
                                #img_producto{
                                    max-height: 100%;
                                    max-width: 100%;
                                }
                            </style>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" id="categoria" name="categoria" required>
                                            <option value="">Tipo producto</option>
                                            <option value="1">Barbería</option>
                                            <option value="2">Accesorios</option>
                                            <option value="3">Boutique</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="row">
                                   <div class="form-group col-md-12">
                                       <input type="text" placeholder="Producto . . ." class="form-control" id="modelo" name="modelo" required>
                                   </div>                                   
                                    <!--<div class="form-group col-md-12">
                                        <div class="input-group">                                     
                                          <input type="text" name="serie" class="form-control" id="serie" placeholder="Numero de serie . . ." minlength="1" maxlength="15">
                                          <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="btnagregarnoserie" name="btnagregarnoserie"><i class="fa fa-plus"></i> </button>
                                          </div>
                                        </div>
                                    </div>-->                                       
                                </div> 
                                <div class="row">
                                   <div class="form-group col-md-12">
                                       <input type="text" class="form-control" id="marca" name="marca" required placeholder="Marca . . .">
                                   </div>
                                    <!--<div class="form-group col-md-12">
                                        <select multiple size="11" name="noserie" id="noserie" class="form-control">                   
                                        </select>
                                    </div>-->
                                </div>  
                                <hr class="featurette-divider">
                                <p class="lead text-center">Costo producto</p>
                                <div class="row">
                                    <div class="form-group col-md-12">                                
                                        <div class="input-group mt-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input type="text" class="form-control" id="costo_unitario" name="costo unitario" required placeholder="Precio compra . . .">
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-12">                                
                                        <div class="input-group mt-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                            <input type="text" class="form-control" id="precio_venta" name="precio_venta" required placeholder="Precio venta . . .">
                                        </div>
                                    </div>
                                </div>
                                                                                                
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <p class="lead text-center">Detalle producto</p>                        
                        <div class="row">
                            <div class="col-md-12">                                
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label>Codigo proveedor / Codigo barras</label>
                                        <input type="text" class="form-control" id="codigo_interno" name="codigo_interno" required>
                                    </div>                          
                                    <div class="form-group col-md-4">
                                        <label for="">Stock</label>
                                        <input type="text" class="form-control" id="stock" name="stock" required>
                                    </div>                      
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Existencias</label>
                                        <input type="text" class="form-control" id="existencia" name="existencia" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Medida</label>
                                        <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <hr class="featurette-divider">                                                
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="id_producto" name="id_producto" value="0" hidden>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-secondary float-right" value="Finalizar" id="btnregistrarproducto" name="btnregistrarproducto">
                    </form>
                </div>
                <!--<div class="modal-footer">                    
                </div>-->
            </div>
        </div>
    </div>
    
    <!--MODAL REGISTRAR PRODUCTO--> 
    <!--FIN MODAL-->
    
    <!--INICIO MODAL-->
    <!--MODAL PERFIL PRODUCTO-->
    
    <div class="modal fade perfilproducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title"><b>DETALLE PRODUCTO</b></h5>
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
    
    <!--<div class="modal fade productosBajas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark rounded-0 text-white">
                    <h5 class="modal-title">LISTA DE PRODUCTOS ELIMINADOS</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close"></button><span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                   <div class="row">
                       <div class="form-group col-md-12">
                           <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar producto . . .">
                       </div>
                   </div>
                    <div class="row">
                        <div class="container-fluid" id="productos_eliminados">
                                
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary rounded-0" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>-->
    
    <!--FIN MODAL-->
    <!--MODAL PRODUCTOS ELIMINADOS-->
