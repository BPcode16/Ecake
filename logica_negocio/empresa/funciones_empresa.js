$(function() {

    $.mask.definitions['~'] = '[2,6,7]';
    $('#telefono').mask("~999-9999");

    console.log("JQuery si esta funcionando");
    CargarDatos();


    $(document).on("submit", "#formulario_registro", function(e) {
        e.preventDefault();
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+.)+[A-Z]{2,4}$/i;

        var nombreAdd = $('#nombre').val();
        var emailAdd = $('#email').val();
        var telefonoAdd = $('#telefono').val();
        var horarioAdd = $('#horario').val();
        //var logoAdd = $('#logo').val();
        var direccionAdd = $('#direccion').val();

        $('#nombre').css("background", "#fff");
        $('#email').css("background", "#fff");
        $('#telefono').css("background", "#fff");
        $('#horario').css("background", "#fff");
        //$('#logo').css("background", "#fff");
        $('#direccion').css("background", "#fff");

        if (nombreAdd.length < 3) {
            toastify("Campo Nombre vacío", 2);
            $('#nombre').focus();
            $('#nombre').css("background", "#fb6e893b").fadeIn(3000);
        } else if (emailAdd.length < 3 && !reg.test(emailAdd)) {
            toastify("Campo email vacío", 2);
            $('#nombre').css("background", "#fff");
            $('#email').focus();
            $('#email').css("background", "#fb6e893b").fadeIn(3000);
        } else if (soloCorreo(emailAdd) == false) {
            toastify("Ingrese un email correcto", 2);
            $('#nombre').css("background", "#fff");
            $('#email').focus();
            $('#email').css("background", "#fb6e893b").fadeIn(3000);
        } else if (horarioAdd.length > 200) {
            toastify("Campo horario sobrepaso el limite de 200 caracteres", 2);
            $('#email').css("background", "#fff");
            $('#horario').focus();
            $('#horario').css("background", "#fb6e893b").fadeIn(3000);
        } else if (direccionAdd.length > 200) {
            toastify("Campo horario sobrepaso el limite de 200 caracteres", 2);
            $('#horario').css("background", "#fff");
            $('#direccion').focus();
            $('#direccion').css("background", "#fb6e893b").fadeIn(3000);
        } else {
            var datos = $("#formulario_registro").serialize();
            $.ajax({
                dataType: "json",
                method: "POST",
                url: "json_empresa.php",
                data: datos,
                success: function(json) {
                    if (json[0] == "Exito") {
                        toastify("¡Acción Realizada!\nDatos guardados con exito", 1);
                        CargarDatos();
                        $('#nombre').css("background", "#4AC18E3b").fadeIn(3000);
                        $('#email').css("background", "#4AC18E3b").fadeIn(3000);
                        $('#telefono').css("background", "#4AC18E3b").fadeIn(3000);
                        $('#horario').css("background", "#4AC18E3b").fadeIn(3000);
                        $('#logo').css("background", "#4AC18E3b").fadeIn(3000);
                        $('#direccion').css("background", "#4AC18E3b").fadeIn(3000);

                        esperar();
                    } else {
                        toastify("¡Acción Fallida!\nDatos no se pudieron modificar", 2);
                    }

                }
            });
        }
    });
});

function esperar() {
    setTimeout(function() {
        console.log("I am the third log after 5 seconds");
        $('#nombre').css("background", "#fff");
        $('#email').css("background", "#fff");
        $('#telefono').css("background", "#fff");
        $('#horario').css("background", "#fff");
        $('#logo').css("background", "#fff");
        $('#direccion').css("background", "#fff");
    }, 3000);
}

function CargarDatos() {
    console.log("Entro a cargardatos ");
    var datos = { "consultar_datos": "si_consultalos" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empresa.php",
        data: datos,
        success: function(json) {
            if (json[0] == "Exito") {
                console.log("DATOS CARGADOS ",json[2]);
                $('#llave_empresa').val(json[2]['idempresa']);
                $('#nombre').val(json[2]['nombre']);
                $('#email').val(json[2]['email']);
                $('#horario').val(json[2]['horario']);
                $('#telefono').val(json[2]['telefono']);
                $('#direccion').val(json[2]['direccion']);
            } else {
                toastify("¡Acción Fallida!\nRegistro no se pudo encontrar", 2);
            }

        }
    });
}

function LimpiarBasura() {
    //$('#Id-icon').val("");
    $('#nombre').val("");
    $('#apellido').val("");
    $('#correo').val("");
    $('#pass').val("");
    $('#correo').css("background", "#fff");
    $('#nombre').css("background", "#fff");
    $('#Apellido-icon').css("background", "#fff");
    $('#pass').css("background", "#fff");
    $('#correo').css("background", "#fff");
    $('#admin-icon').prop('checked', false);
}