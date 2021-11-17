var idImgGlobal = 1;

$(function() {

    $.mask.definitions['~'] = '[2,6,7]';
    $('#telefono').mask("~999-9999");

    console.log("JQuery si esta funcionando");
    CargarDatos();
    CargarImagen();
    CargarImagenLogo();

});

//edito Imagen
$('#buttonEdit').click(function() {
    var fileImage = $('#fileImage').val();
    var nombre = $('#nombre').val();
    var email = $('#email').val();
    var telefono = $('#telefono').val();
    var horario = $('#horario').val();
    var direccion = $('#direccion').val();

    $('#nombre').css("background", "#fff");
    $('#email').css("background", "#fff");
    $('#telefono').css("background", "#fff");
    $('#horario').css("background", "#fff");
    $('#direccion').css("background", "#fff");

    if (nombre.length < 3) {
        toastify("Campo Nombre vacío", 2);
        $('#nombre').focus();
        $('#nombre').css("background", "#fb6e893b").fadeIn(3000);
    } else if (email.length < 3 && !reg.test(email)) {
        toastify("Campo email vacío", 2);
        $('#nombre').css("background", "#fff");
        $('#email').focus();
        $('#email').css("background", "#fb6e893b").fadeIn(3000);
    } else if (soloCorreo(email) == false) {
        toastify("Ingrese un email correcto", 2);
        $('#nombre').css("background", "#fff");
        $('#email').focus();
        $('#email').css("background", "#fb6e893b").fadeIn(3000);
    } else if (horario.length > 200) {
        toastify("Campo horario sobrepaso el limite de 200 caracteres", 2);
        $('#email').css("background", "#fff");
        $('#horario').focus();
        $('#horario').css("background", "#fb6e893b").fadeIn(3000);
    } else if (direccion.length > 200) {
        toastify("Campo horario sobrepaso el limite de 200 caracteres", 2);
        $('#horario').css("background", "#fff");
        $('#direccion').focus();
        $('#direccion').css("background", "#fb6e893b").fadeIn(3000);
    } else {
        if (fileImage != '') { // si actualizo la imagen
            var form_data = new FormData();
            var opciones = "editoImg";
            form_data.append('opciones', opciones);
            form_data.append('nombre', nombre);
            form_data.append('email', email);
            form_data.append('telefono', telefono);
            form_data.append('horario', horario);
            form_data.append('direccion', direccion);
            form_data.append('idImgGlobal', idImgGlobal);
            form_data.append("fileImage", document.getElementById('fileImage').files[0]);
            console.log("imagen: ", document.getElementById('fileImage').files[0]);

            $.ajax({
                url: "json_empresa.php",
                method: "POST",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log("entreo a imganes con");
                }
            });
        } else { //edito Sin imagen.
            var nombre = $('#nombre').val();
            var email = $('#email').val();
            var telefono = $('#telefono').val();
            var horario = $('#horario').val();
            var direccion = $('#direccion').val();
            var opciones = "editoSinImg";
            $.ajax({
                url: "json_empresa.php",
                method: "POST",
                data: {
                    idImgGlobal: idImgGlobal,
                    nombre: nombre,
                    email: email,
                    telefono: telefono,
                    horario: horario,
                    direccion: direccion,
                    opciones: opciones
                },
                success: function(data) {
                    //$('#data').html(data);
                }
            });
        }
        toastify("¡Acción Realizada!\nDatos guardados con exito", 1);
        CargarDatos();
        CargarImagen();
        CargarImagenLogo();
        $('#nombre').css("background", "#4AC18E3b").fadeIn(3000);
        $('#email').css("background", "#4AC18E3b").fadeIn(3000);
        $('#telefono').css("background", "#4AC18E3b").fadeIn(3000);
        $('#horario').css("background", "#4AC18E3b").fadeIn(3000);
        $('#logo').css("background", "#4AC18E3b").fadeIn(3000);
        $('#direccion').css("background", "#4AC18E3b").fadeIn(3000);
        esperar();
    }
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
    var datos = { "mostrar": "si_consultalos" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empresa.php",
        data: datos,
        success: function(json) {
            if (json[0] == "Exito") {
                console.log("DATOS CARGADOS ", json[2]);
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

function CargarImagen() {
    console.log("Entro a cargarimagen ");
    var datos = { "consultar_datos": "si_imagen" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empresa.php",
        data: datos,
        success: function(json) {
            if (json[0] == "Exito") {
                $('#data').html(json[1]);
            } else {
                toastify("¡Acción Fallida!\nRegistro no se pudo encontrar", 2);
            }

        }
    });
}

function CargarImagenLogo() {
    console.log("Entro a cargarimagen ");
    var datos = { "consultar_datos": "si_imagenLogo" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empresa.php",
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