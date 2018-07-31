
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Proveedores</a>
        </li>
        <li class="breadcrumb-item active">Administrador de proveedores</li>
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
            <a class="card-body text-white" id="btnagregarproveedor" data-toggle="modal" data-target=".agregarproveedor" href="">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-circle-o"></i>
              </div>
              <div class="mr-5">Nuevo Proveedor
              </div>
            </a>
          </div>
        </div>
    </div>
</div>
<div  class="container-fluid">
<nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active activos" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="obtenerproveedor('1')" >Activos</a>
        <a class="nav-item nav-link bajas" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="obtenerproveedor('0')" >Bajas</a>
        <a class="nav-item nav-link todos" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="obtenerproveedor('2')">Todos</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Proveedores activos</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 reporte " ></div>  
            </div>
            <div class="card-footer small text-muted">Proveedores activos</div>   
        </div>
      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Proveedores inactivos</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 p-0 reporte"></div>  
            </div>
            <div class="card-footer small text-muted">Proveedores inactivos</div>   
        </div>
      
      </div>

      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-calendar"></i> Todos los proveedores</div>
            <div class="card-body p-0">
                <div class="container-fluid mt-2 reporte" ></div>  
            </div>
            <div class="card-footer small text-muted">Todos los proveedores</div>   
        </div>
      
      </div>

    </div>
</div>