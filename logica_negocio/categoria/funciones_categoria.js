$(function(){

    console.log("JQuery si esta funcionando");

	$('#formulario_registro').parsley();

    CargarDatos();

	$(document).on("click", ".btn_eliminar", function(e){
		e.preventDefault();

		Swal.fire({
			title: '¿Desea eliminar el registro?',
			showDenyButton: true,
			showCancelButton: false,
			confirmButtonText: 'Si ',
			denyButtonText: `NO`,
		  }).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
			  eliminar($(this).attr('data-id'));
			} else if (result.isDenied) {
			  Swal.fire('Accion cancelada por el usuario', '', 'info')
			}
		  })
	});

	$(document).on("click", "#registrar_categoria", function(e){
		e.preventDefault();
		$("#md_registrar_categoria").modal("show");
	});

});

$(document).on("submit", "#formulario_registro", function(e){
	e.preventDefault();
	mostrar_cargando("Procesando solicitud","Espere mientras se almacenan los datos")
	var datos = $("#formulario_registro").serialize();
	console.log("Datos: ", datos);

	$.ajax({
				dataType: "json",
				method: "POST",
				url: "json_categoria.php",
				data: datos
			}).done(function(json){

				console.log("Datos consultados antes de if: ", json);
				if (json[0]=="Exito") {
					Swal.close();
					console.log("Datos consultados dd: ", json);
					$("#md_registrar_categoria").modal("hide");

					$('#ingreso_datos').val("si_registro");

					CargarDatos();
				}

}).fail(function(){

}).always(function(){

})


});

//AQUI EL METODO EDITAR

$(document).on("click",".btn_editar",function(e){
	e.preventDefault(); 

	var id = $(this).attr("data-id");
	console.log("El id es: ",id);
	var datos = {"consultar_info":"si_conid_especifico","id":id}//este id es el que se lleva a json_catalogo al if de consultar_info
	$.ajax({
		dataType: "json",
		method: "POST",
		url:'json_categoria.php',
		data : datos,
	}).done(function(json) {
		Swal.close();
		console.log("EL consultar especifico",json);
		if (json[0]=="Exito") {

			$('#llave_categoria').val(id);
			$('#ingreso_datos').val("si_actualizalo");
			$('#nombre').val(json[2]['nombre']);
			$('#descrip').val(json[2]['descripcion']);
			
			$('#md_registrar_categoria').modal('show');
		}
		 
	}).fail(function(){

	}).always(function(){

	});


});

//AQUI EL METODO DE ELIMINAR

function eliminar(id){
	mostrar_cargando("Procesando solicitud","Espere mientras se eliminan los datos")
	 

	var datos = {"eliminar_datos":"si_eliminalo","idcategoria":id};
	$.ajax({
		dataType:"json",
		method:"POST",
		url:"json_categoria.php",
		data:datos
	}).done(function(json){
		console.log("datos consuldos: ",json);
		if (json[0]=="Exito") {
			Swal.close();
			CargarDatos();
		}
	}).fail(function(){

	}).always(function(){

	})
}

//AQUI EL METODO DE MENSAJES DE CARGA

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



//METODO QUE CARGA LA TABLA

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