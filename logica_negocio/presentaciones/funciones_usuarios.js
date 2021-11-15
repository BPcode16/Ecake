$(function () {
  var fecha = new Date();
  console.log("JQuery si esta funcionando");
  validardatos();
  $("#formulario_registro").parsley();

  CargarDatos("si_consultalos");

  $(document).on("click", ".btn_eliminar", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Desea eliminar las presentaciones para este producto?",
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

  $(document).on("click", ".btn_eliminar2", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Desea eliminar esta presentación?",
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonText: "Si ",
      denyButtonText: `NO`,
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
    console.log("BOTON TEXTO 1 ES " + btn1);

    if (btn1 == 1) {
      //Si el boton es 1 guarda
      if (document.getElementsByName("lista2")[0].value < 1) {
        alert("Seleccione un producto valido");
      } else {
        var datos = $("#formulario_registro").serialize();
        console.log("Datos: ", datos);

        $.ajax({
          dataType: "json",
          method: "POST",
          url: "json_usuarios.php",
          data: datos,
        })
          .done(function (json) {
            if (json[0] == "Exito") {
              console.log("Datos consultados dd: ", json);
              $("#ingreso_datos").val("si_registro");

              CargarDatos("si_consultalos");
              actualizar_tbl();
              limpiar();
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
        url: "json_usuarios.php",
        data: datos,
      })
        .done(function (json) {
          console.log("Datos consultados antes de if: ", json);
          if (json[0] == "Exito") {
            console.log("Datos consultados dd: ", json);
            $("#ingreso_datos").val("si_actualizalo");

            CargarDatos("si_consultalos");
            actualizar_tbl();
            cancel();
            limpiar();
          }
        })
        .fail(function () {})
        .always(function () {});
    }
  });
});

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
    url: "json_usuarios.php",
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
    url: "json_usuarios.php",
    data: datos,
  })
    .done(function (json) {
      console.log("datos consuldos: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        CargarDatos("si_consultalos");
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
    url: "json_usuarios.php",
    data: datos,
  })
    .done(function (json) {
      console.log("datos consuldos: ", json);
      if (json[0] == "Exito") {
        Swal.close();
        CargarDatos("si_consultalos");
        actualizar_tbl();
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
    url: "json_usuarios.php",
    data: datos,
  })
    .done(function (json) {
      console.log("Datos consultados: ", json);
      if (json[0] == "Exito") {
        Swal.close();

        if (consulta == "si_tabla") {
          $("#aqui_tabla2").empty().html(json[1]); //llena la tabla del modal
          $("#tabla_presentaciones").DataTable(); //le da el formato
        } else {
          $("#aqui_tabla").empty().html(json[1]); //llena la tabla

          $("#tabla_cliente").DataTable(); //le da el formato
        }
        $("#usuarios_registrados").empty().html(json[2]);
      }
    })
    .fail(function ($value) {
      console.log("NO SE PUEDE CARGAR PORQUE ", $value);
    })
    .always(function () {});
}

function validardatos() {
  $.mask.definitions["~"] = "[2,6,7]";
  $("#telefono").mask("~999-9999");
}

function actualizar_tbl() {
  var iddepto = document.getElementsByName("lista2")[0].value;
  console.log("cargando tabla para " + iddepto);
  CargarDatos("si_tabla", iddepto);
}
