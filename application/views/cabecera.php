<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Mr. Garcés V0.180716
  </title> 
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sb-admin.css');?>">
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.datetimepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-confirm.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.theme.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/toastr.min.css");?>" />  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/fullcalendar.css");?>" />  
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">

</head> 
<body class="fixed-nav sticky-footer " id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top menuimagen" id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav menuimagen" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <img src="<?php echo base_url('assets/img/logo_blanco.png');?>" alt="Responsive image" class="rounded mx-auto d-block mx-auto my-auto" width="45%" height="50%">
          <a class="nav-link" href="#">
            <i class="ion-ios-home-outline"></i>
            <span class="nav-link-text">Inicio</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Punto de venta">
          <a class="nav-link" href="<?php echo site_url('punto_venta/punto_venta'); ?> ">
            <i class="fa fa-shopping-bag"></i>
            <span class="nav-link-text">Punto de Venta</span>
          </a>
        </li>  
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Agendar cita">
          <a class="nav-link" href="<?php echo site_url('citas/administrar_citas'); ?> ">
            <i class="fa fa-calendar"></i>
            <span class="nav-link-text">Agendar cita</span>
          </a>
        </li>         
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gastos">
          <a class="nav-link" href="<?php echo site_url('gastos/administrar_gastos');?>">
            <i class="fa fa-money"></i>
            <span class="nav-link-text">Gastos</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tienda">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-building-o"></i>
            <span class="nav-link-text">Tienda</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Productos">
              <a class="nav-link" href="<?php echo site_url('productos/administrar_productos'); ?> ">
                <i class="fa fa-cart-plus"></i>
                <span class="nav-link-text">Inventario</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Servicios">
              <a class="nav-link" href="<?php echo site_url('servicios/administrar_servicios'); ?> ">
                <i class="fa fa-tags"></i>
                <span class="nav-link-text">Servicios</span>
              </a>
            </li>             
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Promociones">
              <a class="nav-link" href="<?php echo site_url('promociones/administrar_promociones'); ?> ">
                <i class="fa fa-gift"></i>
                <span class="nav-link-text">Promociones</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Proveedores">
              <a class="nav-link" href="<?php echo site_url('proveedores/administrar_proveedor'); ?> ">
                <i class="fa fa-truck"></i>
                <span class="nav-link-text">proveedores</span>
              </a>
            </li>            
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Personal">
          <a class="nav-link" href="<?php echo site_url('personas/administrar_personas'); ?> ">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Personal</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Clientes">
          <a class="nav-link" href="<?php echo site_url('personas/administrar_clientes'); ?> ">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Clientes</span>
          </a>
        </li>             
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reportes">
          <a class="nav-link" href="<?php echo site_url('reportes/reportes'); ?> ">
            <i class="fa fa-copy"></i>
            <span class="nav-link-text">Reportes</span>
          </a>
        </li>             

      </ul>      
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu rounded-0" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Nuevos mensajes:</h6>
            <div class="dropdown-divider"></div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todos los mensajes</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu rounded-0" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Alertas:</h6>
            <div class="dropdown-divider"></div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todas las alertas</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar Sesíon</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper" >
    <div class="container-fluid">