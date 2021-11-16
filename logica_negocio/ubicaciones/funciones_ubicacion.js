$(function () {
  var fecha = new Date();
  console.log("JQuery si esta funcionando");
  //validardatos();
  CargarDatos();

  $(document).on("click", "#btn_eliminar", function (e) {
    e.preventDefault();

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
  $("#lista1").val(0);
  recargarLista();
  revisarBoton();
  CargarDatos(0);

  $("#lista1").change(function () {
    var iddepto = document.getElementsByName("lista1")[0].value;
    recargarLista();
    revisarBoton();
    console.log("CARGANDO DATOS DE ID ",iddepto)
    CargarDatos(iddepto);
  });
});

$(document).on("click", ".btn_editar", function (e) {
  e.preventDefault();
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
        $("#costoenvio").focus();
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

  var iddepto = document.getElementsByName("lista1")[0].value;

  console.log("DEPTO A ELIMINAR ", iddepto);
  var datos = { eliminar_datos: "si_eliminalo", idmunicipio: id, iddepartamento:iddepto};
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
        CargarDatos(iddepto);
        toastify("Datos eliminados exitosamente.", 1);
      }
    })
    .fail(function () {
      toastify("Datos eliminados exitosamente.", 1);
      CargarDatos(iddepto);
    })
    .always(function () {});
}

$(document).on("click", "#btn_guardar", function (e) {
  e.preventDefault();
  iddepartamento = document.getElementsByName("lista1")[0].value;
  if ($("#costoenvio").val().length == 0) {
    toastify("Campo costo de envío vacío.", 2);
    $("#costoenvio").focus();
  } else {
    if ((id = document.getElementsByName("lista2")[0].value == 0)) {
      Swal.fire({
        title: "¿Desea actualizar los registros seleccionados?",
        text: "¡Se actualizara la información del departamento completo!",
        icon: 'warning',
        width: 400,
        toast: true,
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Proceder'
      }).then((result) => {
        if (result.isConfirmed) {
          actualizar(iddepartamento);
        } else if (result.isDenied) {
          Swal.fire("Accion cancelada por el usuario", "", "info");
        }
      });
    } else {
      actualizar(iddepartamento);
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
        toastify("Datos actualizados exitosamente.", 1);
        CargarDatos(iddepartamento);
        $("#costoenvio").val("");
      }
    })
    .fail(function () {
      console.log("NO Se actualizo registro del departamento ",iddepartamento)
    })
    .always(function () {});
}

function CargarDatos(id) {
  revisarBoton();
  var datos = { consultar_datos: "si_consultalos",id:id };
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