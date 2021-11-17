$(function () {
  var fecha = new Date();
  console.log("JQuery si esta funcionando");

  CargarDatos("si_consultalos");

  $(document).on("click", ".btn_eliminar", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Desea eliminar TODAS las presentaciones para este producto?",
      text: "¡No podra recuperar la información!",
      icon: "warning",
      width: 700,
      toast: true,
      showCancelButton: true,
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#6c757d",
      cancelButtonColor: "#dc3545",
      confirmButtonText: "Si, Eliminar.",
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        eliminar($(this).attr("data-id"));
      } else if (result.isDenied) {
        Swal.fire("Accion cancelada por el usuario", "", "info");
      }
    });
  });

  $(document).on("click", ".btn_eliminar2", function (e) {
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
        eliminar2($(this).attr("data-id"));
      } else if (result.isDenied) {
        Swal.fire("Accion cancelada por el usuario", "", "info");
      }
    });
  });

  $(document).on("click", "#registrar_usuario", function (e) {
    e.preventDefault();
    CargarDatos("si_tabla", -1);
    cancel();
    $("#md_registrar_cliente").modal("show");
  });

  $(document).on("submit", "#formulario_registro", function (e) {
    e.preventDefault();
    var btn1 = $("#boton1").val();
    var precio = $("#precio").val();
    console.log("Precio capturado es " + precio);
    //toastify("Ingrese un precio válido.", 2);

    if ($("#precio").val() == "") {
      toastify("Campo precio requerido.", 2);
      $("#precio").focus();
      $("#precio").css("background", "#fb6e893b").fadeIn(3000);
    } else if ($("#tamanio").val() == "") {
      toastify("Campo tamaño requerido.", 2);
      $("#tamanio").focus();
      $("#tamanio").css("background", "#fb6e893b").fadeIn(3000);
    } else {
      $("#tamanio").css("background", "#FFFFFF").fadeIn(3000);
      $("#precio").css("background", "#FFFFFF").fadeIn(3000);
      if (soloDinero(precio) == true) {
        if (btn1 == 1) {
          //Si el boton es 1 guarda
          if (document.getElementsByName("lista2")[0].value < 1) {
            toastify("Seleccione un producto válido.", 2);
          } else {
            var datos = $("#formulario_registro").serialize();
            console.log("Datos: ", datos);

            $.ajax({
              dataType: "json",
              method: "POST",
              url: "json_presentaciones.php",
              data: datos,
            })
              .done(function (json) {
                if (json[0] == "Exito") {
                  $("#ingreso_datos").val("si_registro");

                  CargarDatos("si_consultalos");
                  actualizar_tbl();
                  limpiar();
                  toastify("Presentación registrada correctamente.", 1);
                }
              })
              .fail(function () {})
              .always(function () {});
          }
        } else {
          //Si el boton es 2 modifica
          console.log("ENTRO A MODIFICAR BOTON ES 2");
          var datos = $("#formulario_registro").serialize();
          $("#ingreso_datos").val("si_actualizalo");
          console.log("Datos: ", datos);

          $.ajax({
            dataType: "json",
            method: "POST",
            url: "json_presentaciones.php",
            data: datos,
          })
            .done(function (json) {
              if (json[0] == "Exito") {
                $("#ingreso_datos").val("si_actualizalo");
              }
              CargarDatos("si_consultalos");
              actualizar_tbl();
              cancel();
              limpiar();
              toastify("Datos actualizados exitosamente.", 1);
            })
            .fail(function () {})
            .always(function () {});
        }
      } else {
        toastify("Ingrese un precio válido.", 2);
        $("#precio").focus();
        $("#precio").css("background", "#fb6e893b").fadeIn(3000);
      }
    }
  });
});

function estadoActivo(idpresentacion, idestado) {
  console.log("function estado recibe = " + idpresentacion + " " + idestado);
  var estadonuevo = 0;
  if (idestado == 1) {
    estadonuevo = 0;
  } else {
    estadonuevo = 1;
  }
  var datos = {
    actualizarEstado: "actualiza_estado",
    idpresentacion: idpresentacion,
    estado: estadonuevo,
  };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_presentaciones.php",
    data: datos,
  })
    .done(function (json) {
      if (json[0] == "Exito") {
        console.log("SQL PARA ESTADOS:", json[2]);

        CargarDatos("si_consultalos");
        actualizar_tbl();
        limpiar();
        toastify("Estado de presentación ha cambiado.", 1);
      }
    })
    .fail(function () {
      toastify("Algo salió mal.", 2);
    })
    .always(function () {});
}

function limpiar() {
  var tamanio = document.getElementById("tamanio");
  var precio = document.getElementById("precio");
  tamanio.value = "";
  precio.value = "";
}

$(document).on("click", "#registrar_usuario", function (e) {
  recargarLista(0);
  CargarDatos("si_tabla");
});

function cancel() {
  limpiar();
  console.log("PULSASTE CANCELAR/CERRAR");
  var btn2 = $("#boton2").val();
  var boton2 = document.getElementById("boton2");

  if (btn2 == 1) {
    $("#md_registrar_cliente").modal("hide");
  } else {
    $("#boton2").val("1");
    $("#boton1").val("1");
    boton1.innerHTML = "Guardar";
    boton2.innerHTML = "Cerrar";
    $("#ingreso_datos").val("si_registro");
  }
}

function recargarLista($id) {
  var datos = {
    idproducto: $id,
  };
  $.ajax({
    type: "POST",
    url: "datos.php",
    data: datos,
    success: function (r) {
      $("#select2lista").html(r);
    },
  });
}

function eliminarTodo() {
  var iddepto = document.getElementsByName("lista2")[0].value;

  Swal.fire({
    title: "¿Desea eliminar TODAS las presentaciones para este producto?",
    text: "¡No podra recuperar la información!",
    icon: "warning",
    width: 700,
    toast: true,
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#6c757d",
    cancelButtonColor: "#dc3545",
    confirmButtonText: "Si, Eliminar.",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      toastify("Presentaciones eliminadas correctamente.", 1);
      eliminar(iddepto);
      actualizar_tbl();
    } else if (result.isDenied) {
      Swal.fire("Accion cancelada por el usuario", "", "info");
    }
  });
}

$(document).on("click", ".btn_editar", function (e) {
  e.preventDefault();

  console.log("toco editar");
  $id = $(this).attr("data-id");
  $("#md_registrar_cliente").modal("show");
  recargarLista($id);
  CargarDatos("si_tabla", $id);
});

$(document).on("click", ".btn_editar2", function (e) {
  e.preventDefault();

  var id = $(this).attr("data-id");
  console.log("El id2 es: ", id);
  var datos = { consultar_info: "si_conid_especifico", id: id };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_presentaciones.php",
    data: datos,
  })
    .done(function (json) {
      Swal.close();
      var btn1 = document.getElementById("boton1");
      var btn2 = document.getElementById("boton2");

      console.log("EL consultar especifico", json[2]);
      if (json[0] == "Exito") {
        $("#idpresentacion").val(json[2]["idpresentacion"]);
        $("#lista2").val(json[2]["idproducto"]);
        $("#tamanio").val(json[2]["Tamanio"]);
        $("#precio").val(json[2]["Precio"]);
        btn1.innerHTML = "Guardar cambios";
        btn2.innerHTML = "Cancelar";
        $("#boton2").val(2);
        $("#boton1").val(2);
        $("#ingreso_datos").val("si_actualizalo");
        actualizar_tbl();
      }
    })
    .fail(function () {
      console.log("Retorno error:(", json);
    })
    .always(function () {});
});

function eliminar(id) {
  var datos = { eliminar_datos: "si_eliminalo", idproducto: id };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_presentaciones.php",
    data: datos,
  })
    .done(function (json) {
      console.log("datos consuldos: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        CargarDatos("si_consultalos");
        toastify("Presentaciones eliminadas correctamente.", 1);
      }
    })
    .fail(function () {})
    .always(function () {});
}

function eliminar2(id) {
  var datos = { eliminar_datos: "si_eliminalo2", idpresentacion: id };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_presentaciones.php",
    data: datos,
  })
    .done(function (json) {
      console.log("datos consuldos: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        CargarDatos("si_consultalos");
        actualizar_tbl();
        toastify("Presentación eliminada correctamente.", 1);
      }
    })
    .fail(function () {})
    .always(function () {});
}

function CargarDatos(consulta, idprod) {
  var datos = { consultar_datos: consulta, idproducto: idprod };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_presentaciones.php",
    data: datos,
  })
    .done(function (json) {
      if (json[0] == "Exito") {
        Swal.close();

        if (consulta == "si_tabla") {
          $("#aqui_tabla2").empty().html(json[1]); //llena la tabla del modal
          $("#tabla_presentaciones").DataTable(); //le da el formato
          if (json[1] == "<h6>No tiene presentaciones.</h6>" || json[1] == "<h6>Seleccione un producto.</h6>") {
            document.getElementById("btnElim").disabled = true;
          } else {
            document.getElementById("btnElim").disabled = false;
          }
        } else {
          $("#aqui_tabla").empty().html(json[1]); //llena la tabla

          $("#tabla_cliente").DataTable(); //le da el formato
        }
        actualizarInfo();
      }
    })
    .fail(function ($value) {
      console.log("NO SE PUEDE CARGAR PORQUE ", $value);
    })
    .always(function () {});
}

function actualizarInfo() {
  var datos = { consultar_datos: "si_actualiza" };
  $.ajax({
    dataType: "json",
    method: "POST",
    url: "json_presentaciones.php",
    data: datos,
  })
    .done(function (json) {
      if (json[0] == "Exito") {
        $("#usuarios_registrados").empty().html(json[2]);
      }
    })
    .fail(function ($value) {})
    .always(function () {});
}

function actualizar_tbl() {
  var iddepto = document.getElementsByName("lista2")[0].value;
  console.log("cargando tabla para " + iddepto);
  CargarDatos("si_tabla", iddepto);
}
