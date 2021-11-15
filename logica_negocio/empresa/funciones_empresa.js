$(function() {

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
        } else if (soloLetras(nombreAdd) == false) {
            toastify("Ingrese solo letras en el campo Nombre", 2);
            $('#nombre').focus();
            $('#nombre').css("background", "#fb6e893b").fadeIn(3000);
        } else if (emailAdd.length < 3 && !reg.test(CorreoAdd)) {
            toastify("Campo Email vacío", 2);
            $('#nombre').css("background", "#fff");
            $('#email').focus();
            $('#email').css("background", "#fb6e893b").fadeIn(3000);
        } else if (soloLetras(emailAdd) == false) {
            toastify("Ingrese solo letras en el campo Email", 2);
            $('#nombre').css("background", "#fff");
            $('#email').focus();
            $('#email').css("background", "#fb6e893b").fadeIn(3000);
        } else if (CorreoAdd.length < 3 && !reg.test(CorreoAdd)) {
            toastify("Ingrese un correo correcto", 2);
            $('#apellido').css("background", "#fff");
            $('#correo').focus();
            $('#correo').css("background", "#fb6e893b").fadeIn(3000);
        } else if (soloCorreo(CorreoAdd) == false) {
            toastify("Ingrese un correo correcto", 2);
            $('#apellido').css("background", "#fff");
            $('#correo').focus();
            $('#correo').css("background", "#fb6e893b").fadeIn(3000);
        } else if (ContraseñaAdd.length < 3) {
            toastify("Ingrese una contraseña correcta", 2);
            $('#correo').css("background", "#fff");
            $('#pass').focus();
            $('#pass').css("background", "#fb6e893b").fadeIn(3000);
        } else if (soloContrasena(ContraseñaAdd) == false) {
            toastify("Ingrese una contraseña de acuerdo a las politicas\n\n- Minimo 8 caracteres\n- Maximo 15 caracteres\n- Al menos una letra mayúscula\n- Al menos una letra minuscula\n- Al menos un dígito\n- No espacios en blanco\n- Al menos 1 caracter especial", 2);
            $('#correo').css("background", "#fff");
            $('#pass').focus();
            $('#pass').css("background", "#fb6e893b").fadeIn(3000);
        } else {
            //Saber si es inser o update
            if ($('#llave_empleado').val() == 0) {
                //Agregar Datos
                ValidarCorreo(CorreoAdd, $('#llave_empleado').val(), "insert");
            } else {
                ValidarCorreo(CorreoAdd, $('#llave_empleado').val(), "update");
            }

        }
    });
});

function CargarDatos() {
    //mostrar_cargando("Cargando datos","")
    var datos = { "consultar_datos": "si_consultalos" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empresa.php",
        data: datos,
        success: function(json) {
            if (json[0] == "Exito") {
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


function Limpiar() {
    //$('#Id-icon').val("");
    $('#md_registrar_empleado').modal('hide');
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
    document.getElementById('titulo').innerHTML = 'Registrar empleado';
    document.getElementById('valboton').innerHTML = 'Guardar';
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