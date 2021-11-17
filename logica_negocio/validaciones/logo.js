$(function() {

    CargarImagenLogo();

});

function CargarImagenLogo() {
    console.log("Entro a cargarimagen ");
    var datos = { "consultar_datos": "si_imagenLogo" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "../empresa/json_empresa.php",
        data: datos,
        success: function(json) {
            if (json[0] == "Exito") {
                $('#dataLogo').html(json[1]);
            } else {
                toastify("¡Acción Fallida!\nRegistro no se pudo encontrar", 2);
            }

        }
    });
}