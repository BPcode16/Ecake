$(function() {

    console.log("JQuery si esta funcionando");

    CargarDatos();
    conteo();

    $(document).on("click", "#registrar_empleado", function(e) {
        e.preventDefault();
        $('#llave_empleado').val(0);
        $('#ingreso_datos').val("si_registro");
        document.getElementById('titulo').innerHTML = 'Registrar empleado';
        document.getElementById('valboton').innerHTML = 'Guardar';
        LimpiarBasura();
        $("#md_registrar_empleado").modal("show");
    })


    $(document).on("submit", "#formulario_registro", function(e) {
        e.preventDefault();
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+.)+[A-Z]{2,4}$/i;

        var NombreAdd = $('#nombre').val();
        var ApellidoAdd = $('#apellido').val();
        var CorreoAdd = $('#correo').val();
        var ContraseñaAdd = $('#pass').val();

        if (NombreAdd.length < 3) {
            toastify("Campo Nombre vacío", 2);
            $('#nombre').focus();
            $('#nombre').css("background", "#fb6e893b").fadeIn(3000);
        } else if (soloLetras(NombreAdd) == false) {
            toastify("Ingrese solo letras en el campo Nombre", 2);
            $('#nombre').focus();
            $('#nombre').css("background", "#fb6e893b").fadeIn(3000);
        } else if (ApellidoAdd.length < 3) {
            toastify("Campo Apellido vacío", 2);
            $('#nombre').css("background", "#fff");
            $('#apellido').focus();
            $('#apellido').css("background", "#fb6e893b").fadeIn(3000);
        } else if (soloLetras(ApellidoAdd) == false) {
            toastify("Ingrese solo letras en el campo Apellido", 2);
            $('#nombre').css("background", "#fff");
            $('#apellido').focus();
            $('#apellido').css("background", "#fb6e893b").fadeIn(3000);
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
                //mostrar_cargando("Procesando solicitud", "Espere mientras se almacenan los datos")
                var datos = $("#formulario_registro").serialize();
                console.log("Datos: ", datos);
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "json_empleado.php",
                    data: datos,
                    success: function(json) {
                        console.log("Datos consultados antes de if: ", json);
                        if (json[0] == "Exito") {
                            Limpiar();
                            toastify("¡Acción Realizada!\nRegistro guardado con exito", 1);
                            conteo();
                            CargarDatos();
                        } else {
                            toastify("¡Acción Fallida!\nRegistro no se pudo guardar", 2);
                        }

                    }
                });
            } else {
                //actualizar
                var datos = $("#formulario_registro").serialize();
                console.log("Datos: ", datos);
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: "json_empleado.php",
                    data: datos,
                    success: function(json) {
                        console.log("Datos consultados antes de if: ", json);
                        if (json[0] == "Exito") {
                            Limpiar();
                            toastify("¡Acción Realizada!\nRegistro modificado con exito", 1);
                            CargarDatos();
                        } else {
                            toastify("¡Acción Fallida!\nRegistro no se pudo modificar", 2);
                        }

                    }
                });
            }

        }
    });
});


function MostrarEditar(idActualizar) {
    $('#llave_empleado').val(idActualizar);
    var datos = { "consultar_info": "si_conid_especifico", "id": idActualizar }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empleado.php",
        data: datos,
        success: function(json) {

            if (json[0] == "Exito") {
                $('#llave_empleado').val(idActualizar);
                $('#nombre').val(json[2]['nombre']);
                $('#apellido').val(json[2]['apellido']);
                $('#correo').val(json[2]['correo']);
                $('#pass').val(atob(json[2]['pass']));
                if (json[2]['administrador'] == 1) {
                    console.log("Estado modal: ", json[2]['administrador']);
                    $("#flexRadioDefault1").prop('checked', true);
                } else {
                    $("#flexRadioDefault2").prop('checked', true);
                }
            } else {
                toastify("¡Acción Fallida!\nRegistro no se pudo encontrar", 2);
            }

        }
    });
    $('#ingreso_datos').val("si_actualizalo");
    document.getElementById('valboton').innerHTML = 'Modificar';
    document.getElementById('titulo').innerHTML = 'Modificar empleado';
    $('#md_registrar_empleado').modal('show');
}



function CargarDatos() {
    //mostrar_cargando("Cargando datos","")
    var datos = { "consultar_datos": "si_consultalos" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empleado.php",
        data: datos,
        success: function(json) {

            console.log("Datos consultados: ", json);
            if (json[0] == "Exito") {
                //Swal.close();
                $("#aqui_tabla").empty().html(json[1]); //llena la tabla
                $("#tabla_empleado").DataTable(); //le da el formato
                $("#empleado_registradas").empty().html(json[2]);
            }

        }
    });
}

function conteo() {
    //mostrar_cargando("Cargando datos","")
    var datos = { "empleados_registra": "conteo" };
    $.ajax({
        dataType: "json",
        method: "POST",
        url: "json_empleado.php",
        data: datos,
        success: function(json) {


            if (json[0] == "Exito") {
                //Swal.close();
                console.log("cantidad: ", json);
                $("#empleados_registradas").empty().html(json[2]['conteo']); //llena la tabla
            }

        }
    });
}

function estadoAdmin(idestado) {
    console.log("id: " + idestado);
    if (idestado != 0) {
        var nombre = "";
        var apellido = "";
        var datos = { "consultar_info": "si_conid_especifico", "id": idestado }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: 'json_empleado.php',
            data: datos,
            success: function(json) {
                console.log("EL consultar especifico", json);
                if (json[0] == "Exito") {
                    nombre = json[2]['nombre'];
                    apellido = json[2]['apellido'];
                } else {
                    toastify("¡Acción Fallida!\nNo se pudo Obtener datos", 2);
                }
            }
        });



        var estadocheck = 0;
        // Comprobar cuando cambia un checkbox
        $('input[type=checkbox]').on('change', function() {
            if ($(this).is(':checked')) {
                estadocheck = 1;
                console.log("Checkbox " + $(this).prop("id") + " (" + $(this).val() + ") => Seleccionado");
            } else {
                estadocheck = 0;
                console.log("Checkbox " + $(this).prop("id") + " (" + $(this).val() + ") => Deseleccionado");
            }

            if (estadocheck === 1) {
                var datos = { "actualizar_estados": "paso_admin", "administrador": 1, "id": idestado }
                console.log("Entro a 1");
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: 'json_empleado.php',
                    data: datos,
                    success: function(json) {
                        console.log("EL consultar especifico", json);
                        if (json[0] == "Exito") {
                            toastify(nombre + " " + apellido + " ahora es Administrador", 1);
                            CargarDatos();
                        } else {
                            toastify("¡Acción Fallida!\nNo se pudo Actualizar", 2);
                        }
                    }
                });
            } else {
                var datos = { "actualizar_estados": "paso_admin", "administrador": 0, "id": idestado }
                console.log("Entro a 0");
                $.ajax({
                    dataType: "json",
                    method: "POST",
                    url: 'json_empleado.php',
                    data: datos,
                    success: function(json) {
                        console.log("EL consultar especifico", json);
                        if (json[0] == "Exito") {
                            toastify(nombre + " " + apellido + " ya NO es Administrador", 0);
                            CargarDatos();
                        } else {
                            toastify("¡Acción Fallida!\nNo se pudo Actualizar", 2);
                        }
                    }
                });
            }
        });
    }
}

function estadoActivo(idestado) {
    //console.log("id: " + idestado);
    if (idestado != 0) {
        var nombreA = "";
        var apellidoA = "";
        var estado = 0;
        var datos = { "consultar_info": "si_conid_especifico", "id": idestado }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: 'json_empleado.php',
            data: datos,
            success: function(json) {
                console.log("EL consultar especifico", json);
                if (json[0] == "Exito") {
                    nombreA = json[2]['nombre'];
                    apellidoA = json[2]['apellido'];
                    estado = json[2]['estado'];
                } else {
                    toastify("¡Acción Fallida!\nNo se pudo Obtener datos", 2);
                }
            }
        });

        console.log("id actual: " + idestado);
        var datos = { "actualizar_estados": "paso_activo", "id": idestado }
        $.ajax({
            dataType: "json",
            method: "POST",
            url: 'json_empleado.php',
            data: datos,
            success: function(json) {
                console.log("EL consultar Activo", json);
                if (json[0] == "Exito") {
                    if (estado == 1) {

                        toastify("Se cambio el estado de " + nombreA + " " + apellidoA + " a Inactivo", 2);
                    } else {
                        toastify("Se cambio el estado de " + nombreA + " " + apellidoA + " a Activo", 1);
                    }
                    idestado = 0;
                    CargarDatos();
                } else {
                    toastify("¡Acción Fallida!\nNo se pudo Actualizar", 2);
                }
            }
        });
    }
}

function alertaSimple(titulo, texto, icono, boton) {
    swal.fire({
        title: titulo,
        text: texto,
        icon: icono,
        confirmButtonColor: '#fb4669',
        confirmButtonText: boton
    });
}


function confirEliminarEmpleado(idActualizar) {
    Swal.fire({
        title: '¿Desea Eliminar?',
        text: "¡No podra recuperar la información!",
        icon: 'warning',
        width: 400,
        toast: true,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            /* Swal.fire({
                 title: '¡Eliminado!',
                 text: 'Se elimino el registro con exito.',
                 icon: 'success',
                 confirmButtonColor: '#fb4669',
                 confirmButtonText: 'Hecho'
             })*/
            Eliminar(idActualizar);
        }
    })
}

function Eliminar(idEliminar) {
    console.log("id actual: " + idEliminar);
    var datos = { "eliminar_datos": "si_eliminalo", "id": idEliminar }
    $.ajax({
        dataType: "json",
        method: "POST",
        url: 'json_empleado.php',
        data: datos,
        success: function(json) {
            if (json[0] == "Exito") {
                conteo();
                toastify("¡Acción Realiza!\nRegistro eliminado con exito", 1);
                CargarDatos();
            } else {
                toastify("¡Acción Fallida!\nNo se pudo eliminar", 2);
            }
        }
    });
}



function MensajeEsquina(icono, titulo, texto) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: icono,
        title: titulo,
        html: texto
    })

}

function toastify(titulo, colornum) {
    let color = ["#67A8E4", "#4AC18E", "#ec5853"]; //azul , verde, rojo 
    Toastify({
        text: titulo,
        duration: 3200,
        destination: "#",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: color[colornum],
        },
        onClick: function() {} // Callback after click
    }).showToast();
}

/* mostrar contraseña */

function mostrarPassword() {
    var cambio = document.getElementById("pass");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

$(document).ready(function() {
    //CheckBox mostrar contraseña
    $('#ShowPassword').click(function() {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
});

function mostrarPasswordEdit() {
    var cambio = document.getElementById("mod-Contraseña-icon");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}


function mostrar_cargando(titulo, mensaje = "") {
    Swal.fire({
        title: titulo,
        html: mensaje,
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
        },
        willClose: () => {

        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
}

$(document).ready(function() {
    //CheckBox mostrar contraseña
    $('#ShowPassword').click(function() {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
});
/*  fin de mostrar contraseña */

function soloLetras(texto) {
    var regex = /^[a-zA-Z ]+$/;
    return regex.test(texto);
}

function soloNumeros(texto) {
    var regex = /^([0-9])*$/;
    return regex.test(texto);
}

function soloCorreo(texto) {
    var regex = /^(?:[^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*|"[^\n"]+")@(?:[^<>()[\].,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,63}$/i;
    return regex.test(texto);
}

function soloContrasena(texto) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
    return regex.test(texto);
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