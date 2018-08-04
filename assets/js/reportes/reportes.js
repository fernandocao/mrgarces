$.datetimepicker.setLocale('es');

$(document).ready(function(){
    $("#fechainicio").datetimepicker({lang:'es', timepicker: false, format: 'Y-m-d'});   
    $("#fechafin").datetimepicker({lang:'es', timepicker: false, format: 'Y-m-d'});   
});

$("#verreporte").on("click", function(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url +"/reportes",
        data: $("#frmreporte").serialize()
    }).done(function (datos) {
        generareporte(datos);
    }).fail(function(){

    });    
});

$("#rango").on('change', function(){
    if( $("#rango option:selected").val() == 6 ) $(".divrango").removeAttr("hidden");
    else{ 
        $(".divrango").attr("hidden", true);
        $( "#fechainicio" ).datepicker({dateFormat:"yy-mm-dd"}).datepicker("setDate",new Date());
        $( "#fechafin" ).datepicker({dateFormat:"yy-mm-dd"}).datepicker("setDate",new Date());
    }
});

$("#fechainicio").on("change", function(){
    verificafechas();
});

$("#fechafin").on("change", function(){
    verificafechas();
});

function generareporte(datos){
    switch( $("#tipo").val() ){
        case "1":
            reporteventas(datos);
            break;
        case "2":
            reportecomisiones(datos);
            break;
        case "3":
            reportegastos(datos);
            break;
        case "4":
            reporteinventarios(datos);
            break;

    }
}

function reporteventas(datos){
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
}

function reportecomisiones(datos){
    var fila = fila + '<div class="row"><div class="col-md-1">ID</div><div class="col-md-2">Fecha</div><div class="col-md-4">Barbero</div><div class="col-md-2">Monto</div><div class="col-md-3">Observaciones</div></div>';        
    $.each(datos, function(llave, valor){
            fila = fila + '<div class="row"><div class="col-md-1">' + valor.id_comision + '</label></div><div class="col-md-2">' + valor.fecha + '</div><div class="col-md-4">' + valor.barbero + '</div><div class="col-md-2">' + valor.monto + '</div><div class="col-md-3">' + valor.observaciones + '</div></div>';       
    });
    $("#divreporte").html(fila);     
}

function reportegastos(datos){
    var fila = fila + '<div class="row"><div class="col-md-1">ID</div><div class="col-md-2">Fecha</div><div class="col-md-4">Concepto</div><div class="col-md-2">Monto</div><div class="col-md-3">Observaciones</div></div>';        
    $.each(datos, function(llave, valor){
            fila = fila + '<div class="row"><div class="col-md-1">' + valor.id_gasto + '</label></div><div class="col-md-2">' + valor.fecha + '</div><div class="col-md-4">' + valor.concepto + '</div><div class="col-md-2">' + valor.monto + '</div><div class="col-md-3">' + valor.observaciones + '</div></div>';       
    });
    $("#divreporte").html(fila);     
}

function reporteinventarios(datos){
    var fila = fila + '<div class="row"><div class="col-md-1">ID</div><div class="col-md-3">Descripción</div><div class="col-md-2">Existencia</div><div class="col-md-2">Costo</div><div class="col-md-2">Precio</div></div>';        
    $.each(datos, function(llave, valor){
            fila = fila + '<div class="row"><div class="col-md-1">' + valor.id_producto + '</label></div><div class="col-md-3">' + valor.descripcion + '</div><div class="col-md-2">' + valor.existencia + '</div><div class="col-md-2">' + valor.costo_unitario + '</div><div class="col-md-2">' + valor.precio_venta + '</div></div>';       
    });
    $("#divreporte").html(fila);     
}

function verificafechas(){
    if ( $("#fechainicio").val() > $("#fechafin").val() ) $("#fechafin").val( $("#fechainicio").val() );
}

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
