/*Actualizar componente*/
$("#frmcerrarsesion").on("submit", function (e) {    
    e.preventDefault();    
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: "Login/cerrar_sesion",
        data: $("#frmcerrarsesion").serialize(),
        success: function(data){
            if(data.resp==2)window.location.replace("login");
            else 
                if(data.resp==1) toastr.error('La contraseñas nuevas no coinciden.', 'Error!!', {timeOut: 5000});
                else toastr.error('La contraseña actual no es la correcta.', 'Error!!', {timeOut: 5000});
        }
    });
    
});

