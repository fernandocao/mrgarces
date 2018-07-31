<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	</head>
	<body class="bg-principal" style="background: linear-gradient(90deg, rgba(0,0,0, 0.7) 0%, rgba(0, 0,0 , 0.7) 100%), url('<?php echo base_url('assets/img/bg_principal.jpg');?>') fixed;   background-size: cover;
  background-repeat: no-repeat;">
	<?php
	$usuario = array('class'=>'form-control','name' => 'usuario');
	$password = array('class'=>'form-control', 'name' => 'password');
	$submit = array('class' => 'btn btn-outline-secondary btn-lg btn-block rounded-0 mt-2','name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
	?>
	<div class="container d-flex" id="contenedor_principal">
	    <div class="my-auto p-0" id="contenedor">
	        <div class="container my-auto">
	            <div class="row">
	                <div class="col-12 col-sm-6 col-md-5 col-lg-6 mx-auto my-auto" style="background: black;">
                        <img src="<?php echo base_url('assets/img/logo_blanco.png');?>" class="rounded mx-auto d-block mx-auto my-auto" width="100%;" alt="Responsive image">
                        <hr class="featurette-divider" style="background: white;" />
                        <p class="h3 text-center" style="color: white;">LA EXPERIENCIA DE SER UN CABALLERO</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mx-auto my-auto" style="height: 100%;">
                        <h3 class="text-center">Iniciar Sesión</h3>
                                <?php echo form_open('Login/nuevo_usuario');    ?>
                        <div class="col-md-8 mx-auto">
                            <div class="form-group">
                                <label class="small"for="usuario">Nombre de usuario</label>
                                <?=form_input($usuario)?><p><?=form_error('usuario')?></p>
                                
                            </div>
                        </div>
                        <div class="col-md-8 mx-auto">
        					<div class="form-group">
        					    <label class="small" for="password">Introduce tu password
                                </label>
        					    <?=form_password($password)?><p><?=form_error('password')?></p>
                                
        					</div>
                        </div>
    					<?= form_hidden('token',$token)?>
                        <div class="col-md-8 mx-auto">
                            <div class="form-group">
                        <?= form_submit($submit)?>
                            </div>
                        </div>
    					
    					<?php form_close()?>
    					<?php 
    					if($this->session->flashdata('usuario_incorrecto'))
    					{
    					?>
    					<p><?=$this->session->flashdata('usuario_incorrecto')?></p>
    					<?php
    					}
    					?>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
    <footer class="container-fluid text-center fixed-bottom" style="color:white;">
        <p class="lead"> Página en desarrollo por: <a style="text-decoration: none; color: white; font-weight: bold;" href="https://www.IdeazMX.com"> IdeazMX</a></p>
    </footer>
