$.datetimepicker.setLocale('es');

$(document).ready(function(){
    $('#cliente').autocomplete({
        source: url+'/autocompletarclientes', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        change: function(event, ui){
            if(ui.item==null){
                $("#id_cliente").val(0);
                $("#cliente").val("Público en general");
                $("#btnmostrarhistorial").attr("hidden",true);                
            }
        },
        select: function(event, ui){
            $("#id_cliente").val(ui.item.id);          
            $("#correocliente").val(ui.item.correo);
            $("#btnmostrarhistorial").removeAttr("hidden");
            buscaservicios(ui.item.id);
        }        
    });

    $('#articulo').autocomplete({
        source: url+'/autocompletararticulos', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        change: function(event, ui){
            if(ui.item==null){
                $("#id_articulo").val(0);
            }
        },
        select: function(event, ui){
            event.preventDefault();
            $("#id_articulo").val(ui.item.id);          
            $("#articulo").val(ui.item.value);
            $("#precio").val(ui.item.precio);
            if(ui.item.tipo == "s"){
                if( $("#id_servicio").val()==0 ) $("#id_servicio").val(ui.item.id);             
                if($("#id_cliente").val()!=0){
                    if( (parseInt($("#servicios").val())) % 6 == 0 ){
                        $("#precio").val(0);
                        $("#observaciones").val("Es el 6to servicio solicitado por este cliente, Promoción el 6to es gratis");
                    }
                }
            }
            $("#existencia").val(ui.item.existencia);
            $("#tipo").val(ui.item.tipo);                                                
            agregararticulo();
            $("#articulo").val("");
        }        
    });
    obtenerbarbero();
    rows= ' <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Descripción</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead><tbody id="cuerpotabla"></tbody></table>';    
    $("#divarticulos").html(rows);
    inicializatabla();    
}); 

function buscaservicios(id_cliente){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url +"/obtenerservicios",
        data: {id_cliente:id_cliente}
    }).done(function (servicios){        
        var id = $("#id_servicio").val();
        
        $("#servicios").val(servicios);           
        if( id>0 ){
            
            if( ( parseInt($("#servicios").val() )) % 6 == 0 ){
            
                $("#precios" + id ).val(0);
                $("#observaciones").val("Es el 6to servicio solicitado por este cliente, Promoción el 6to es gratis");
                console.log($("#cantidads"+id).val());
                $("#gsubtotal").val( (parseFloat($("#gsubtotal").val()) - parseFloat($("#subtotals"+id).val()) ) + parseFloat($("#cantidads"+id).val()*$("#precios"+id).val()) );
                $("#gtotal").val( parseFloat($("#gsubtotal").val()) - ( parseFloat($("#gsubtotal").val()) * parseFloat($("#descuento").val())/100 ) );
                $("#subtotals"+id).val( $("#cantidads"+id).val()*$("#precios"+id).val());                 
                actualizacambio();               
            }        
        }
    });        
}

function obtenerbarbero(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url +"/obtenerpersonal",
        data: {tipo:2}
    }).done(function (personal){
        //console.log(personal);
        $("#barbero").append($('<option>',{value: "0" , text: "Venta de mostrador"}));
        $.each(personal, function(llave, valor){
            //console.log(valor);
            $("#barbero").append($('<option>',{value: valor.id_persona , text: valor.nombre}));
        });        
    });    
}

function actualizacambio(){
    if( $("#gtotal").val()>0){
        if($("#pago").val()>0 ) $("#cambio").val( parseFloat($("#pago").val()) - parseFloat($("#gtotal").val()) );        
        else $("#cambio").val( 0 );
    }else $("#cambio").val( 0 );
}

function inicializatabla(){
    $('#dataTable').dataTable({
        "columns": [
            { "width": "55%" },
            { "width": "15%" },
            { "width": "15%" },
            { "width": "15%" }
        ],
        searching: false,
        paging: false,
        language: {
            "decimal":        "",
            "emptyTable":     "No se han agregado articulos a la venta.",
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

function agregararticulo(){
    if( $("#id_articulo").val()!=0){
        if( $("#existencia").val() == 0 && $("#tipo").val() == "a" ) alert("No hay");
        else{
            var id=$("#tipo").val()+$("#id_articulo").val();
            var nuevafila = "<tr id='tr"+id+"'><td class='input-group'>"+
                                "<input type='text' name='ids[]' value='"+$("#id_articulo").val()+"' hidden />"+
                                "<input type='text' name='tipos[]' value='"+$("#tipo").val()+"' hidden />"+
                                "<i class='fa fa-times-circle btn' onclick='borrararticulo(\"tr"+id+"\")'></i>"+
                                "<p class='form-control'> "+ $("#articulo").val() +"</p>"+
                            "</td><td>"+
                                "<input class='form-control' type='text' name='precios[]' id='precio"+id+"' value='"+$("#precio").val()+"' readonly />"+
                            "</td><td>"+
                                "<input class='form-control campocantidad' type='number' min='1' id='cantidad"+id+"' name='cantidades[]' value='1'>"+
                            "</td><td>"+
                                "<input class='form-control' type='text' name='subtotales[]' id='subtotal"+id+"' value='"+$("#precio").val()+"' readonly />"+
                            "</td></tr>";

            $("#gsubtotal").val(parseFloat($("#gsubtotal").val()) + parseFloat($("#precio").val()));
            $("#gtotal").val( parseFloat($("#gsubtotal").val()) - ( parseFloat($("#gsubtotal").val()) * parseFloat($("#descuento").val())/100 ) );
            actualizacambio();
            $("#dataTable").dataTable().fnDestroy();

            $("#cuerpotabla").append(nuevafila);
            inicializatabla();            
            $("#cantidad"+id).focus();              
        }
    }    
}

function borrararticulo(id){
//    console.log($("#"+id).parents('tr')[0]);
    if( id.substr(3) == $("#id_servicio").val() ){
        $("#id_servicio").val(0);
        $("#observaciones").val("");
    }
    //console.log(id + " - " + id.substr(3) + " - " + $("#gsubtotal").val() + " - " + parseFloat($("#subtotal"+ id.substr(2,1) + id.substr(3)).val()) ); 
    $("#gsubtotal").val( parseFloat($("#gsubtotal").val()) - parseFloat($("#subtotal"+ id.substr(2,1) + id.substr(3)).val() ));
    $("#gtotal").val( parseFloat($("#gsubtotal").val()) - ( parseFloat($("#gsubtotal").val()) * parseFloat($("#descuento").val())/100 ) );        
    actualizacambio();
    var tabla = $('#dataTable').DataTable();
    $("#"+id).remove();
    tabla.row( $("#"+id).parents('tr')[0] ).remove().draw();
}

$("#btnmostrarhistorial").on("click", function(){
    var obj = $.confirm({
        theme: 'supervan',
        content: function(){            
            var self = this;            
            return $.ajax({
                type: "POST",
                dataType: "json",
                url: url +"/mostrarhistorial",
                data: {id_cliente: $("#id_cliente").val()}
            }).done(function (datos) {                
                fila = '<table class="table table-stripped" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>ID</th><th>Fecha</th><th>Total</th><th>Descripción</th></tr></thead><tbody>';
                var ultimapromocion = 0;
                var dias = 0;
                $.each(datos, function(llave, valor){
                    ultimapromocion = ultimapromocion + 1;
                    if(parseFloat(valor.total)==0) dias = 5 - ultimapromocion + 1;
                    fila = fila + '<tr><td>'+valor.id_venta+'</td><td>'+valor.fecha+'</td><td>'+(parseFloat(valor.total)==0?'Promoción':valor.total)+'</td><td>'+valor.descripcion+'</td></tr>';
                });
                fila = fila + '</tbody></table><label class="form-control"><b>*</b> Faltan <b>'+dias+'</b> servicios para su próxima cortesía.</label>';
                $("#divhistorial").html(fila);
                obj.close();
            }).fail(function(){
                self.setContentAppend('<div>Error al obtener los datos</div>');
            });
        },
        buttons: {Continuar: function(){}}        
    });    
});

$("#btnagregararticulo").on("click", function(){
    agregararticulo();
});

$(document).on('focusout', ".campocantidad", function(){
    var id = $(this).get(0).id.substr(8);
    if($(this).val().trim()=="") $(this).val(1);
    $("#gsubtotal").val( (parseFloat($("#gsubtotal").val()) - parseFloat($("#subtotal"+id).val()) ) + parseFloat($(this).val()*$("#precio"+id).val()) );
    $("#gtotal").val( parseFloat($("#gsubtotal").val()) - ( parseFloat($("#gsubtotal").val()) * parseFloat($("#descuento").val())/100 ) );    
    $("#subtotal"+id).val( $(this).val()*$("#precio"+id).val());   
    actualizacambio();   
});

$(document).on('keyup mouseup', ".campocantidad", function(){
    //if($(this).val().trim()=="") $(this).val(1);
    var id = $(this).get(0).id.substr(8);
    $("#gsubtotal").val( (parseFloat($("#gsubtotal").val()) - parseFloat($("#subtotal"+id).val()) ) + parseFloat($(this).val()*$("#precio"+id).val()) );
    $("#gtotal").val( parseFloat($("#gsubtotal").val()) - ( parseFloat($("#gsubtotal").val()) * parseFloat($("#descuento").val())/100 ) );    
    $("#subtotal"+id).val( $(this).val()*$("#precio"+id).val());  
    actualizacambio();
});

$(document).on('keyup mouseup', "#pago", function(){
    actualizacambio();
});

$("#descuento").on('change', function(){
    if($("#descuento").val().trim()=="") $(this).val(0);
    if($("#descuento").val()>100) $(this).val(100);
    if($("#descuento").val()<0) $(this).val(0);
    $("#gtotal").val( parseFloat($("#gsubtotal").val()) - ( parseFloat($("#gsubtotal").val()) * parseFloat($("#descuento").val())/100 ) );
    actualizacambio();    
});

$("#frmrealizarventa").on('submit', function(e){
    var tablasindatos='<tr class="odd"><td colspan="4" class="dataTables_empty" valign="top">No se han agregado articulos a la venta.</td></tr>';
    //console.log($("#cuerpotabla").html());
    //console.log(tablasindatos);
    if($("#cuerpotabla").html().trim()!="" && $("#cuerpotabla").html().trim()!=tablasindatos){
        //console.log("1");
        e.preventDefault();   
        $.confirm({
            theme: 'supervan',
            title: 'Registro de ventas!',
            icon: 'fa fa-shopping-cart',
            content: function(){            
                var self = this;            
                return $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: url +"/realizarventa",
                    data: $("#frmrealizarventa").serialize()
                }).done(function (response) {
                    self.setContentAppend('<div>La venta fue registrada.</div>');
                    $("#frmrealizarventa")[0].reset();
                    $("#cuerpotabla").html("");
                    var table = $('#dataTable').DataTable();
                    table
                        .clear()
                        .draw();
                    $("#btnmostrarhistorial").attr("hidden",true);
                }).fail(function(){
                    self.setContentAppend('<div>Error al registrar los datos</div>');
                });
            },
            buttons: {Continuar: function(){}}        
        });
    }else{
        $.confirm({theme: 'supervan', title: 'Registro de ventas!', icon: 'fa fa-shopping-cart', content: 'No se puede registrar una venta vacía.', buttons: {Continuar: function(){}}});
    }    
});