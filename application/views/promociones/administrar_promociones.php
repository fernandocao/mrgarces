 
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Promociones</a>
        </li>
        <li class="breadcrumb-item active">Administrador de Promociones</li>
      </ol>

<!--Encabezado de promociones-->
  <div class="row pr-0">
    <div class="container-fluid pr-0">

    <h4>Administrador de promociones
    </h4>
    <div class="col-xl-3 col-sm-6  ml-auto mb-3 pr-0">
        <div class="card text-white bg-info o-hidden h-100">
          <a class="card-body text-white" id="btnagregarpromocion" data-toggle="modal" data-target=".agregarpromocion" href="">
          <div class="card-body-icon">
             <i class="fa fa-fw fa-gift"></i>
          </div>
          <div class="">Nueva Promoción</div>
        </a>
      </div>
    </div>
    </div>
  </div>
<!---Empiezan las tabs -->
<div  class="container-fluid">
<nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active activos" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="obtenerpromociones('1')" >Activos</a>
        <a class="nav-item nav-link bajas" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="obtenerpromociones('0')" >Bajas</a>
        <a class="nav-item nav-link todos" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="obtenerpromociones('2')">Todos</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Promociones activas</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 reporte" ></div>  
            </div>
            <div class="card-footer small text-muted">Promociones activas</div>   
        </div>
      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Promociones inactivas</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 p-0 reporte"></div>  
            </div>
            <div class="card-footer small text-muted">Promociones inactivas</div>   
        </div>
      
      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Todas las promociones</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 reporte" ></div>  
            </div>
            <div class="card-footer small text-muted">Todas las promociones</div>   
        </div>
      
      </div>

    </div>
</div>



<!---Terminan las tabs -->


<!--
<div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> Administrador de Promociones
    </div>
    <div class="card-body p-0">
        <div id="divreporte"> </div>                                
      </div>
  </div>
-->
</div>

<!--Fin encabezado de promociones-->

<!--Inicia modal de promociones-->
<div class="modal fade agregarpromocion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="">
  <div class="mx-auto mt-5 modal-dialog modal-lg" style=" width:820px !important;">
<!--Contenido del modal-->
    <div class="modal-content">
<!--Encabezado del Modal-->
   	 	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">NUEVA PROMOCIÓN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">×</span>
        </button>
      </div>
<!--Cuerpo del modal-->
      <div class="modal-body">
        <div class="container-fluid">
          <h4 class="lead font-weight-bold">Instrucciones:</h4>
          <p class="text-muted">Para crear una promoción elegir un producto o servicio,una vez seleccionado presionar el botón agregar</p>
          <hr>
<!--Inicia Formulario registro de promociones-->
          <form method="POST" id="frmpromocion">
            <input type="text" id="id_promo" name="id_promo" value="0"  hidden/>
            <label >Nombre de la promoción</label>
            <input class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese la clave o descripción de algun servicio" type="text" required>
          <div class="row mt-2">
            <div class="form-group col-md-6">
              <label >Fecha Inicio</label>
              <input type="text" class="form-control rounded-0" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group col-md-6">
              <label >Fecha Fin</label>
              <input type="text" class="form-control rounded-0" id="fecha_fin" name="fecha_fin" required>
            </div>
          </div>
<!--Campo autocompletar servicio-->
            <label>Agregar concepto a la promoción</label>
            <div class="row">
              <div class="col-md-12 form-group">
                <input id="id_servicio" name="id_servicio" type="text" hidden readonly>
                <input class="form-control ui-autocomplete-input" id="descripcion_servicio" name="descripcion_servicio" placeholder="Ingrese la clave o descripción de algun servicio o producto" autocomplete="off" type="text">
              </div>
              <div class="col-md-3">
                <input id="id_producto" name="id_producto" type="text" hidden readonly>
                <button class="btn btn-secondary form-control" id="btnagregarserviciopromo" name="btnagregarserviciopromo" hidden>
                  <i class="fa fa-plus"> </i> Agregar
                </button>
              </div>
            </div>

<!--Campo autocompletar Producto

            <h4 class="lead">Agregar un producto</h4>
            <div class="row">
              <div class="col-md-9 form-group">
                <input class="form-control ui-autocomplete-input" id="descripcion_producto" name="descripcion_producto" placeholder="Ingrese la clave o   descripción de algun producto" autocomplete="off" type="text">
              </div>
              <div class="col-md-3">
                <button class="btn btn-secondary form-control" id="btnagregarproductopromo" name="btnagregarproductopromo" >
                  <i class="fa fa-plus"> </i> Agregar
                </button>
              </div>
            </div>
            --> 
           <hr> 

<!--Inicia lista de productos-->            
          <div class="row">
            <div class="col-md-9">
              <h4>Lista de productos o servicios que se incluyen</h4>
            </div>
            <div class="col-md-3">
              <button class="btn btn-secondary form-control" id="borrarlista" name="borrarlista">
                <i class="fa fa-minus-circle"></i> Borrar Lista
              </button>
            </div>
          </div>
          <hr>  
<!--Encabezados de la lista-->
          
          <div class="row form-group">
            <div class="col-md-1"></div>
            <div class="col-md-3">
              <p class=" ">Descripción</p>
            </div>
            <div class="col-md-2">
              <p class=" ">Cantidad</p>
            </div>
            <div class="col-md-2">
              <p class="">P. Compra</p>
            </div>
            <div class="col-md-2">
              <p class="">P. Venta</p>
            </div>
            <div class="col-md-2">
              <p class="">Subtotal</p>
            </div>
          </div>
<!--Div contenido promocion-->
          <div id="contienelista"></div>

          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9 text-right"><h4 class="lead ">Precio Promoción</h4></div>
            <div class="col-md-2">
              <input class="form-control" name="precio_promo" id="precio_promo" type="text" value="0.00" required readonly>
            </div>
            

          </div>
          <div class="modal-footer mt-2">
          <div class="row">
            <div class="ml-auto mr-2">
              <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Cancelar</button>
            </div>
            <div class="">
              <button id="btnregistrarpromo" type="submit" class="btn btn-secondary form-control">Aceptar</button>
            </div>
          </div>  
          </div>
      </form>
<!--Termina Form-->      
    </div>
  </div>
</div>
</div>
</div>
</div>