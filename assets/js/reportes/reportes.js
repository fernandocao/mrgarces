$.datetimepicker.setLocale('es');

$(document).ready(function(){

}); 

$("#verreporte").on("click", function(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: url +"/reporteventas",
        data: {tipo: $("#rango option:selected").val()}
    }).done(function (response) {
        
    }).fail(function(){

    });    
})