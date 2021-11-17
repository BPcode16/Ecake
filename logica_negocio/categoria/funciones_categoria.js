$(function () {
  console.log("JQuery si esta funcionando");

  $("#formulario_registro").parsley();

  CargarDatos();

  $(document).on("click", ".btn_eliminar", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Desea Eliminar?",
      text: "¡No podra recuperar la información!",
      icon: "warning",
      width: 400,
      toast: true,
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#6c757d",
      cancelButtonColor: "#dc3545",
      confirmButtonText: "Si, Eliminar!",
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        eliminar($(this).attr("data-id"));
      } else if (result.isDenied) {
        toastify(
          "¡Acción no permitida!\nEs posible que este empleado este asociado a otro registro",
          2
        );
      }
    });
  });

  $(document).on("click", "#registrar_categoria", function (e) {
    e.preventDefault();
    Limpiar();
    $("#md_registrar_categoria").modal("show");
  });
});

$(document).on("submit", "#formulario_registro", function (e) {
  e.preventDefault();
  var nombre = $("#nombre").val();
  var descrip = $("#descrip").val();

  $("#categoria").css("background", "#fff");
  $("#nombre").css("background", "#fff");

  if (nombre.length < 3) {
    toastify("Campo Nombre vacío", 2);
    $("#categoria").css("background", "#fff");
    $("#nombre").focus();
    $("#nombre").css("background", "#fb6e893b").fadeIn(3000);
  } else if (soloLetras(nombre) == false) {
    toastify("Ingrese solo letras en el campo Nombre", 2);
    $("#categoria").css("background", "#fff");
    $("#nombre").focus();
    $("#nombre").css("background", "#fb6e893b").fadeIn(3000);
  } else if (descrip.length > 200) {
    toastify("Campo descripción sobrepaso el limite de 200 caracteres", 2);
    $("#sabor").css("background", "#fff");
    $("#descrip").focus();
    $("#descrip").css("background", "#fb6e893b").fadeIn(3000);
  } else {
    var datos = $("#formulario_registro").serialize();
    $.ajax({
      dataType: "json",
      method: "POST",
      url: "json_categoria.php",
      data: datos,
    })
      .done(function (json) {
        console.log("Datos consultados antes de if: ", json);
        if (json[0] == "Exito") {
          Limpiar();
          console.log("Datos consultados dd: ", json);
          toastify("¡Acción Realizada!\nRegistro guardado con exito", 1);
          $("#md_registrar_categoria").modal("hide");
          $("#ingreso_datos").val("si_registro");
          CargarDatos();
        }
      })
      .fail(function () {})
      .always(function () {});
  }
});

function estadoActivo(idcategoria, idestado) {
  console.log("function estado recibe = " + idcategoria + " " + idestado);
  var estadonuevo = 0;
  if (idestado == 1) {
    estadonuevo = 0;
  } else {
    estadonuevo = 1;
  }
  var datos = {
    actualizarEstado: "actualiza_estado",
    idcategoria: idcategoria,
    estado: estadonuevo,
  };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_categoria.php",
    data: datos,
  })
    .done(function (json) {
      if (json[0] == "Exito") {
        console.log("SQL PARA ESTADOS:", json[2]);
        CargarDatos();
        toastify("Estado de categoría ha cambiado.", 1);
      }
    })
    .fail(function () {
      toastify("Algo salió mal.", 2);
    })
    .always(function () {});
}

function Limpiar() {
  $("#nombre").val("");
  $("#descrip").val("");
  $("#nombre").css("background", "#fff");
  $("#descrip").css("background", "#fff");
}

//AQUI EL METODO EDITAR

$(document).on("click", ".btn_editar", function (e) {
  e.preventDefault();

  var id = $(this).attr("data-id");
  console.log("El id es: ", id);
  var datos = { consultar_info: "si_conid_especifico", id: id }; //este id es el que se lleva a json_catalogo al if de consultar_info
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_categoria.php",
    data: datos,
  })
    .done(function (json) {
      console.log("EL consultar especifico", json);
      if (json[0] == "Exito") {
        $("#llave_categoria").val(id);
        $("#ingreso_datos").val("si_actualizalo");
        $("#nombre").val(json[2]["nombre"]);
        $("#descrip").val(json[2]["descripcion"]);
        $("#md_registrar_categoria").modal("show");
      }
    })
    .fail(function () {})
    .always(function () {});
});

//AQUI EL METODO DE ELIMINAR

function eliminar(id) {
  //mostrar_cargando("Procesando solicitud", "Espere mientras se eliminan los datos")

  var datos = { eliminar_datos: "si_eliminalo", idcategoria: id };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_categoria.php",
    data: datos,
  })
    .done(function (json) {
      console.log("datos consuldos: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        CargarDatos();
      } else {
        toastify(
          "¡Acción no permitida!\nEs posible que esta categoria este asociada a otro registro",
          2
        );
      }
    })
    .fail(function () {})
    .always(function () {});
}

//AQUI EL METODO DE MENSAJES DE CARGA

function mostrar_cargando(titulo, mensaje = "") {
  Swal.fire({
    title: titulo,
    html: mensaje,
    timer: 2000,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    },
    willClose: () => {},
  }).then((result) => {
    /* Read more about handling dismissals below */
    if (result.dismiss === Swal.DismissReason.timer) {
      console.log("I was closed by the timer");
    }
  });
}

//METODO QUE CARGA LA TABLA

function CargarDatos() {
  //mostrar_cargando("Cargando datos", "")
  var datos = { consultar_datos: "si_consultalos" };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_categoria.php",
    data: datos,
  })
    .done(function (json) {
      console.log("Datos consultados: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        $("#aqui_tabla").empty().html(json[1]); //llena la tabla
        $("#tabla_categoria").DataTable(); //le da el formato
        $("#categorias_registradas").empty().html(json[2]);
      }
    })
    .fail(function () {})
    .always(function () {});
}
