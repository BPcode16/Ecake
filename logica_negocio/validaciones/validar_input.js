function soloLetrasSintildes(texto) {
    var regex = /^[a-zA-Z ]+$/;
    return regex.test(texto);
}

function soloLetras(texto) {
    var regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
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
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,20}$/;
    return regex.test(texto);
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

function alertaSimple(titulo, texto, icono, boton) {
    swal.fire({
        title: titulo,
        text: texto,
        icon: icono,
        confirmButtonColor: '#fb4669',
        confirmButtonText: boton
    });
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

$(document).ready(function() {
    //CheckBox mostrar contraseña
    $('#ShowPassword').click(function() {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
});
/*  fin de mostrar contraseña */

function soloDinero(texto) {
    var regex = /^(?!0\.00)[1-9]\d{0,2}(,\d{3})*(\.\d\d)?$/; 
    return regex.test(texto);
}