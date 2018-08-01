$.datetimepicker.setLocale('es');

$(document).ready(function(){

    $('#descripcion').autocomplete({
        source: 'Administrar_promociones/autocompletar?tabla=promociones&campo=descripcion',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
                $.confirm({
        title: 'Advertencia!!',
        content: "<h2>El nombre de la promoción ya existe. Verificar si ya se encuentra creada o ingrese un nombre diferente",
        theme:"supervan",
        
        buttons:{
            
            Ok: function(){
                $('#descripcion').val('');
            }            
        }
    });
        }
    });

    $('#fecha_inicio').datetimepicker({
        lang: 'es',
        timepicker: false,
        startDate:  Date(),
        minDate: Date(),
        format:'Y-m-d'
    });

    $('#fecha_fin').datetimepicker({
        lang: 'es',
        timepicker: false,
        startDate:  Date(),
        minDate: Date(),
        format:'Y-m-d'
    });

//Autocompletar campo de servicios   
    $('#descripcion_servicio').autocomplete({
        source: 'Administrar_promociones/autocompletararticulos',
        minLength: 2,
        html: true,
        open: function (event, ui) {
                $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
            $('#id_servicio').val(ui.item.id);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "Administrar_promociones/obtenerservicio",
                data: {
                id_servicio: $('#id_servicio').val()
            },
            success: function (datos) {
                    if($('#descripcion_servicio').val() == ""){
                            toastr.warning('No se ha seleccionado ningun servicio');
                    }else{
                        if ( $("#ps"+$('#id_servicio').val()).length > 0 ) {
                            toastr.error('El servicio ya se encuentra en la lista');
                            $('#id_servicio').val('');
                            $('#descripcion_producto').val('');
                            $('#descripcion_servicio').val('');
                        }else{               
                            agregarcampos($('#id_servicio').val(), 's', datos);         
                            toastr.success('El servicio se ha agregado a la lista');
                            $('#id_servicio').val('');
                            $('#descripcion_servicio').val('');
                        }
                    }
                }   
            });
        }
    });

//Autocompletar campos de productos
    $('#descripcion_producto').autocomplete({
        source: 'Administrar_promociones/autocompletarproducto?tabla=productos&campo=descripcion',
        minLength: 2,
        html: true,
        open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
            $('#id_producto').val(ui.item.id);
        }
    });
    obtenerpromociones();

    });
   
    $("#frmpromocion").on("submit", function (e) {
        e.preventDefault();
        if ($('#fecha_inicio').val() > $('#fecha_fin').val()) {
                    toastr.error('Error la fecha de inicio de la promocion no puede ser mayor que la fecha de finalización.')
                }else{
        $.ajax({
            data: $("#frmpromocion").serialize(),
            type: "POST",
            dataType: "json",
            url: "Administrar_promociones/registrarpromocion",
            success: function (datos) {
                $('.modal').modal('hide');
                
                obtenerpromociones();

            }
        });
        }
    });
    
//Agrega un elemento de servicio a la promoción
    $('#btnagregarserviciopromo').on('click',function(e){
        e.preventDefault();
        $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_promociones/obtenerservicio",
        data: {
            id_servicio: $('#id_servicio').val()
        },
         success: function (datos) {
                if($('#descripcion_servicio').val() == ""){
                        toastr.warning('No se ha seleccionado ningun servicio');
                }else{
                    if ( $("#ps"+$('#id_servicio').val()).length > 0 ) {
                        toastr.error('El servicio ya se encuentra en la lista');
                        $('#id_servicio').val('');
                        $('#descripcion_producto').val('');
                        $('#descripcion_servicio').val('');
                    }else{               
                        agregarcampos($('#id_servicio').val(), 's', datos);         
                        toastr.success('El servicio se ha agregado a la lista');
                        $('#id_servicio').val('');
                        $('#descripcion_servicio').val('');
                    }
                }
            }   
        });
    }); 

    function agregarcampos(id, tipo, datos){
          var ctipo = "";
          ctipo = tipo+id;
          $('#contienelista').append('<div class="row form-group" id="'+ctipo+'">'+
                                                '<div class="col-md-1">'+
                                                    '<button type="button" class="btn  form-control" onclick="removerrowproducto(\''+ctipo+'\')" ">'+
                                                        '<i class="fa fa-times-circle"></i>'+
                                                    '</button>'+
                                                '</div>'+
                                                '<div class="col-md-3">'+
                                                '<input type="text" id="tipo" name="tipo[]" value="'+tipo+'" hidden>'+
                                                    '<input class="form-control" type="text" value="'+id+'" value="readonly="" name="id[]" hidden>'+
                                                    '<label class="form-control">'+datos['descripcion']+'</label>'+
                                                '</div>'+

                                                '<div class="col-md-2">'+
                                                    '<input class="form-control cantidad" type="number" min="1" value="1" id="cantidad'+ctipo+'" name="cantidad[]">'+
                                                '</div>'+
                                                '<div class="col-md-2">'+
                                                '<input class="form-control" type="text" name="" value="'+datos['costo_unitario']+'" readonly>'+
                                                '</div>'+
                                                '<div class="col-md-2">'+
                                                    '<input class="form-control precio" id="precio'+ctipo+'" type="text" name="precio[]" value="'+datos['precio']+'">'+
                                                '</div>'+
                                                '<div class="col-md-2">'+
                                                  '<input class="form-control" name="subtotal[]" id="subtotal'+ctipo+'" type="text" value="'+datos['precio']+'" required readonly>'+
                                                '</div>'+
                                     

                                    '</div>');
          $('#precio_promo').val(parseFloat($('#precio_promo').val())+parseFloat($('#subtotal'+tipo+id).val()));
      }

    $('#btnagregarproductopromo').on('click',function(e){

        e.preventDefault();
         $.ajax({
            type: "POST",
            dataType: "json",
            url: "Administrar_promociones/obtenerproducto",
            data: {
                id_producto: $('#id_producto').val()
            },
            success: function (datos) {
                console.log(datos);
                if($('#descripcion_producto').val() == ""){
                        toastr.warning('No se ha seleccionado ningun producto');
                }else{
                    if ( $("#pp"+$('#id_producto').val()).length > 0 ) {
                        toastr.error('El producto ya se encuentra en la lista');
                    }else{  
                        agregarcampos($('#id_producto').val(), 'p', datos);             
                        toastr.success('El producto se ha agregado a la lista');
                        $('#id_producto').val('');
                        $('#descripcion_producto').val('');

                    }
                }
            }
        });
        
    }); 

function removerrowproducto(id_producto){
    console.log("Aqui"+id_producto);
    $('#precio_promo').val(parseFloat($('#precio_promo').val())-parseFloat($("#subtotal"+id_producto).val()));    
    $('#'+id_producto).remove();
    toastr.error('Se ha quitado el producto de la lista');

}

 

//Empiezan las funciones de botones
  
$('#borrarlista').on('click',function(e){
    e.preventDefault();
    $('#contienelista').empty();
    $('#precio_promo').val('0.00');
});

$("#btnagregarpromocion").click(function () {
    $('#contienelista').empty();
    $("#frmpromocion")[0].reset();
});



function obtenerpromociones(){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "Administrar_promociones/obtenerpromociones",
            success: function (datos) {
                var fila = '';
                fila = fila + '<div class="table-responsive mt-3">'+
                                '<table class="table table-stripped" id="tablapromociones" width="100%" cellspacing="0">'+
                                    '<thead class="">'+
                                    '<tr>'+
                                        '<th >Clave</th>'+
                                        '<th >Nombre de la promoción</th>'+
                                        '<th >Paquete de promoción</th>'+   
                                        '<th class="center" >Precio de la promoción</th>'+
                                        '<th >Fecha inicio</th>'+
                                        '<th >Fecha Fin</th>'+
                                        '<th class="text-center" >CONTROL</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tfoot class="">'+
                                '<tr>'+
                                     '<th >Clave</th>'+
                                        '<th >Nombre de la promoción</th>'+
                                        '<th >Paquete de promoción</th>'+   
                                        '<th class="text-center">Precio de la promoción</th>'+
                                        '<th >Fecha inicio</th>'+
                                        '<th >Fecha Fin</th>'+
                                        '<th class="text-center" >CONTROL</th>'+
                                '</tr>'+
                            '</tfoot>'+
                                '<tbody>';
                $.each(datos, function (key, value) {
    
                    fila = fila +   '<tr>'+
                    '<td>'+value.id_promo+'</td>'+
                    '<td>'+value.descripcion+'</td>'+
                    '<td>'+(value.servicios != null?value.servicios:'')+(value.servicios != null && value.productos != null?', ':'')+(value.productos != null?value.productos:'')+'</td>'+
                    '<td class="text-center">$'+value.precio_promo+'.00</td>'+
                    '<td>'+value.fecha_inicio+'</td>'+
                    '<td>'+value.fecha_fin+'</td>'+
                    '<td><div class="row p-0">'+
                    '<div class="mt-2">';
                    if(value.vendido == 0){
                        fila = fila + '<button class=" btnpersonalizado" id="btnactualizarpromocion" name="btnactualizarpromocion"  data-target=".agregarpromocion" data-toggle="modal" onclick="llenarformularioactualizar('+value.id_promo+')">'+
                           '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'+
                        '</button>';
                    }
                    fila = fila + '</div>'+
                    '<div class="mt-2">'+
                        '<button class=" btnpersonalizadoc" id="btneliminarpromocion" onclick="eliminarpromocion('+value.id_promo+')" name="btneliminarpromocion">'+
                            '<i class="fa fa-times" aria-hidden="true"></i>'+
                       '</button>'+
                    '</div>'+
                    '</div></td>'+
                '</tr>';
                });
    
                fila = fila + '</tbody>'+
                '</table></div></div><div class="card-footer small text-muted mt-3"> Administrador de promociones</div>';
                '</table></div>'+
        
                $("#divreporte").html(fila);
                
                $('#tablapromociones').dataTable({
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

$(document).on("change, keyup", ".precio", function(){
    var id = $(this).get(0).id.substr(6);
    multiplica(id);
    if($('#precio'+id).val() == ''){
        $('#subtotal'+id).val(0);
    }
    //$("#cantidad"+id).val(1);
});

$(document).on('keyup mouseup', ".cantidad", function(){
    var id = $(this).get(0).id.substr(8);
    multiplica(id);
      
});

function multiplica(id){
    
    $("#subtotal"+id).val(parseFloat($('#precio'+id).val())*parseFloat($('#cantidad'+id).val()));
    var total = 0;
    $('input[name="subtotal[]"]').each(function(){
        total = total + parseFloat($(this).val());
    });
    if(isNaN(total)){
        $('#precio_promo').val(0);       
    }else{
        $('#precio_promo').val(total);   
    }
    
}


function llenarformularioactualizar(id_promo) {
    resetear_formulario();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_promociones/llenarformularioactualizarservicios",
        data: {id_promo: id_promo},
        success: function (datos) {
            $('#id_promo').val(datos[0].id_promo)
            $('#descripcion').val(datos[0].descripcion_promo)
            $('#fecha_inicio').val(datos[0].fecha_inicio);
            $('#fecha_fin').val(datos[0].fecha_fin);
            $.each(datos, function (key, value) {
                console.log(value);
                agregarcampos(value.id_servicio, 's', value);                                                                                                             
            }); 
          $.ajax({
                type: "POST",
                dataType: "json",
                url: "Administrar_promociones/llenarformularioactualizarproductos",
                data: {id_promo: id_promo},
                success: function (datos) {
                    $.each(datos, function (key, value) {
                        console.log(value);
                        agregarcampos(value.id_producto, 'p', value);                                                                                                             
                    }); 
                }
            });
        }
    });
}

function resetear_formulario(){
    $('#contienelista').empty();
    $("#frmpromocion")[0].reset(); 
}

function eliminarpromocion(id_promo) {
    $.confirm({
        title: false,
        content: "¿Realmente desea dar de baja la promocion?",
        theme:"supervan",
        
        buttons:{
            
            Si: function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "Administrar_promociones/eliminarpromocion",
                    data: {
                        id_promo: id_promo
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
                        obtenerpromociones();
                        
                    }
                });
            },Cancelar:{
                text: 'No',
            }            
        }
    });
}