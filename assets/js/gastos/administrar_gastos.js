$.datetimepicker.setLocale('es');
$(document).ready(function(){

        $('#fecha').datetimepicker({
        lang: 'es',
        timepicker: false,
        startDate:  Date(),
        minDate: Date(),
        format:'Y-m-d'
    });
//Empieza funciones de autocompletar campos
    $('#calle').autocomplete({
        source: 'Administrar_proveedor/autocompletar?tabla=direcciones&campo=nombre_comercial',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#colonia').autocomplete({
        source: 'Administrar_proveedor/autocompletar?tabla=direcciones&campo=colonia',
        minLength: 2,
        html: true,

        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#ciudad').autocomplete({
        source: 'Administrar_proveedor/autocompletar?tabla=direcciones&campo=ciudad',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#calle').autocomplete({
        source: 'Administrar_proveedor/autocompletar?tabla=direcciones&campo=calle',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#nombre_contacto').autocomplete({
        source: 'Administrar_proveedor/autocompletar?tabla=proveedores&campo=nombre_contacto',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

        $("#formulario").submit(function () {  
        if($("#nombre_comercial").val() == empty() ) {  
            alert("El nombre debe tener más de 3 caracteres");  
            return false;  
        }  
          
        return false;  
    });  
    //Termina funciones de autocompletar
    //Muestra los proveedores existentes
    obtenerproveedor();
    obtenerproveedorbaja();
    obtenerproveedortodos();
});


$("#frmregistrarproveedor").on("submit", function (e) {
    e.preventDefault();
    if($('#tipo_gasto').val() == 0 ){

    }

    $.ajax({
        data: $("#frmregistrarproveedor").serialize(),
        type: "POST",
        dataType: "json",
        url: "Administrar_proveedor/registrarproveedor",
        success: function (datos) {
            
            $('.modal').modal('hide');
            if(datos.respuesta==0)toastr.success("El proveedor se registro exitosamente");
            else toastr.success("El proveedor se actualizo exitosamente");
            obtenerproveedor();

        }
    });
});

    function registrar() {
        
    }



function obtenerproveedor() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_proveedor/obtenerproveedor",
        success: function (datos) {
            console.log(datos);
            var fila = '';
            fila = fila + '<div class="table-responsive">'+
                            '<table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">'+
                                '<thead class="">'+
                                '<tr>'+
                                    '<th>ID</th>'+
                                    '<th>Empresa</th>'+
                                    '<th>RFC</th>'+   
                                    '<th>Dirección</th>'+
                                    '<th>Teléfono</th>'+        
                                    '<th class="text-center">CONTROL</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tfoot class="">'+
                            '<tr>'+
                                '<th>ID</th>'+
                                '<th>Empresa</th>'+
                                '<th>RFC</th>'+   
                                '<th>Dirección</th>'+
                                '<th>Teléfono</th>'+        
                                '<th class="text-center">CONTROL</th>'+
                            '</tr>'+
                        '</tfoot>'+
                            '<tbody>';
            $.each(datos, function (key, value) {

                fila = fila +   '<tr>'+
                '<td>'+value.id_proveedor+'</td>'+
                '<td>'+value.nombre_comercial+'</td>'+
                '<td>'+value.rfc+'</td>'+
                '<td>'+value.direccion+'</td>'+
                '<td>'+value.telefono+'</td>'+

                '<td>'+
                    
                        
                            '<button class="btn btnpersonalizado"  data-target=".perfilproveedor" data-toggle="modal" onclick="obtenerperfilproveedor('+value.id_proveedor+')">'+
                                '<i class="fa fa-address-card-o" aria-hidden="true"></i>'+
                            '</button>'+
                        
                    
                            '<button class="btn btnpersonalizado" id="btnactualizarproveedor" name="btnactualizar"  data-target=".agregarproveedor" data-toggle="modal" onclick="llenarformularioactualizar('+value.id_proveedor+')">'+
                                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'+
                            '</button>'+
                    
                    
                            '<button class="btn btnpersonalizadoc" id="btneliminarproveedor" onclick="eliminarproveedor('+value.id_proveedor+')" name="btneliminarproveedor">'+
                                '<i class="fa fa-times" aria-hidden="true"></i>'+
                            '</button>'+
                    
                    
                '</td>'+
            '</tr>';
            });

            fila = fila + '</tbody>'+
                    '</table></div>'+
            
                    $("#reporte").html(fila);
                    
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

        }
    });
}
    
function obtenerproveedorbaja() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_proveedor/obtenerproveedorbaja",
        success: function (datos) {
            console.log(datos);
            var fila = '';
            fila = fila + '<div class="table-responsive">'+
                            '<table class="table table-bordered" id="dataTablebaja" width="100%" cellspacing="0">'+
                                '<thead class="">'+
                                '<tr>'+
                                    '<th>ID</th>'+
                                    '<th>Empresa</th>'+
                                    '<th>RFC</th>'+   
                                    '<th>Dirección</th>'+
                                    '<th>Teléfono</th>'+        
                                    '<th class="text-center" width="20%">CONTROL</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tfoot class="">'+
                            '<tr>'+
                                '<th>ID</th>'+
                                '<th>Empresa</th>'+
                                '<th>RFC</th>'+   
                                '<th>Dirección</th>'+
                                '<th>Teléfono</th>'+        
                                '<th class="text-center" width="20%">CONTROL</th>'+
                            '</tr>'+
                        '</tfoot>'+
                            '<tbody>';
            $.each(datos, function (key, value) {

                fila = fila +   '<tr>'+
                '<td>'+value.id_proveedor+'</td>'+
                '<td>'+value.nombre_comercial+'</td>'+
                '<td>'+value.rfc+'</td>'+
                '<td>'+value.direccion+'</td>'+
                '<td>'+value.telefono+'</td>'+

                '<td><div class="row p-0">'+
                
                '<div class="col-md-3 mx-auto"><button id="btnhabilitar" name="btnhabilitar" class="btn  btn-success form-control mt-1"  onclick="habilitarproveedor('+value.id_proveedor+')"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></div>'+
                '</div></td>'+
            '</tr>';
            });

            fila = fila + '</tbody>'+
            '</table></div>'+
    
            $("#reporte_baja").html(fila);
            
            $('#dataTablebaja').dataTable({
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

        }
    });
}

function obtenerproveedortodos() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_proveedor/obtenerproveedortodos",
        success: function (datos) {
            var fila = '';
            fila = fila + '<div class="table-responsive">'+
                            '<table class="table table-bordered" id="dataTabletodos" width="100%" cellspacing="0">'+
                                '<thead class="">'+
                                '<tr>'+
                                    '<th>ID</th>'+
                                    '<th>Empresa</th>'+
                                    '<th>RFC</th>'+   
                                    '<th>Dirección</th>'+
                                    '<th>Teléfono</th>'+        
                                    
                                '</tr>'+
                            '</thead>'+
                            '<tfoot class="">'+
                            '<tr>'+
                                '<th>ID</th>'+
                                '<th>Empresa</th>'+
                                '<th>RFC</th>'+   
                                '<th>Dirección</th>'+
                                '<th>Teléfono</th>'+        
                                
                            '</tr>'+
                        '</tfoot>'+
                            '<tbody>';
            $.each(datos, function (key, value) {

                fila = fila +   '<tr>'+
                '<td>'+value.id_proveedor+'</td>'+
                '<td>'+value.nombre_comercial+'</td>'+
                '<td>'+value.rfc+'</td>'+
                '<td>'+value.direccion+'</td>'+
                '<td>'+value.telefono+'</td>'+


            '</tr>';
            });

            fila = fila + '</tbody>'+
            '</table></div>'+
    
            $("#reporte_todos").html(fila);
            
            $('#dataTabletodos').dataTable({
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

        }
    });
}

function llenarformularioactualizar(id_proveedor) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_proveedor/llenarformularioactualizar",
        data: {
            id_proveedor: id_proveedor
        },
        success: function (value) {
            $("#id_proveedor").val(value.id_proveedor);
            $("#id_direccion").val(value.id_direccion);
            $("#nombre_comercial").val(value.nombre_comercial);
            $("#rfc").val(value.rfc);
            $("#calle").val(value.calle);
            $("#numero").val(value.numero);
            $("#numero_interior").val(value.numero_interior);
            $("#colonia").val(value.colonia);
            $("#ciudad").val(value.ciudad);
            $("#estado").val(value.estado);
            $("#correo").val(value.correo);
            $("#telefono").val(value.telefono);
            $("#maneja_credito").val(value.maneja_credito);
            $("#nombre_contacto").val(value.nombre_contacto);
            $("#telefono_contacto").val(value.telefono_contacto);
            $("#correo_contacto").val(value.correo_contacto);
            $("#pagina_web").val(value.pagina_web);
        }
    });
}

function obtenerperfilproveedor(id_proveedor) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_proveedor/obtenerperfilproveedor",
        data: {
            id_proveedor: id_proveedor
        },
        success: function (datos) {
            console.log(datos);
            var fichas = ' ';
            $.each(datos, function (key, value) {
                var credito = '';

                fichas = fichas + '<div class="col-md-4 mx-auto align-self-center p-0"><img class="img-fluid" src="../../assets/images/logo.jpg" alt=""></div>';
                fichas = fichas + '<div class="col-md-8 mx-auto">';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">ID del proveedor:</div><div class="col-md-7 text-left">' + value.id_proveedor + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Nombre Comercial:</div><div class="col-md-7 text-left">' + value.nombre_comercial + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Dirección:</div><div class= "col-md-7 text-left">' + value.direccion + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Teléfono:</div><div class= "col-md-7 text-left">' + value.telefono + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Página web:</div><div class= "col-md-7 text-left">' + value.pagina_web + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Credito:</div><div class= "col-md-7 text-left">' + (value.maneja_credito == 1 ? "Si maneja crédito" : "No maneja crédito") + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Correo:</div><div class= "col-md-7 text-left">' + value.correo + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Nombre del Contacto:</div><div class= "col-md-7 text-left">' + value.nombre_contacto + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Teléfono del Contacto:</div><div class= "col-md-7 text-left">' + value.telefono_contacto + '</div></div><hr>';
                fichas = fichas + '<div class="row"><div class="col-md-5 text-right font-weight-bold">Correo del Contacto:</div><div class= "col-md-7 text-left">' + value.correo_contacto + '</div></div><hr>';
                fichas = fichas + '</div>'


            });

            $("#contenedorperfil").html(fichas);
        }
    });
}

function eliminarproveedor(id_proveedor) {
    $.confirm({
        title: false,
        content: "¿Realmente desea dar de baja el proveedor?",
        theme:"supervan",
        
        buttons:{
            
            Si: function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "Administrar_proveedor/eliminarproveedor",
                    data: {
                        id_proveedor: id_proveedor
                    },
                    success: function (datos) {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.error("El registro del proveedor ha sido borrado.", "Realizado!!"),
                        obtenerproveedor();
                        obtenerproveedorbaja();
                        obtenerproveedortodos();
                    }
                });
            },Cancelar:{
                text: 'No',
            }            
        }
    });
}

function habilitarproveedor(id_proveedor) {
    $.confirm({
        title: false,
        content: "¿Realmente desea habilitar de nuevo este proveedor?",
        theme:"supervan",
        
        buttons:{
            
            Si: function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "Administrar_proveedor/habilitarproveedor",
                    data: {
                        id_proveedor: id_proveedor
                    },
                    success: function (datos) {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success("El proveedor ha sido nuevamente habilitado.", "Realizado!!"),
                        obtenerproveedor();
                        obtenerproveedorbaja();
                        obtenerproveedortodos();
                    }
                });
            },Cancelar:{
                text: 'No',
                    
            }
        }
    });

}

$("#btnagregarproveedor").click(function () {
    /* Single line Reset function executes on click of Reset Button */
    $("#frmregistrarproveedor")[0].reset();
});
$('#btnagregarproveedor').click(function(){
    $("#btnregistrarproveedor").val('Aceptar');
});

$('#btnactualizarproveedor').click(function(){
    $("#btnregistrarproveedor").val('Guardar Cambios');
});

$('#tipo_gasto').on('change', function(){
    if($('#tipo_gasto').val() == 0){//0=prodcuto   
        $('#costo_unitario').attr({
            readonly: true
        });
                $('.cantidad').attr({
            hidden: false,
            
        });
        $('#cantidad').attr({
            readonly: false
            
        });
    } else{
        $('#costo_unitario').attr({
            readonly: false
        });
        $('.cantidad').attr({
            hidden: true,
            
        });
        $('#cantidad').attr({
            readonly: true
            
        });
    }  
     toastr.success($('#tipo_gasto').val());
  
});
/*Funciones de gastos*/

$(document).on("change, keyup", "#costo_unitario", function(){
    if($('#costo_unitario').val() == ''){
        $('#monto_total').val(0);
    }
     multiplica();  
    //$("#cantidad"+id).val(1);
});

$(document).on('keyup mouseup', "#cantidad", function(){
    multiplica();
      
});

function multiplica(){
    
    $("#monto_total").val(parseFloat($('#costo_unitario').val())*parseFloat($('#cantidad').val()));
    if(isNaN($('#monto_total').val())){
        $('').val(0);       
    }else{
        $('#precio_promo').val(total);   
    }
    
}