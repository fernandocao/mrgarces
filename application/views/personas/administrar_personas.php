  
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Personal</a>
		</li>
		 <li class="breadcrumb-item active">Administrador de personal</li>
	</ol>

	<div class="row">    	
    	<div class="col-md-9"></div>
    	<div class="col-md-3">
        	<div class="card text-white bg-info o-hidden h-100">
          		<a class="card-body text-white" id="btnagregarpersonal" data-toggle="modal" data-target="#modalagregarpersonal" href="">
	          		<div class="card-body-icon">
	             		<i class="fa fa-fw fa-user"></i>
	          		</div>
	          		<div class="">Registrar personal</div>
        		</a>
      		</div>
    	</div>    	
  	</div>
	<div class="card" id="divreporte">
	    <div class="card-header"><i class="fa fa-calendar"></i> Registros</div>
	    <div class="card-body">
	        <nav>
	          <div class="nav nav-tabs" id="nav-tab" role="tablist">
	            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="obtenerpersonal(1)" >Activos</a>
	            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="obtenerpersonal(0)" >Bajas</a>
	            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="obtenerpersonal(2)">Todos</a>
	          </div>
	        </nav>
	        <div class="tab-content" id="nav-tabContent">              
	            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" >
	                <div class="container-fluid" id="divactivos"></div>  
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
	<script type="text/javascript">var urlpersonas="<?php echo site_url('personas/Administrar_personas'); ?>";</script>    

