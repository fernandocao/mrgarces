$.datetimepicker.setLocale('es');

$(document).ready(function(){
    $("#fechainicio").datetimepicker({lang:'es', timepicker: false, format: 'Y-m-d'});   
    $("#fechafin").datetimepicker({lang:'es', timepicker: false, format: 'Y-m-d'});   
}); 

$("#verreporte").on("click", function(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url +"/reporteventas",
        data: $("#frmreporte").serialize()
    }).done(function (datos) {
        id_venta = 0;
        var fila = fila + '<div class="row"><div class="col-md-1">ID</div><div class="col-md-2">Fecha</div><div class="col-md-3">Cliente</div><div class="col-md-1">No. Art.</div><div class="col-md-1">Subtotal</div><div class="col-md-1">Total</div><div class="col-md-3">Observaciones</div></div>';        
        $.each(datos, function(llave, valor){
            if(id_venta != valor.id_venta){
                if(id_venta>0) fila = fila + '</div></div><hr>';
                id_venta=valor.id_venta;
                fila = fila + '<div><div class="row"><div class="col-md-1"><i id="btnmostrar'+ id_venta +'" class="fa fa-plus btn" onclick="verdetalleventa('+id_venta+')"></i><i id="btnocultar'+ id_venta +'" class="fa fa-minus btn" onclick="ocultardetalleventa('+id_venta+')" hidden></i><label>' + valor.id_venta + '</label></div><div class="col-md-2">' + valor.fecha + '</div><div class="col-md-3">' + valor.cliente + '</div><div class="col-md-1">' + valor.articulos_vendidos + '</div><div class="col-md-1">' + valor.subtotal + '</div><div class="col-md-1">' + valor.total + '</div><div class="col-md-3">' + valor.observaciones + '</div></div>';
                fila = fila + '<div class="ml-5 mb-3" id="'+id_venta+'" hidden><label>Detalle de la venta</label><div class="row"><div class="col-md-6">Descripción</div><div class="col-md-2">Compra</div><div class="col-md-2">Venta</div><div class="col-md-2">Cantidad</div></div>';
                fila = fila + '<div class="row"><div class="col-md-6">' + (valor.producto!=null?valor.producto:(valor.servicio!=null?valor.servicio:valor.promocion)) + '</div><div class="col-md-2">' + valor.costo_unitario + '</div><div class="col-md-2">' + valor.precio + '</div><div class="col-md-2">' + valor.cantidad + '</div></div>';
            }else{
                fila = fila + '<div class="row"><div class="col-md-6">' + (valor.producto!=null?valor.producto:(valor.servicio!=null?valor.servicio:valor.promocion)) + '</div><div class="col-md-2">' + valor.costo_unitario + '</div><div class="col-md-2">' + valor.precio + '</div><div class="col-md-2">' + valor.cantidad + '</div></div>';
            }
            
        });
        $("#divreporte").html(fila); 

    }).fail(function(){

    });    
})

$("#rango").on('change', function(){
    if( $("#rango option:selected").val() == 6 ) $(".divrango").removeAttr("hidden");
    else{ 
        $(".divrango").attr("hidden", true);
        $( "#fechainicio" ).datepicker({dateFormat:"yy-mm-dd"}).datepicker("setDate",new Date());
        $( "#fechafin" ).datepicker({dateFormat:"yy-mm-dd"}).datepicker("setDate",new Date());
    }
})

function verdetalleventa(id_venta){    
    $("#"+id_venta).removeAttr("hidden");
    $("#btnmostrar" + id_venta).attr("hidden", true);
    $("#btnocultar" + id_venta).removeAttr("hidden");
}

function ocultardetalleventa(id_venta){    
    $("#"+id_venta).attr("hidden",true);
    $("#btnocultar"+id_venta).attr("hidden", true);
    $("#btnmostrar"+id_venta).removeAttr("hidden");    
}
