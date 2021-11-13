$(function () {
  var fecha = new Date();
  console.log("JQuery si esta funcionando");
  //validardatos();

  $("#formulario_registro").parsley();

  $("#fecha").datepicker({
    format: "dd/mm/yyyy",
    language: "es",
    autoclose: true,
    endDate: fecha,
  });

  CargarDatos();

  $(document).on("click", "#btn_eliminar", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Desea eliminar el registro?",
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Si ",
      denyButtonText: `NO`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        eliminar($(this).attr("data-id"));
      } else if (result.isDenied) {
        Swal.fire("Accion cancelada por el usuario", "", "info");
      }
    });
  });

  $(document).on("click", ".btn_eliminar", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Desea eliminar el registro?",
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Si ",
      denyButtonText: `NO`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        eliminar($(this).attr("data-id"));
      } else if (result.isDenied) {
        Swal.fire("Accion cancelada por el usuario", "", "info");
      }
    });
  });
});

$(document).ready(function () {
  $("#lista1").val(1);
  recargarLista();
  revisarBoton();

  $("#lista1").change(function () {
    recargarLista();
    revisarBoton();
  });
});

$(document).on("click", ".btn_editar", function (e) {
  e.preventDefault();

  mostrar_cargando("Espere", "Obteniendo datos");

  var id = $(this).attr("data-id");
  console.log("El id es: ", id);
  var datos = { consultar_info: "si_conid_especifico", id: id };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_ubicacion.php",
    data: datos,
  })
    .done(function (json) {
      Swal.close();
      console.log("EL consultar especifico", json);
      if (json[0] == "Exito") {
        $("#lista1").val(json[2]["iddepartamento"]);
        recargarLista(id);
        $("#lista2").val(id);
        $("#costoenvio").val(json[2]["costoenvio"]);
      }
    })
    .fail(function () {})
    .always(function () {});
});

function recargarLista($id) {
  if ($id == null) $id = 0;

  var datos = {
    departamento: $("#lista1").val(),
    idmunicipio: $id,
  };

  $.ajax({
    type: "POST",
    url: "datos.php",
    data: datos,
    success: function (r) {
      $("#select2lista").html(r)
    },
  });
}

function revisarBoton() {
  var datos = {
    consultar_boton: "si_consultalo",
    departamento: $("#lista1").val()
  };

  $.ajax({
    type: "POST",
    url: "json_ubicacion.php",
    data: datos,
    success: function (r) {
      $("#select2boton").html(r)
    },
  });
}

function eliminar(id) {

  $iddepto = document.getElementsByName("lista1")[0].value;

  console.log("DEPTO A ELIMINAR ");
  mostrar_cargando(
    "Procesando solicitud",
    "Espere mientras se eliminan los datos"
  );

  var datos = { eliminar_datos: "si_eliminalo", idmunicipio: id, iddepartamento:$iddepto};
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_ubicacion.php",
    data: datos,
  })
    .done(function (json) {
      console.log("Respuesta: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        CargarDatos();
      }
    })
    .fail(function () {
      CargarDatos();
    })
    .always(function () {});
}

$(document).on("click", "#btn_guardar", function (e) {
  e.preventDefault();

  if ($("#costoenvio").val().length == 0) {
    //ALERTA AQUI DE VACIO
    alert("Campos vacios");
  } else {
    if ((id = document.getElementsByName("lista2")[0].value == 0)) {
      Swal.fire({
        title: "¿Desea actualizar los registros seleccionados?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "SI ",
        denyButtonText: `NO`,
      }).then((result) => {
        if (result.isConfirmed) {
          actualizar();
        } else if (result.isDenied) {
          Swal.fire("Accion cancelada por el usuario", "", "info");
        }
      });
    } else {
      actualizar();
    }
  }
});

function actualizar() {
  id = document.getElementsByName("lista2")[0].value;
  iddepartamento = document.getElementsByName("lista1")[0].value;
  let costo = document.getElementsByName("costoenvio")[0].value;

  var datos = {
    ingreso_datos: "si_actualizalo",
    idmunicipio: id,
    costoenvio: parseFloat(costo).toFixed(2),
    iddepartamento: iddepartamento,
  };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_ubicacion.php",
    data: datos,
  })
    .done(function (json) {
      if (json[0] == "Exito") {
        CargarDatos();
        $("#costoenvio").val("");
      }
    })
    .fail(function () {})
    .always(function () {});
}

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

function CargarDatos() {
  mostrar_cargando("Cargando datos", "");
  revisarBoton();
  var datos = { consultar_datos: "si_consultalos" };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_ubicacion.php",
    data: datos,
  })
    .done(function (json) {
      console.log("Datos consultados: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        $("#aqui_tabla").empty().html(json[1]); //llena la tabla
        $("#tabla_cliente").DataTable({}); //le da el formato
        $("#ubicacion_registrados").empty().html(json[2]);
      }
    })
    .fail(function () {})
    .always(function () {});
}