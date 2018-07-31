    </div><!-- /.container-fluid-->    
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright @Mr.Garcés 2018 / Desarrollo: <a style="text-decoration: none; color: black; font-weight: bold;" href="https://www.IdeazMX.com"> IdeazMX</a>
          </small>        
        </div>
      </div>
    </footer>       
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    
    <!-- Cerrar sesion Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seguro que desea cerrar la sesión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Presione "Cerrar sesión" si esta seguro que cerrara la sesión.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?php echo site_url('login/cerrar_sesion');?>">Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/jquery/jquery.min.js");?>" ></script>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.datetimepicker.full.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/jquery/jquery-ui.js");?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.validate.js");?>" ></script>
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js");?>"></script> 
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/jquery-easing/jquery.easing.min.js");?>"></script> 
<!--
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/chart.js/Chart.min.js");?>"></script> 
-->
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/datatables/jquery.dataTables.js");?>"></script> 
    <script type="text/javascript" src="<?php echo base_url("assets/vendor/datatables/dataTables.bootstrap4.js");?>"></script> 
    <script type="text/javascript" src="<?php echo base_url("assets/js/sb-admin.min.js");?>"></script> 
    <script type="text/javascript" src="<?php echo base_url("assets/js/sb-admin-datatables.min.js");?>"></script> 
<!--
    <script type="text/javascript" src="<?php echo base_url("assets/js/sb-admin-charts.min.js");?>"></script> 
-->    
    <script type="text/javascript" src="<?php echo base_url("assets/js/toastr.min.js");?>" ></script>             
    <script type="text/javascript" src="<?php echo base_url("assets/js/moment.min.js");?>" ></script>             
    <script type="text/javascript" src="<?php echo base_url("assets/js/fullcalendar.js");?>" ></script>             
    <script src="<?php echo base_url('assets/js/jquery-confirm.js');?>"></script>
    <script src="<?php echo base_url('assets/js/comunes.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url($libreria);?>"></script>  
    <script type="text/javascript" src="<?php if(isset($libreriaextra)) echo base_url($libreriaextra); ?>"></script>  

  </div> <!-- /.content-wrapper-->
</body>
</html>

