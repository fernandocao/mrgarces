
$(document).ready(function() {
/*    
    mostrarpaquetes();
    obtenerbajas();
    listaServicios();
*/    
    obtenerservicios();  
    $("#buscar").on("keyup",function(){
        var value = $(this).val().toLowerCase();
        $("#tabla-paquetes tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#busca_paquete").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabla_servicios tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    $('#buscar_servicio').autocomplete({
        source: 'Administrar_servicios/autocompletarservicio?tabla=servicios&campo=descripcion', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
            $('#id_servicio').val(ui.item.id);
        }
    });
});

$("#frmregistrarservicio").on("submit", function (e) {
    e.preventDefault();
    $.ajax({  
        dataType: 'json',
        type: 'post',        
        data: $("#frmregistrarservicio").serialize(),
        url: "Administrar_servicios/registrarservicio",
        success: function(data){       
            if($("#id_serviciop").val() == 0){
                //alert("hola registro");
               toastr.success("Correctamente","Servicio registrado");                 
                $('.registrarservicio').modal('hide');
                $('#frmregistrarservicio')[0].reset();                
                listaServicios();                
            }else{
                //alert("hola actualizar");
                toastr.success("Correctamente","Servicio actualizado");                            
                $('.registrarservicio').modal('hide');
                $('#frmregistrarservicio')[0].reset();                                   
                listaServicios();                
            }            
        }        
    });    
});

$("#frmcrearpaquete").on("submit", function(e){
    e.preventDefault();
    $.ajax({
        dataType: 'json',
        type: 'post',
        data: $("#frmcrearpaquete").serialize(),
        url: 'Administrar_servicios/registrarpaquete',
        success: function(data){
            if($("#id_paquete").val() == 0){
                toastr.success("Correctamente","Paquete creado");
                $("#frmcrearpaquete")[0].reset();
                $("#inputs").empty();
                mostrarpaquetes();
               }else{
                    toastr.success("Correctamente","Paquete actualizado");
                    $("#frmcrearpaquete")[0].reset();
                    $("#inputs").empty();
                    mostrarpaquetes();
               }
        }
    });
});

function reset(){
    $('#frmregistrarservicio')[0].reset();  
}

function llenarServicios(id_servicio){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'Administrar_servicios/llenar_lista',
        data:{
            id_servicio: id_servicio
        },
    }).done(function(datos){        
        $.each(datos,function(key, value){
            $("#id_serviciop").val(value.id_servicio);
            $("#descripcionservicio").val(value.descripcion);
            $("#precioservicio").val(value.precio);
            $("#duracion").val(value.duracion);
        });
    });
}

function obtenerservicios(){
    $.ajax({
        type: 'POST',
        dataType: 'json',        
        url:'Administrar_servicios/lista_servicios',
    }).done(function(datos){
        var fila = '';
        fila = fila + '<div class="table-responsive mt-3"><table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">';
        fila = fila +      '<thead>'+
                                '<tr>'+
                                    '<th>ID</th>'+
                                    '<th>Descripcion</th>'+
                                    '<th>Precio</th>'+
                                    '<th>Duracion</th>'+
                                    '<th class="text-center">Control</th>'+                                    
                                '</tr>'+
                            '</thead>'+
                            '<tbody>';
        $.each(datos, function(key, value){                            
        fila = fila +           '<tr>'+
                                    '<td>'+value.id_servicio+'</td>'+
                                    '<td>'+value.descripcion+'</td>'+
                                    '<td>$'+value.precio+'</td>'+
                                    '<td>'+value.duracion+' Min</td>'+                                    
                                    '<td><div class="row"><button class="btn  btnpersonalizado" data-target=".registrarservicio" data-toggle="modal" onclick="llenarServicios('+value.id_servicio+')"><i class="fa fa-pencil-square-o"></i></button>'+
                                    '<button  class="btn btnpersonalizadoc" onclick="baja_servicio('+value.id_servicio+')"><i class="fa fa-times"></i></button></div></td>'+                                    
                                '</tr>';                    
        });
        fila = fila +       '</tbody>'+
                        '</table>';

        $("#divreporte").html(fila);
        $('#dataTable').dataTable({
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
    });
}

function obtenerbajas(){
    $.ajax({
        type: 'POST',
        dataType: 'json',        
        url:'Administrar_servicios/lista_bajas',
    }).done(function(datos){
        var fila = '';
        fila = fila + '<table class="table" id="tabla_bajas">';
        fila = fila +      '<thead class="thead-dark">'+
                                '<tr>'+
                                    '<th>ID</th>'+
                                    '<th>Descripcion</th>'+                                                             
                                    '<th class="text-center">Control</th>'+                                    
                                '</tr>'+
                            '</thead>'+
                            '<tbody>';
        $.each(datos, function(key, value){                            
        fila = fila +           '<tr>'+
                                    '<td>'+value.id_servicio+'</td>'+
                                    '<td>'+value.descripcion+'</td>'+                                                                      
                                    '<td><button class="btn btn-success form-control" onclick="habilitar('+value.id_servicio+')">HABILITAR</button></td>'+                                    
                                '</tr>';                    
        });
        fila = fila +       '</tbody>'+
                        '</table>';
        $("#servicios_baja").html(fila);
        //$("#reporte_2").html(fila);
    });
}

function servicio_lista(){
    $.ajax({
        type:'post',
        dataType: 'json',
        url: 'Administrar_servicios/llenar_servicio',
        success: function(datos){
            $("#servicio").empty();
            $("#servicio").append($('<option>',{value: "", text: "Servicios disponibles"}));
            $.each(datos, function(key, value){
                $("#servicio").append($('<option>',{value: value.id_servicio, text: value.descripcion}));
            });
        }
    });
}

function baja_servicio(id_servicio){
    $.confirm({
        title: "¿Inhabilitar servicio?",
        content: false,                
        theme: 'supervan',
        buttons:{
            INHABILITAR: function(){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "Administrar_servicios/baja_servicio",
                    data:{
                        id_servicio: id_servicio
                    },
                }).done(function(datos){
                    toastr.error("Servicio inhabilitado"); 
                    listaServicios();
                    obtenerbajas();
                });
            },CANCELAR:{
                text: 'CANCELAR',
                    action: function () {
                    //$.alert('ACCION CANCELADA');                        
                }
            }
        }
    });
}

function habilitar(id_servicio){
    $.confirm({
        title: "¿Habilitar nuevamente el servicio al sistema?",
        content: false,                
        theme: 'supervan',
        buttons:{
            HABILITAR: function(){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "Administrar_servicios/habilitar_servicio",
                    data:{
                        id_servicio: id_servicio
                    },
                }).done(function(datos){
                    toastr.info("Correctamente","Servicio habilitado"); 
                    listaServicios();
                    obtenerbajas();
                    $(".servicios_inhab").modal('hide');                    
                });
            },CANCELAR:{
                text: 'CANCELAR',
                    action: function () {
                    //$.alert('ACCION CANCELADA');                        
                }
            }
        }
    });
}

function quitarservicio(id_servicio){
    $.confirm({
        title: "¿Eliminar servicio?",
        content: false,                
        theme: 'supervan',
        buttons:{
            ELIMINAR: function(){
                $("#a"+id_servicio).remove();
                toastr.error("Producto eliminado de la lista" ,"¡AVISO!");
            },CANCELAR:{
                text: 'CANCELAR',
                    action: function () {
                    //$.alert('ACCION CANCELADA');                        
                }
            }
        }
    });    
}

$("#btnagregarservicio").on('click', function(e){
    if($("#buscar_servicio").val() == ""){       
        toastr.info("Para crear un paquete, busque y agregue un servicio a la lista" ,"¡AVISO!");
       }else{                                          
               e.preventDefault();
               $.ajax({
                   type: 'POST',
                   dataType: 'json',
                   url: 'Administrar_servicios/obtenerservicio',
                   data: { id_servicio: $('#id_servicio').val()},
                   success: function(datos){
                       if($('#a'+$('#id_servicio').val()).length > 0){
                        toastr.warning("No puedes añadir el mismo servicio","¡AVISO!");   
                        $("#buscar_servicio").val('');
                       }else{                        
                        $("#inputs").append('<div class="row" id="a'+datos['id_servicio']+'">'+
                                           '<div class="form-group col-md-9">'+
                                           '<input type="text" id="id" name="id[]" value="'+datos['id_servicio']+'" hidden>'+
                                           '<input type="text" name="descripcion[]" id="descripcion'+datos['id_servicio']+'" class="form-control" value="'+datos['descripcion']+'" readonly>'+
                                           '</div>'+
                                           '<div class="form-group col-md-3">'+
                                           '<button onclick="quitarservicio('+$("#id_servicio").val()+');" class="btn btn-secondary form-control"><i class="fa fa-time-circle"></i> Eliminar</button>'+
                                           '</div>'+
                                           '</div>');                        
                       $("#buscar_servicio").val('');
                        toastr.success("Servicio añadido correctamente");   
                       } 
                       
                    }
                   
                });
              
       }    
});

function mostrarpaquetes(){
    
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: "Administrar_servicios/obtenerpaquetes"
    }).done(function(datos){
        var fila = '';
        fila = fila + '<div class="table-responsive">'
        fila = fila + '<table class="table" id="tabla-paquetes" width="100%" cellspacing="0">';
        fila = fila +      '<thead class="thead-dark">'+
                                '<tr>'+
                                    '<th>Clave</th>'+
                                    '<th>Nombre</th>'+
                                    '<th>Detalle paquete</th>'+
                                    '<th>Precio</th>'+
                                    '<th class="text-center">Control</th>'+                                    
                                '</tr>'+
                            '</thead>'+
                            '<tbody>';
        $.each(datos, function(key, value){                            
        fila = fila +           '<tr>'+
                                    '<td>'+value.id_paquete+'</td>'+
                                    '<td>'+value.descripcion+'</td>'+
                                    '<td>'+value.servicios+'</td>'+
                                    '<td>$'+value.precio+'</td>'+
                                    '<td><button class="btn btn-secondary" onclick=ver_paquete("'+value.id_paquete+'")>Ver</button></td>'+                                    
                                '</tr>';                    
        });
        fila = fila +       '</tbody>'+
                        '</table>'+
                        '</div>';
        $("#reporte_2").html(fila);
        $("#tabla-paquetes").dataTable({
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
    });
    
}

function ver_paquete(id_paquete){
    $.ajax({
        dataType: 'json',
        type: 'post',
        url: 'Administrar_servicios/ver_paquete',
        data: { id_paquete: id_paquete}        
    }).done(function(datos){
        $.each(datos, function(key, value){
            console.log(value);
            $("#precio").val(value.precio);
            $("#descripcion").val(value.descripcion);
            $("#id_paquete").val(value.id_paquete);
            $("#inputs").append('<div class="row" id="a'+datos['id_servicio']+'">'+
                                    '<div class="form-group col-md-9">'+
                                        '<input type="text" id="id" name="id[]" value="'+value.id_servicio+'" hidden>'+
                                        '<input type="text" name="descripcion[]" id="descripcion'+datos['id_servicio']+'" class="form-control" value="'+value.nombreservicio+'" readonly>'+
                                    '</div>'+
                                    '<div class="form-group col-md-3">'+
                                        '<button onclick="quitarservicio('+$("#id_servicio").val()+');" class="btn btn-secondary form-control"><i class="fa fa-time-circle"></i> Eliminar</button>'+
                                    '</div>'+
                                '</div>');
        });
    });
}

