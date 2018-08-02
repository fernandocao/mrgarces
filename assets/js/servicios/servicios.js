 
$(document).ready(function() {
    $('#descripcion').autocomplete({
        source: 'Administrar_servicios/autocompletarservicio', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
    });
    obtenerservicios();  
});

function actualizarservicio(id_servicio){
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'Administrar_servicios/obtenerservicio',
        data:{id_servicio: id_servicio},
    }).done(function(datos){        
        $("#id_servicio").val(datos.id_servicio);
        $("#descripcion").val(datos.descripcion);
        $("#precio").val(datos.precio);
        $("#duracion").val(datos.duracion);
    });
}

function obtenerservicios(){
    $.ajax({
        type: 'POST',
        dataType: 'json',        
        url:'Administrar_servicios/obtenerservicios',
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
                                    '<td><div class="row"><button class="btn  btnpersonalizado" data-target="#registrarservicio" data-toggle="modal" onclick="actualizarservicio('+value.id_servicio+')"><i class="fa fa-pencil-square-o"></i></button>'+
                                    '<button  class="btn btnpersonalizadoc" onclick="baja_servicio('+value.id_servicio+')"><i class="fa fa-times"></i></button></div></td>'+                                    
                                '</tr>';                    
        });
        fila = fila +       '</tbody>'+
                        '</table>';

        $("#divreporte").html(fila);
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
                    obtenerservicios
                });
            },CANCELAR:{
                text: 'CANCELAR',
                    action: function () {
                    
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
                    obtenerservicios();
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

$("#frmregistrarservicio").on("submit", function (e) {
    e.preventDefault();

    var obj = $.confirm({
        title: 'Servicios',
        theme: 'supervan',
        content: function(){            
            var self = this;            
            return $.ajax({
                dataType: 'json',
                type: 'post',        
                data: $("#frmregistrarservicio").serialize(),
                url: "Administrar_servicios/registrarservicio",
            }).done(function (datos) {                
                self.setContentAppend('<div>Se ha '+datos+' el servicio.</div>');
                obtenerservicios();
                $('#frmregistrarservicio')[0].reset();  
                $('#registrarservicio').modal('hide');
            }).fail(function(){
                self.setContentAppend('<div>Error al obtener los datos</div>');
            });
        },
        buttons: {Continuar: function(){

        }}        
    }); 
});