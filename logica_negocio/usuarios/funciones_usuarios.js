$(function(){

	var fecha = new Date();
	console.log("JQuery si esta funcionando");
	validardatos();
	$('#formulario_registro').parsley();

	
	$('#fecha').datepicker({
	    format: "dd/mm/yyyy",
	    language: "es",
	    autoclose: true,
	    endDate:fecha

	});
	
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

	$(document).on("click", "#registrar_usuario", function(e){
		e.preventDefault();
		$("#md_registrar_cliente").modal("show");
	})

	

	$(document).on("submit", "#formulario_registro", function(e){
		e.preventDefault();
		mostrar_cargando("Procesando solicitud","Espere mientras se almacenan los datos")
		var datos = $("#formulario_registro").serialize();
		console.log("Datos: ", datos);

		$.ajax({
					dataType: "json",
					method: "POST",
					url: "json_usuarios.php",
					data: datos
				}).done(function(json){

					console.log("Datos consultados antes de if: ", json);
					if (json[0]=="Exito") {
						Swal.close();
						console.log("Datos consultados dd: ", json);
						$("#md_registrar_cliente").modal("hide");

						$('#ingreso_datos').val("si_registro");

						console.log("antes del reset");

						CargarDatos();
					}

	}).fail(function(){

	}).always(function(){

	})


	});
});

$(document).on("click",".btn_editar",function(e){
	e.preventDefault(); 

	mostrar_cargando("Espere","Obteniendo datos");

	var id = $(this).attr("data-id");
	console.log("El id es: ",id);
	var datos = {"consultar_info":"si_conid_especifico","id":id}
	$.ajax({
		dataType: "json",
		method: "POST",
		url:'json_usuarios.php',
		data : datos,
	}).done(function(json) {
		Swal.close();
		console.log("EL consultar especifico",json);
		if (json[0]=="Exito") {

			//De esta manera realizamos formateo de la fecha que viene de la base y lo hacemos utilizando java no php.
			var fecHA_string = json[2]['fechanacimiento'];
			var porciones = fecHA_string.split('-');
			var fecha = porciones[2]+"/"+porciones[1]+"/"+porciones[0]

			$('#llave_cliente').val(id);
			$('#ingreso_datos').val("si_actualizalo");
			$('#nombre').val(json[2]['nombre']);
			$('#apellido').val(json[2]['apellido']);
			$('#telefono').val(json[2]['telefono']);
			$('#email').val(json[2]['correo']);
			$('#fecha').val(fecha);


			$(".eliminar_obligaroio").empty();
			
			$('#md_registrar_cliente').modal('show');
		}
		 
	}).fail(function(){

	}).always(function(){

	});


});

function eliminar(id){
	mostrar_cargando("Procesando solicitud","Espere mientras se eliminan los datos")
	 

	var datos = {"eliminar_datos":"si_eliminalo","idcliente":id};
	$.ajax({
		dataType:"json",
		method:"POST",
		url:"json_usuarios.php",
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
		url: "json_usuarios.php",
		data: datos
	}).done(function(json){

		console.log("Datos consultados: ", json);
		if (json[0]=="Exito") {
			Swal.close();
			$("#aqui_tabla").empty().html(json[1]);//llena la tabla
			$("#tabla_cliente").DataTable();//le da el formato
			$("#usuarios_registrados").empty().html(json[2]);
		}

	}).fail(function(){

	}).always(function(){

	})
}

function validardatos(){
	$.mask.definitions['~']='[2,6,7]';
	$('#telefono').mask("~999-9999");

}