 
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a>Reportes</a></li>
      <li class="breadcrumb-item active">Selector de reportes</li>
    </ol>
      <!-- Boton -->
    <form id="frmreporte">
    <div class="row m-3">      
      <div class="col-md-4">
        <select class="form-control" id="tipo" name="tipo">
          <option value="1">Ventas</option>
        </select>
      </div>      
      <div class="col-md-8 border">
        
        <label>Opciones</label>
        <div class="row">
          <div class="col-md-4">
            <label>Rango</label>
            <select class="form-control" id="rango" name="rango">
              <option value="1">Hoy</option>
              <option value="2">Esta semana</option>
              <option value="3">Este mes</option>
              <option value="4">Este año</option>
              <option value="5">Todos</option>
              <option value="6">Personalizado</option>              
            </select>
          </div>
          <div class="col-md-4 divrango" hidden>
            <label>Fecha de inicio</label>
            <input type="text" class="form-control" name="fechainicio" id="fechainicio" value="<?php echo date('Y-m-d');?>" />
          </div>
          <div class="col-md-4 divrango" hidden>
            <label>Fecha de termino</label>
            <input type="text" class="form-control" name="fechafin" id="fechafin" value="<?php echo date('Y-m-d');?>" />
          </div>
        </div>      
        <div class="row m-2">
          <div class="col-md-12 text-right">
            <i class="fa fa-print btn btn-info" id="verreporte"> Vizualizar</i>
          </div>
        </div>
    </div>    
  </div>
  </form>  
    <!-- fIN BOTON -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-tags"></i> Reporte de
        </div>
        <div class="card-body p-0">
            <div id="divreporte" > </div>                                
        </div>
    </div>

    <script type="text/javascript">var url="<?php echo site_url('reportes/Reportes'); ?>";</script>    