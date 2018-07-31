//Prueba GIT
$.datetimepicker.setLocale('es');

$(document).ready(function(){
    $('#cliente').autocomplete({
        source: url+'/autocompletarclientes', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
            $("#id_cliente").val(ui.item.id);          
            $("#correocliente").val(ui.item.correo);
        }        
    });

    $('#barbero').autocomplete({
        source: url+'/autocompletarbarberos', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
            $("#id_barbero").val(ui.item.id);
            $("#correobarbero").val(ui.item.correo);    
            if($("#id_barbero").val()>0 && fecha!=""){
                var datos = actualizacitas($("#id_barbero").val(), $("#fecha").val());
                var dias = calculadias(datos, "0", "0");
                llenacitas(dias);                
            }       
        }        
    });    

    $('#servicio').autocomplete({
        source: url+'/autocompletarservicio', 
        minLength:2,
        html: true,          
        open: function(event, ui) {           
           $(".ui-autocomplete").css("z-index", 100000, "!important");
        },
        select: function(event, ui){
        	$("#id_servicio").val(ui.item.id);        	
            $("#duracion").val(ui.item.duracion);
        }        
    });

    $("#fecha").datetimepicker({lang:'es', step:30, format: 'Y-m-d H:i'});   

    var eventos = [];

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "Administrar_citas/listarcitas",
        success: function (datos) {                                    
            $.each(datos, function(llave, valor){
                //eventos.push({title:valor.description, start: valor.start.dateTime.substring(0,10) });
                $("#calendar").fullCalendar('renderEvent',
                   {
                       title: valor.description,
                       start: valor.start.dateTime.substring(0,10),
//                       end: endTime,
                   },
                true);                
            });
        }

    });            

    console.log(eventos);

    $('#calendar').fullCalendar({
        events:  eventos ,        
        dayClick: function() {
        }
    });
    
    inicializacitas();
});

// datos    = listado de citas obtenidos de la BD
// fecha    = fecha de la nueva cita
// duracion = duración de la nueva cita
// si fecha y duración son distinto de 0 y hay coincidencia con las citas debera regresar null
function calculadias(datos, fecha, cduracion){
    var respuesta = 0;
    var duracion = 0;    
    var cita = null;
    var dias = new Array([0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]);        
    //console.log(fecha);
    if(fecha!="0") cita = fecha.substring(11).split(":"); 
    $.each(datos, function(llave, valor){
        //console.log(valor);
        var periodo = valor.fecha.split(":");
        var duracion = Math.ceil((datos[llave].duracion/10)+(periodo[1]/10));
        //console.log(periodo);
        var excede =0;
        for(contador=parseInt(periodo[1]/10);contador<duracion; contador++){    
            dias[periodo[0]-9+excede][contador-(excede*5)]=1;
/*
            if(cita!=null){                
                //console.log( "P "+ (periodo[0]-9) + "I "+ periodo[1]/10 +" D " + duracion + " F " + (cita[0]-9) +" I "+(cita[1]/10)+" DC "+(cduracion/10));                
                if( ((periodo[0]-9) == (cita[0]-9)) && ((cita[1]/10) >= (periodo[1]/10) && (cita[1]/10)<=  (periodo[1]/10)+duracion ) ){
                    //console.log("NULL");
                    respuesta = 1;
                }
            } 
*/            
            if(contador>=4+(excede*5)) excede=excede+1;
        }
    });        

    if(cita!=null){                
        periodo = cita;
        duracion = Math.ceil( (cduracion/10) + (periodo[1]/10) );
        excede=0;
        for(contador=parseInt(periodo[1]/10);contador<duracion; contador++){    
            if( dias[periodo[0]-9+excede][contador-(excede*5)] == 1 ) respuesta=1;
            else dias[periodo[0]-9+excede][contador-(excede*5)]=2;            
            if(contador>=4+(excede*5)) excede=excede+1;
        }        
    }

    if(respuesta==1) return null;
    else return dias;    
}

function llenacitas(dias){
    var rows = '<label>Citas agendadas</label><table class="table-bordered"><tr><th>Hora</th><th>10</th><th>20</th><th>30</th><th>40</th><th>50</th></tr>';
    for(contador=0;contador<12;contador++){
        rows=rows+'<tr><td>'+(contador+9)+':00</td>';
        for(columnas=0;columnas<5;columnas++)
            if (dias[contador][columnas]==0) rows = rows+'<td></td>'; 
            else if(dias[contador][columnas]==1) rows = rows + '<td style="background:#007bff;"></td>';
                else rows = rows + '<td style="background:#aa7b00;"></td>';
        rows=rows+'</tr>';
    }
    rows=rows+'</table>';
    $("#divcitas").html(rows);    
}

function actualizacitas(id_barbero, fecha){
    var respuesta = null;
    $.ajax({
        data: $("#frmagendarcita").serialize(),
        type: "POST",
        dataType: "json",
        url: "Administrar_citas/obtenercitas",
        data: {id_barbero:id_barbero, fecha:fecha},
        async : false,
        success: function (datos) {                                    
            respuesta = datos;                
        }
    });    
    return respuesta;
}

$("#btnagendarcita").on("click", function(){
    inicializacitas();
});

$("#btnagregarservicio").on('click',function(){
    if($("#id_barbero").val()>0 && fecha!=""){
        var datos = actualizacitas($("#id_barbero").val(), $("#fecha").val());
        var totald = $("input[name='duraciones[]']").map(function(){return $(this).val();}).get();
        var total= parseInt($("#duracion").val());
        $.each(totald,function(llave, valor) {
            total = total + parseInt(valor);
        });        
        var dias = calculadias(datos, $("#fecha").val(), total);
        if(dias != null){
            //console.log(dias);
            llenacitas(dias);          
            $("#divservicios").append("<div id='div"+$("#id_servicio").val()+"' class='row'>"+
                                        "<div id='ids' hidden >"+
                                            "<input type='text' name='id_servicio[]' value='"+$("#id_servicio").val()+"' />"+
                                        "</div>"+
                                        "<div class='col-md-8'>"+"<p class='form-control'>"+$("#servicio").val()+"</p></div>"+
                                        "<div id='divduracion' class='col-md-4'><div class='input-group'><input class='form-control' type='text' name='duraciones[]' value='"+$("#duracion").val()+"' />"+
                                        "<a href='#' onclick='quitarservicio(div"+$("#id_servicio").val()+")'><i class='fa fa-times btn btn-light'></i></a></div></div>"+
                                    "</div>");
        }else toastr.error("Tiene citas agendadas en esta fecha y horario.", "Citas", 1500);
        
    }else toastr.error("Debe seleccionar el nombre del barbero, la fecha y la hora del servicio.","",1500);
});

function inicializacitas(){
    rows = '<label>Citas agendadas</label>'+
            '<table class="table-bordered">'+
            '<tr><th>Hora</th><th>10</th><th>20</th><th>30</th><th>40</th><th>50</th></tr>';
    for(x=9;x<21;x++){
        rows = rows + '<tr><td>'+x+':00</td><td></td><td></td><td></td><td></td><td></td></tr>';
    }                                    
    rows = rows + '</table>';
    $("#divcitas").html(rows);
}

function quitarservicio(div){
	$("#divservicios").remove(div);
}

$("#frmagendarcita").on("submit", function(e){
    e.preventDefault();
    $(".modal").hide();
    $.ajax({
        data: $("#frmagendarcita").serialize(),
        type: "POST",
        dataType: "json",
        url: "Administrar_citas/agendarcita",
        success: function (datos) {                      
            $('.modal').modal('hide');
            toastr.success("Se agendo la cita.");
            $("#frmagendarcita")[0].reset();
            $("#divservicios").html("");            
        }
    });    
});

$("#fecha").on("change",function(){
    if($("#id_barbero").val()>0 && fecha!=""){
        var datos = actualizacitas($("#id_barbero").val(), $("#fecha").val());
        var dias = calculadias(datos, "0", "0");
        llenacitas(dias);          
    }
});