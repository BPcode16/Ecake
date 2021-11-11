$(function(){

    console.log("JQuery si esta funcionando");

    CargarDatos();

});

function mostrar_cargando(titulo,mensaje=""){
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
	  /* Read more about handling dismissals below */
	  if (result.dismiss === Swal.DismissReason.timer) {
	    console.log('I was closed by the timer')
	  }
	})
}

function CargarDatos(){
	mostrar_cargando("Cargando datos","")
	var datos = {"consultar_datos":"si_consultalos"};
	$.ajax({
		dataType: "json",
		method: "POST",
		url: "json_categoria.php",
		data: datos
	}).done(function(json){

		console.log("Datos consultados: ", json);
		if (json[0]=="Exito") {
			Swal.close();
			$("#aqui_tabla").empty().html(json[1]);//llena la tabla
			$("#tabla_categoria").DataTable();//le da el formato
			$("#categorias_registradas").empty().html(json[2]);
		}

	}).fail(function(){

	}).always(function(){

	})
}