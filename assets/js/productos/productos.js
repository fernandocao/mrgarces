$(document).ready(function() {  
    obtener_producto(1);
    llenar_categoria();    
    llenar_proveedor();    
    $('#categoria').autocomplete({
        source: 'Administrar_productos/autocompletar?tabla=productos&campo=categoria', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#modelo').autocomplete({
        source: 'Administrar_productos/autocompletar?tabla=productos&campo=modelo', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

    $('#marca').autocomplete({
        source: 'Administrar_productos/autocompletar?tabla=productos&campo=marca', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });    

    $('#unidad_medida').autocomplete({
        source: 'Administrar_productos/autocompletar?tabla=productos&campo=unidad_medida', 
        minLength:2,
        html: true,  
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        }
    });

});

/*------------------------------------------------------------------*/

/* VALIDACION LETRAS | NUMEROS */
/* EXPRESION REGULAR /^[ a-z0-9áéíóúüñ]*$/ */

/*FIN VALIDACION*/

/*--------------------------------------------------------------------*/

/* VALIDACION LETRAS */
/* EXPRESION REGULAR /^[a-zA-Z]*$/ */



/*FIN VALIDACION*/

/*--------------------------------------------------------------------*/

/*VALIDACION MUMEROS  /^[0-9]$/*/
/*EXPRESION REGULAR /^[0-9]$/*/



/*FIN VALIDACION*/

/*--------------------------------------------------------------------*/

/*VALIDACION CAMPOS VACIOS

function validacion_campoVacio(valor){
    valor = valor.replace("&nbsp", "");
    valor = valor == undefined ? "" : valor;
    if(!valor || 0 === valor.trim().length){
       return true;
       }else{
           return false;
       }
}

function validaCampos(){
    var categoria = document.getElementById("categoria")[0].value;
    var noserie = document.getElementById("noserie")[0].value;
    var modelo = document.getElementById("modelo")[0].value;
    var marca = document.getElementById("marca")[0].value;
    var costo_unitario = document.getElementById("costo_unitario")[0].value;
    var precio_venta = document.getElementById("precio_venta")[0].value;
    var codigo_interno = document.getElementById("codigo_interno")[0].value;
    var existencia = document.getElementById("stock")[0].value;
    var unidad_medida = document.getElementById("unidad_medida")[0].value;
    var descripcion = document.getElementById("descripcion")[0].value;
    
    if(validacion_campoVacio(categoria.value) || validacion_campoVacio(noserie.value) || validacion_campoVacio(modelo.value) || validacion_campoVacio(marca.value) || validacion_campoVacio(costo_unitario.value) || validacion_campoVacio(precio_venta.value) || validacion_campoVacio(codigo_interno.value) || validacion_campoVacio(existencia.value) || validacion_campoVacio(unidad_medida.value) || validacion_campoVacio(descripcion.value)){
       alert("Favor de llenar los campos correctamente","¡ERROR!");
        return false;
       }
    return true;
}

/*FIN VALIDACION*/

$("#frmregistrarproducto").on("submit", function (e) {
    //alert('Entrar');
    e.preventDefault();
    $.ajax({  
        dataType: 'json',
        type: 'post',        
        //data: $("#frmregistrarbarbero").serialize(),
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        url: "Administrar_productos/registrarproductos",
        success: function(data){       
            if($("#id_producto").val() == 0){
                //alert('Registrado');
                registroterminado("Registrado");
            }else{
                //alert('Actualizado');
                registroterminado("Actualizado");
            }
        }        
    });    
});

function registroterminado(texto){
    toastr.success("Correctamente","Producto " + texto ); 
    //console.log("registro");
    $('.registrarproducto').modal('hide');
    $('#frmregistrarproducto')[0].reset();
    obtener_producto();                    
}

/*$("#btnagregarnoserie").on('click', function(){    
  if($("#serie").val()!=""){
    $("#noserie").append($('<option>',{value: $("#serie").val() , text: $("#serie").val()}));
    $("#serie").val("");
  }
    
});*/

/*var comparar = function(){
    var costo_unitario = $("#costo_unitario").val();
    var precio_venta   = $("#precio_venta").val();
    
}

$("#precio_venta").on('keyup', comparar);*/


function resetearFormulario(){
    $("#frmregistrarproducto")[0].reset();        
    //$("#img_producto").show();
    //$("#btn_foto").removeAttr('src');
}

/*Leer ruta imagen*/

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img_producto').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#btn_foto").change(function() {
    readURL(this);
});

function obtener_producto(tipo){
    console.log(tipo);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "Administrar_productos/obtenerproducto",
        data: {tipo:tipo},
    }).done(function(datos){
        var fila = '';
        fila = fila + '<div class="table-responsive mt-3">'
            fila = fila + '<table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th width="5%">Foto</th>'+
                                    '<th>ID</th>'+
                                    '<th>Sucursal</th>'+
                                    '<th>Categoria</th>'+   
                                    '<th>Marca</th>'+
                                    '<th>Descripcion</th>'+        
                                    '<th>Existencias</th>'+
                                    '<th>Proveedor</th>'+
                                    '<th>P.Venta</th>'+
                                    '<th class="text-center">CONTROL</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>';
        var categoria = ["NA","Barbería","Accesorios","Boutique"];
            $.each(datos,function(key, value){
                console.log(value.categoria);
                fila = fila +   '<tr>'+
                                    '<td><img class="img-fluid" src="../../assets/foto_productos/'+value.id_producto+'.jpg" alt=""></td>'+
                                    '<td>'+value.id_producto+'</td>'+
                                    '<td>'+value.sucursal+'</td>'+
                                    '<td>'+categoria[value.categoria]+'</td>'+
                                    '<td>'+value.marca+'</td>'+
                                    '<td>'+value.descripcion+'</td>'+
                                    '<td>'+value.existencia+'</td>'+
                                    '<td>'+value.nombre_comercial+'</td>'+
                                    '<td>$'+value.precio_venta+'</td>'+
                                    '<td><button class="btn btnpersonalizado" data-target=".perfilproducto" data-toggle="modal" onclick="perfil_producto('+value.id_producto+')"><i class="fa fa-address-card-o"></i></button>';
                                    if(tipo == 1){ fila = fila + '<button id="btnactualizar" name="btnactualizar" class="btn btnpersonalizado" data-target=".registrarproducto" data-toggle="modal" onclick="llenarformulario('+value.id_producto+')"><i class="fa fa-pencil-square-o"></i></button>';                                    
                                    fila = fila + '<button  class="btn btnpersonalizadoc" type="submit" onclick="baja_producto('+value.id_producto+')" id="btnbajaproducto" name="btnbajaproducto"><i class="fa fa-times"></i></button></td>';
                                }
                                if(tipo == 0) fila = fila + '<button id="btnactivar" name="btnactivar" class="btn btnpersonalizado" onclick="hab_producto('+value.id_producto+')"><i class="fa fa-check"></i></button>';
                                '</tr>';
            });
            fila = fila +   '</tbody>'+
                        '</table>'+
        '</div>';
            $("#dataTable").dataTable().fnDestroy();
            if(tipo==1) $("#divinventario").html(fila);
            else if(tipo==0) $("#divbajas").html(fila);
                else $("#divtodos").html(fila);

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

function baja_producto(id_producto){
    $.confirm({
        title: "¿Eliminar producto?",
        content: "Inhabilitar el producto del sistema",                
        theme: 'supervan',
        buttons:{
            INHABILITAR: function(){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "Administrar_productos/bajaproducto",
                    data:{
                        id_producto: id_producto
                    },
                }).done(function(datos){
                    toastr.warning("Correctamente","Producto Inhabilitado"); 
                    obtener_producto();
                    //obtener_producto_baja();
                });
            },CANCELAR:{
                text: 'Cancelar',
                    action: function () {
                    //$.alert('ACCION CANCELADA');                        
                }
            }
        }
    });
}

function hab_producto(id_producto){
    $.confirm({
        title: "¿Agregar producto?",
        content: "Habilitar nuevamente el producto al inventario",                
        theme: 'supervan',
        buttons:{
            HABILITAR: function(){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "Administrar_productos/habilitarproducto",
                    data:{
                        id_producto: id_producto
                    },
                }).done(function(datos){
                    $(".productosBajas").modal('hide');
                    toastr.info("Correctamente","Producto habilitado"); 
                    obtener_producto();
                    //obtener_producto_baja();
                });
            },CANCELAR:{
                text: 'Cancelar',
                    action: function () {
                    //$.alert('ACCION CANCELADA');                        
                }
            }
        }
    });
}

function perfil_producto(id_producto){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "Administrar_productos/perfil_productos",
        data:{
            id_producto: id_producto
        },
    }).done(function(datos){
        var fila = '';  
        var categoria = ["NA","Barbería","Accesorios","Boutique"];
            $.each(datos,function(key, value){
                
                fila = fila + '<div class="row">';
                
                fila = fila + '<div class="col-md-5 d-flex" style="height: 100vh;"> <div class="row"> <div class="form-group col-md-12 my-auto"><img class="img-fluid" src="../../assets/foto_productos/'+value.id_producto+'.jpg" alt=""></div></div></div>';
                
                //fila = fila + '<hr class="featurette-divider">';
                
                fila = fila + '<div class="col-md-7">';
                
                fila = fila +  '<div class="row"><div class="form-group col-md-5"><label for=""><b>ID Producto:</b></label></div><div class="form-group col-md-7">'+value.id_producto+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila +   '<div class="row"><div class="form-group col-md-5"><label for=""><b>Sucursal:</b></label></div><div class="form-group col-md-7">'+value.sucursal+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila +   '<div class="row"><div class="form-group col-md-5"><label for=""><b>Descripcion:</b></label></div><div class="form-group col-md-7">'+value.descripcion+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila +   '<div class="row"><div class="form-group col-md-5"><label for=""><b>Categoria:</b></label></div><div class="form-group col-md-7">'+categoria[value.categoria]+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                    
                fila = fila +  '<div class="row"><div class="form-group col-md-5"><label for=""><b>Marca:</b></label></div><div class="form-group col-md-7">'+value.marca+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila + '<div class="row"><div class="form-group col-md-5"><label for=""><b>Modelo:</b></label></div><div class="form-group col-md-7">'+value.modelo+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila +  '<div class="row"><div class="form-group col-md-5"><label for=""><b>Unidad medida:</b></label></div><div class="form-group col-md-7">'+value.unidad_medida+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila + '<div class="row"><div class="form-group col-md-5"><label for=""><b>Existencia:</b></label></div><div class="form-group col-md-7">'+value.existencia+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila +  '<div class="row"><div class="form-group col-md-5"><label for=""><b>Costo unitario:</b></label></div><div class="form-group col-md-7">$'+value.costo_unitario+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                    
                fila = fila + '<div class="row"><div class="form-group col-md-5"><label for=""><b>Precio venta:</b></label></div><div class="form-group col-md-7">$'+value.precio_venta+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                
                fila = fila + '<div class="row"><div class="form-group col-md-5"><label for=""><b>Stock:</b></label></div><div class="form-group col-md-7">'+value.stock+'</div></div>';
                
                fila = fila + '<hr class="featurette-divider">';
                    
                fila = fila + '<div class="row"><div class="form-group col-md-5"><label for=""><b>Codigo interno:</b></label></div><div class="form-group col-md-7">'+value.codigo_interno+'</div></div>';                                

                fila = fila + '<hr class="featurette-divider">';
                    
                fila = fila + '<div class="row"><div class="form-group col-md-5"><label for=""><b>Proveedor:</b></label></div><div class="form-group col-md-7">'+value.nombre_comercial+'</div></div>';
                
                fila = fila + '</div></div>';
            });
            
            $("#perfil").html(fila);
        
    });
}

function llenarformulario(id_producto){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "Administrar_productos/llenarformulario",
        data:{
            id_producto: id_producto
        },
    }).done(function(datos){
           var fila = '';
            $.each(datos,function(key, value){
                $("#id_producto").val(value.id_producto);
                fila = fila + '<div class="col-md-12"> <div class="row"> <div class="form-group col-md-12"><img class="img-fluid" src="../../assets/foto_productos/'+value.id_producto+'.jpg" alt=""></div></div></div>';                
                $('#img_producto').val(value.id_producto);
                $('#sucursal').val(value.sucursal);
                $("#id_proveedor").val(value.id_proveedor);
                $('#descripcion').val(value.descripcion);
                $('#categoria').val(value.categoria);
                $('#marca').val(value.marca);
                $('#modelo').val(value.modelo);
                $('#unidad_medida').val(value.unidad_medida);
                $('#existencia').val(value.existencia);
                $('#costo_unitario').val(value.costo_unitario);
                $('#precio_venta').val(value.precio_venta);
                $('#stock').val(value.stock);
                $('#codigo_interno').val(value.codigo_interno);
            });
        $("#div_foto").html(fila);        
    });
}

function llenar_categoria(){    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_productos/llenarcategoria",
        data:{tipo_producto:$('#tipo_producto').val()},
        success: function(datos){
            $("#tipo_producto").empty();            
            $("#tipo_producto").append($('<option>',{value: "" , text: "Tipo de producto"}));            
            $.each(datos, function(key, value){
                $("#tipo_producto").append($('<option>',{value: value.id_producto , text: value.categoria}));                
            });
        }
    });
}

function llenar_proveedor(){    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_productos/llenarproveedor",
        success: function(datos){
            $("#id_proveedor").empty();            
            $("#id_proveedor").append($('<option>',{value: "" , text: "Seleccione un proveedor"}));                        
            $.each(datos, function(key, value){
                $("#id_proveedor").append($('<option>',{value: value.id_proveedor , text: value.nombre_comercial}));                                
            });
        }
    });
}