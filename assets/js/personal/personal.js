var usuariopersonalizado="";
 
$(document).ready(function() {
    inicializaformulario();
    llenarparentesco();
    inicializaautocomplementar();
    if($("#divreporte").html()!=undefined) obtenerpersonal(1);

});    

function inicializaformulario(){
    $("#frmregistrarbarbero")[0].reset();
    $("#habilidades").empty();  
    if (urlpersonas.slice(-8)=='clientes'){
        $("#tipo").val(5);
        $("#divclientes").removeAttr("hidden");
    }else{
        $("#tipo").val(0);
        $("#divpersonal").removeAttr("hidden");
    }      
}

function generausuario(){
    if(usuariopersonalizado==""){
        if($("#nombre").val()!="") $("#usuario").val($("#nombre").val().toLowerCase());
        if($("#apellido_paterno").val()!="") $("#usuario").val($("#usuario").val() + $("#apellido_paterno").val().toLowerCase().substring(0, 1));      
        if($("#apellido_materno").val()!="") $("#usuario").val($("#usuario").val() + $("#apellido_materno").val().toLowerCase().substring(0, 1));
        if($("#usuario").val()!="") validarusuario();
    }
}   

function validarusuario(){    
    $.ajax({
        data: {usuario:$("#usuario").val()},
        type: "POST",
        dataType: "json",
        url: urlpersonas+"/validarusuario",
        success: function(resultado){
            if(resultado.usuarios>0){                
                $("#usuario").val($("#usuario").val() + resultado.sugerencia);
                toastr.error("Se ha generado un nombre de usuario automatico.","El usuario ya existe",2500);
            }
            $("#password").val($("#usuario").val()); 
        }        
    });    
}

function obtenerpersonal(activo){
    console.log(activo);
    var obj = $.confirm({
        theme: 'supervan',
        content: function(){            
            var self = this;            
            return $.ajax({
                type: "POST",
                dataType: "json",
                url: urlpersonas+"/obtenerpersonal",
                data: {tipo:$("#tipo").val(), activo:activo}
            }).done(function (datos) {
                var fila = fila + '<div class="table-responsive"><table class="table table-stripped" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>ID</th><th>Nombre</th>';
                if($("#tipo").val()==5) fila = fila + '<th>Redes Sociales</th><th>Teléfono</th><th>Correo</th>';     
                else fila = fila + '<th>Tipo de sangre</th><th>Indicaciones médicas</th><th>Habilidades</th>';                
                fila = fila +  '<th class="text-center">CONTROL</th></tr></thead><tfoot><tr><th>ID</th><th>Nombre</th>';
                if($("#tipo").val()==5) fila = fila + '<th>Redes Sociales</th><th>Teléfono</th><th>Correo</th>';
                else fila = fila + '<th>Tipo de sangre</th><th>Indicaciones medicas</th><th>habilidades</th>';
                fila = fila + '<th class="text-center">CONTROL</th></tr></tfoot><tbody>';
                $.each(datos, function (key, value) {
                    fila = fila +   '<tr><td>'+value.id_persona+'</td><td>'+value.nombre+'</td>';
                    if($("#tipo").val() == 5) fila = fila + '<td> Facebook:'+value.facebook+'<br> Instagram:'+value.instagram+'</td><td>'+value.telefono+'</td><td>'+value.correo+'</td>';
                    else{
                        fila = fila + '<td>'+value.tipo_de_sangre+'</td><td>'+value.indicaciones_medicas+'</td>';                    
                        if(value.habilidades == null) fila = fila + '<td>No Capturado</td>';    
                        else fila = fila + '<td>'+value.habilidades+'</td>';                    
                    }                
                    fila = fila + '<td><div class="row form-group">';
                    fila = fila + '<div><button class="btn btnpersonalizado" onclick="verperfil('+value.id_persona+')" data-toggle="modal" data-target="#modalverperfil" ><i class="fa fa-address-card-o"></i></button></div>';
                    if(activo==1){
                        fila = fila + '<div><button class="btn btnpersonalizado" onclick="actualizarperfil('+value.id_persona+')" data-toggle="modal" data-target="#modalagregarpersonal"><i class="fa fa-pencil-square-o"></i></button></div>';
                        fila = fila + '<div><button class="btn btnpersonalizadoc" onclick="eliminarperfil('+value.id_persona+')"><i class="fa fa-times"></i></button></div></div></td></tr>';
                    }else if(activo==0) fila = fila + '<div><button class="btn btnpersonalizado" onclick="activarperfil('+value.id_persona+')"><i class="fa fa-check"></i></button></div></div></td></tr>';
                });
                fila = fila + '</tbody></table></div></div><div class="card-footer small text-muted mt-3">'+($('#tipo').val()==5?'clientes':'personal')+'</div>';            
                $("#dataTable").dataTable().fnDestroy();
                if(activo==1) $("#divactivos").html(fila);
                else if(activo==0) $("#divbajas").html(fila);
                    else $("#divtodos").html(fila);
                $('#dataTable').dataTable({
                    order: [[ 0, "desc" ]],
                    language: {
                        "decimal":        "",
                        "emptyTable":     "No hay datos en la tabla",
                        "info":           "Mostrar _START_ A _END_ DE _TOTAL_ registros",
                        "infoEmpty":      "mostrando 0 a 0 de 0 registros",
                        "infoFiltered":   "(Filtrado de _MAX_ registros totales)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":         "Buscar:",
                        "zeroRecords":    "No se encontraron registros",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                        "aria": {
                            "sortAscending":  ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        }
                    }
                });  
                obj.close();
            }).fail(function(){ self.setContentAppend('<div>Error al obtener registros</div>');});
        }
    });
}

function eliminarperfil(id_persona){
    $.confirm({
        title: 'Clientes',
        icon: 'fa fa-user',
        content: "¿Realmente desea dar de baja el registro del cliente?",
        theme:"supervan",        
        buttons:{            
            Si: function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: urlpersonas+"/eliminarperfil",
                    data: {id_persona:id_persona},
                    success: function(datos){
                        obtenerpersonal();                        
                    }        
                });
            },Cancelar:{    
                text: 'No',             
            }
        }
    });
}

function obtenerperfil(id_persona){
    toastr.warning("Obteniendo el perfil del personal.","Espere un momento!!!");
    var respuesta = null;
    $.ajax({        
        type: "POST",
        dataType: "json",
        url: urlpersonas+"/verperfil",
        data: {id_persona:id_persona},
        async: false,
        success: function(datos){
            toastr.clear();
            respuesta=datos;            
        }
    });
    return respuesta;
}

function verperfil(id_persona){    
    $("#frmregistrarbarbero")[0].reset();
    $("#habilidades").empty();
    $("#btnregistrarbarbero").hide();
    datos=obtenerperfil(id_persona);
    var fichas = ' ';
    var credito = '';
    fichas = fichas + '<div class="col-md-4 mx-auto align-self-center p-0"><img class="img-fluid" src="../../assets/images/fotospersona/'+datos.id_persona+'.jpg" alt=""></div>';
    fichas = fichas + '<div class="col-md-8 mx-auto">';
    fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">ID:</div><div class="col-md-7 text-left">'+datos.id_persona+'</div></div><hr>';    
    fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Nombre:</div><div class="col-md-7 text-left">'+datos.nombre+' '+datos.apellido_paterno+' '+datos.apellido_materno+'</div></div><hr>';
    console.log($("#tipo").val());
    if(datos.tipo==5){
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Redes sociales:</div><div class= "col-md-7 text-left">Facebook:'+datos.facebook+'<br> Instagram:'+datos.instagram+'</div></div><hr>';
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Teléfono :</div><div class= "col-md-7 text-left">'+datos.telefono+'</div></div><hr>';
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Correo:</div><div class= "col-md-7 text-left">'+datos.correo+'</div></div><hr>';
    }else{
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Tipo de Sangre:</div><div class= "col-md-7 text-left">'+datos.tipo_de_sangre+'</div></div><hr>';
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Habilidades técnicas:</div><div class= "col-md-7 text-left">'+(datos.habilidades!=null?datos.habilidades:'')+'</div></div><hr>';
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Nombre del Contacto:</div><div class= "col-md-7 text-left">'+datos.nombrep+' '+datos.apellido_paterno+' '+datos.apellido_materno+'</div></div><hr>';
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Teléfono del Contacto:</div><div class= "col-md-7 text-left">'+datos.telefonop+'</div></div><hr>';
        fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Correo del Contacto:</div><div class= "col-md-7 text-left">'+datos.correop+'</div></div><hr>';
    }
    fichas = fichas + '</div>';
    $("#contenedorperfil").html(fichas);    
}

function actualizarperfil(id_persona){
    datos=obtenerperfil(id_persona);
    $("#id_persona").val(datos.id_persona);
    $("#nombre").val(datos.nombre);
    $("#apellido_paterno").val(datos.apellido_paterno);
    $("#apellido_materno").val(datos.apellido_materno);
    $("#calle").val(datos.calle);
    $("#numero_interior").val(datos.numero_interior);
    $("#colonia").val(datos.colonia);
    $("#ciudad").val(datos.ciudad);                    
    $("#correo").val(datos.correo);
    $("#telefono").val(datos.telefono);
    $("#facebook").val(datos.facebook);
    $("#instagram").val(datos.instagram);
}

function llenarparentesco(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: urlpersonas+"/obtenerparentesco",
        success: function(datos){
            $("#parentescocontacto").empty();
            $("#parentescocontacto").append($('<option>',{value: "" , text: "Seleccione una opción"}));
            $.each( datos, function( key, value ) { 
                $("#parentescocontacto").append($('<option>',{value: value.id_parentesco , text: value.descripcion_parentesco}));
            });

        }        
    });    
}

$("#frmregistrarbarbero").on("submit", function (e) {
    e.preventDefault();        
    var formulario = this;
    $("#habilidades option").prop("selected",true);
    var obj = $.confirm({
        theme: 'supervan',
        content: function(){            
            var self = this;            
            return $.ajax({
                dataType: 'json',
                type: 'post',        
                data: new FormData(formulario),
                contentType: false,
                cache: false,
                processData: false,        
                url: urlpersonas+"/registrarbarbero",
            }).done(function (datos) {
                $('#modalagregarpersonal').modal('hide');
                obtenerpersonal();
                obj.close();
            }).fail(function(){
                self.setContentAppend('<div>Error al guardar el registro</div>');
            });
        }
    });
});

$("#tipo").on('change', function(){    
    if($("#tipo").val()==2) $("#divbarbero").prop("hidden", false);
    else $("#divbarbero").prop("hidden", true);
});

$("#padecimiento").on('change', function(){    
    if($("#padecimiento").val()==2){
        $("#especifiquepadecimiento").prop("disabled", false);
        $("#especifiquepadecimiento").prop("required", true);
    }else{
        $("#especifiquepadecimiento").prop("disabled", true);
        $("#especifiquepadecimiento").prop("false", true);
    }
});

$("#medicamento").on('change', function(){    
    if($("#medicamento").val()==2) $("#especifiquemedicamento").prop("disabled", false);
    else $("#especifiquemedicamento").prop("disabled", true);
});

$("#btnfalso").on('click', function(e){    
    e.preventDefault();
    $("#btn_foto").click();
});

$("#btnactualizarpersona").on('click', function(){    
    $("id_persona").val(value.id_persona);
});

$("#btnagregarpersonal").on('click', function(){    
    inicializaformulario();
});

$("#btnagregarhabilidad").on('click', function(){    
  if($("#descripcion_habilidad").val()!=""){
    $("#habilidades").append($('<option>',{value: $("#descripcion_habilidad").val() , text: $("#descripcion_habilidad").val()}));
    $("#descripcion_habilidad").val("");
  }
});

$("#btnquitarhabilidad").on('click', function(){    
  if($("#habilidades").val()!=""){
    $("#habilidades option:selected").remove();
  }
});

$("#nombre").focusout(function(){
    generausuario();
});

$("#apellido_paterno").focusout(function(){
    generausuario();
});

$("#apellido_materno").focusout(function(){
    generausuario();
});

$("#usuario").focusout(function(){
    if($("#usuario").val()!="" && usuariopersonalizado!=$("#usuario").val()){
        validarusuario();
        usuariopersonalizado=$("#usuario").val();
    }
});

function inicializaautocomplementar(){
    $('#nombre').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=persona&campo=nombre', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#apellido_paterno').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=persona&campo=apellido_paterno', 
        minLength:2,
        html: true,  

        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#apellido_materno').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=persona&campo=apellido_materno', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });    

    $('#calle').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=calle', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });        

    $('#colonia').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=colonia', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });        

    $('#ciudad').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=ciudad', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });        

    $('#estado').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=estado', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });      

    $('#nombrecontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=persona&campo=nombre', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#paternocontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=persona&campo=apellido_paterno', 
        minLength:2,
        html: true,  

        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#maternocontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=persona&campo=apellido_materno', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });    

    $('#callecontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=calle', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });        

    $('#coloniacontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=colonia', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });        

    $('#ciudadcontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=ciudad', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });        

    $('#estadocontacto').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=direcciones&campo=estado', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });       

    $('#descripcion_habilidad').autocomplete({
        source: urlpersonas+'/autocompletar?tabla=barbero_habilidades_tecnicas&campo=descripcion_habilidad', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });     
}