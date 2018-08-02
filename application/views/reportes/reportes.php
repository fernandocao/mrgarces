 
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a>Reportes</a></li>
      <li class="breadcrumb-item active">Selector de reportes</li>
    </ol>
      <!-- Boton -->
    <div class="row m-3">
      <div class="col-md-6">
        <select class="form-control" id="seleccionareporte">
          <option value="1">Ventas</option>
        </select>
      </div>
      <div class="col-md-6 border">
        <label>Opciones</label>
        <div class="row">
          <div class="col-md-12">
            <select class="form-control" id="rango" name="rango">
              <option value="1">Hoy</option>
              <option value="3">Esta semana</option>
              <option value="4">Este mes</option>
              <option value="5">Este año</option>
              <option value="6">Todos</option>
              <option value="7">Personalizado</option>              
            </select>
          </div>
        </div>
      
        <div class="row m-2">
          <div class="col-md-12 text-right">
            <i class="fa fa-print btn btn-info" id="verreporte"> Vizualizar</i>
          </div>
        </div>
      </div>
    </div>

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