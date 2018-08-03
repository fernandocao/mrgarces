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
    $('#gastostipo').autocomplete({
        source: 'Administrar_gastos/autocompletargastos',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function( event, ui ) {
            $('#id_tipogasto').val(ui.item.id);
        }        
    });

    obtenergastos(1);
   //Termina funciones de autocompletars
    //Muestra los proveedores existentes

});
  
$("#frmregistrargasto").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        data: $("#frmregistrargasto").serialize(),
        type: "POST",
        dataType: "json",
        url: "Administrar_gastos/registrargasto",
        success: function (datos) {
            $('.modal').modal('hide');

            if(datos.id_gasto==0)toastr.success("El <proveedores></proveedores> se registro exitosamente");
            else toastr.success("El proveedor se actualizo exitosamente");
            obtenergastos(1);
        }
    });
});

function obtenergastos(activo) {
    $.ajax({
        type: "POST",
        dataType: "json",
         url: "Administrar_gastos/obtenergastos",
        data:{activo:activo},
        success: function (datos) {
            creartabla(datos, activo);

        }
    });
}


 function creartabla(datos,activo){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_gastos/obtenergastos",
         data:{activo:activo},
        success: function (datos) {
            console.log(datos);
            var fila = '';
            fila = fila + '<div class="table-responsive">'+
                            '<table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">'+
                                '<thead class="">'+
                                '<tr>'+
                                    '<th>#</th>'+
                                    '<th>Concepto</th>'+
                                    '<th>Fecha</th>'+   
                                    '<th>Monto total</th>'+
                                    '<th>Tipo de pago</th>'+        
                                    '<th>Observaciones</th>'+        
                                    '<th class="text-center">Opciones</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tfoot class="">'+
                            '<tr>'+
                                '<th>#</th>'+
                                    '<th>Concepto</th>'+
                                    '<th>Fecha</th>'+   
                                    '<th>Monto total</th>'+
                                    '<th>Tipo de pago</th>'+        
                                    '<th>Observaciones</th>'+        
                                    '<th class="text-center">Opciones</th>'+
                            '</tr>'+
                        '</tfoot>'+
                            '<tbody>';
            $.each(datos, function (key, value) {
                $tipopago = '';
                if(value.tipopago == 0){
                    $tipopago = 'Efectivo'
                }else if(value.tipopago == 1){
                    $tipopago = 'Tarjeta'
                }else if(value.tipopago == 2){
                    $tipopago = 'Caja chica'
                };
                fila = fila + '<tr>'+
                '<td>'+value.id_gasto+'</td>'+
                '<td>'+value.concepto+'</td>'+
                '<td>'+value.fecha+'</td>'+
                '<td>'+value.monto+'</td>'+
                '<td>'+$tipopago+'</td>';
                if (value.observaciones == '') {
                fila = fila + '<td>Sin observaciones</td>';
                }else{
                    fila = fila + '<td>'+value.observaciones+'</td>';
                };
                

                fila = fila +'<td>';
                if(value.activo == 1){
                    fila = fila +'<button class="btn btnpersonalizado" id="btnactualizargasto" name="btnactualizargasto"  data-target=".agregargasto" data-toggle="modal" onclick="llenarformularioactualizar('+value.id_gasto+')">'+
                       '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'+
                    '</button>'+
                    '<button class="btn btnpersonalizadoc" id="btneliminargasto" onclick="eliminargasto('+value.id_gasto+')" name="btneliminargasto">'+
                        '<i class="fa fa-times" aria-hidden="true"></i>'+
                    '</button>';
                };
                    
                    fila = fila + '</td>'+
            '</tr>';
            });

            fila = fila + '</tbody>'+
                    '</table></div>'+
            
                    $(".reporte").html(fila);
                    
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

  

function llenarformularioactualizar(id_gasto) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_gastos/llenarformularioactualizar",
        data: {
            id_gasto:id_gasto
        },
        success: function (value) {

            $('#id_gasto').val(value.id_gasto)
            $('#id_tipogasto').val(value.id_tipogasto);
            $('#fecha').val(value.fecha);
            $('#gastostipo').val(value.concepto);
            $('#tipopago').val(value.tipopago);
            $('#monto').val(value.monto);
            $('#observaciones').text(value.observaciones);
            
            if($('#id_gasto').val() != 0){
                $('#gastostipo').attr('readonly', true);
            }
            }

    });
}

function eliminargasto(id_gasto) {
    $.confirm({
        title: false,
        content: "¿Realmente desea eliminar el registro del gasto?",
        theme:"supervan",
        
        buttons:{
            
            Si: function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                     url: "Administrar_gastos/eliminargasto",
                    data: {
                        id_gasto:id_gasto

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
                         obtenergastos(0);
                        
                    }
                });
            },Cancelar:{
                text: 'No',
            }            
        }
    });
}


$("#btnagregargasto").click(function () {
    $("#frmregistrargasto")[0].reset();
    $("#gastostipo").attr('readonly', false);
});



