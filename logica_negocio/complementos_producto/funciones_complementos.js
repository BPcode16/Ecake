$(function(){
    CargarDatos1();
    CargarDatos2();
    CargarDatos3();
	console.log("JQuery si esta funcionando");

	$(document).on("click", "#registrar_comp", function(e){
		e.preventDefault();
		$("#md_registrar_comp").modal("show");
	});

	//Aqui los metodos de eliminado

	$(document).on("click", ".btn_eliminar_relleno", function(e){
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
				eliminar_relleno($(this).attr('data-id'));
			} else if (result.isDenied) {
			  Swal.fire('Accion cancelada por el usuario', '', 'info')
			}
		  })
	});

	$(document).on("click", ".btn_eliminar_remojo", function(e){
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
				eliminar_remojo($(this).attr('data-id'));
			} else if (result.isDenied) {
			  Swal.fire('Accion cancelada por el usuario', '', 'info')
			}
		  })
	});

	$(document).on("click", ".btn_eliminar_sabor", function(e){
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
				eliminar_sabor($(this).attr('data-id'));
			} else if (result.isDenied) {
			  Swal.fire('Accion cancelada por el usuario', '', 'info')
			}
		  })
	});

	//Aqui comienzan los registros de los formularios por independiente
	
	//Relleno
	$(document).on("click","#btn_registro_relleno",function(e){
		e.preventDefault(); 
	
		var idrelleno = $('#llave_relleno').val();
		var nombre_relleno = $('#nombre_relleno').val();
		console.log("El nombre es: ",nombre_relleno);
		var datos = {"registrar_info":"si_registra_info", "idrelleno":idrelleno,"nombre_relleno":nombre_relleno, "estado":1}
		$.ajax({
			dataType: "json",
			method: "POST",
			url:'json_complementos.php',
			data : datos
		}).done(function(json) {
			console.log("Datos consultados antes de if: ", json);
			if (json[0]=="Exito") {
				Swal.close();
				console.log("Datos consultados dd: ", json);

				//limpiamos la llave
				$('#llave_relleno').val("");
				$('#nombre_relleno').val("");
				

				CargarDatos1();
			}
			 
		}).fail(function(){
	
		}).always(function(){
	
		});
	
	
	});

	//Remojo
	$(document).on("click","#btn_registro_remojo",function(e){
		e.preventDefault(); 
	
		var idremojo = $('#llave_remojo').val();
		var nombre_remojo = $('#nombre_remojo').val();
		console.log("El nombre es: ",nombre_remojo);
		var datos = {"registrar_info_remojo":"si_registra_info_remojo", "idremojo":idremojo,"nombre_remojo":nombre_remojo, "estado":1}
		$.ajax({
			dataType: "json",
			method: "POST",
			url:'json_complementos.php',
			data : datos
		}).done(function(json) {
			console.log("Datos consultados antes de if: ", json);
			if (json[0]=="Exito") {
				Swal.close();
				console.log("Datos consultados dd: ", json);

				//limpiamos la llave
				$('#llave_remojo').val("");
				$('#nombre_remojo').val("");

				CargarDatos2();
			}
			 
		}).fail(function(){
	
		}).always(function(){
	
		});
	
	
	});

	//Sabor de la torta
	$(document).on("click","#btn_registro_sabor",function(e){
		e.preventDefault(); 
		
		var idsabortorta = $('#llave_sabor').val();
		var nombre_sabor = $('#nombre_sabor').val();
		console.log("El nombre es: ",nombre_sabor);
		var datos = {"registrar_info_sabor":"si_registra_info_sabor", "idsabortorta":idsabortorta, "nombre_sabor":nombre_sabor,  "estado":1}
		$.ajax({
			dataType: "json",
			method: "POST",
			url:'json_complementos.php',
			data : datos
		}).done(function(json) {
			console.log("Datos consultados antes de if: ", json);
			if (json[0]=="Exito") {
				Swal.close();
				console.log("Datos consultados dd: ", json);

				$('#llave_sabor').val("");
				$('#nombre_sabor').val("");

				CargarDatos3();
			}
			 
		}).fail(function(){
	
		}).always(function(){
	
		});
	
	
	});
	

});

//AQUI EL METODO EDITAR

$(document).on("click",".btn_editar_relleno",function(e){
	e.preventDefault(); 

	var id = $(this).attr("data-id");
	console.log("El id es: ",id);
	var datos = {"consultar_info_relleno":"si_conid_especifico","id":id}//este id es el que se lleva a json_catalogo al if de consultar_info
	$.ajax({
		dataType: "json",
		method: "POST",
		url:'json_complementos.php',
		data : datos,
	}).done(function(json) {
		console.log("EL consultar especifico",json);
		if (json[0]=="Exito") {

			$('#llave_relleno').val(id);
			$('#nombre_relleno').val(json[2]['saborrelleno']);
			$('#md_registrar_comp').modal('show');
		}
		 
	}).fail(function(){

	}).always(function(){

	});


});

$(document).on("click",".btn_editar_remojo",function(e){
	e.preventDefault(); 

	var id = $(this).attr("data-id");
	console.log("El id es: ",id);
	var datos = {"consultar_info_remojo":"si_conid_especifico","id":id}//este id es el que se lleva a json_catalogo al if de consultar_info
	$.ajax({
		dataType: "json",
		method: "POST",
		url:'json_complementos.php',
		data : datos,
	}).done(function(json) {
		console.log("EL consultar especifico",json);
		if (json[0]=="Exito") {

			$('#llave_remojo').val(id);
			$('#nombre_remojo').val(json[2]['saborremojo']);
			$('#md_registrar_comp').modal('show');
		}
		 
	}).fail(function(){

	}).always(function(){

	});


});

$(document).on("click",".btn_editar_sabor",function(e){
	e.preventDefault(); 

	var id = $(this).attr("data-id");
	console.log("El id es: ",id);
	var datos = {"consultar_info_sabor":"si_conid_especifico","id":id}//este id es el que se lleva a json_catalogo al if de consultar_info
	$.ajax({
		dataType: "json",
		method: "POST",
		url:'json_complementos.php',
		data : datos,
	}).done(function(json) {
		console.log("EL consultar especifico",json);
		if (json[0]=="Exito") {

			$('#llave_sabor').val(id);
			$('#nombre_sabor').val(json[2]['sabortorta']);
			$('#md_registrar_comp').modal('show');
		}
		 
	}).fail(function(){

	}).always(function(){

	});


});

//AQUI EL METODO DE ELIMINAR

function eliminar_relleno(id){

	var datos = {"eliminar_datos_relleno":"si_eliminalo","idrelleno":id};
	$.ajax({
		dataType:"json",
		method:"POST",
		url:"json_complementos.php",
		data:datos
	}).done(function(json){
		console.log("datos consuldos: ",json);
		if (json[0]=="Exito") {
			CargarDatos1();
		}
	}).fail(function(){

	}).always(function(){

	})
}

function eliminar_remojo(id){

	var datos = {"eliminar_datos_remojo":"si_eliminalo","idremojo":id};
	$.ajax({
		dataType:"json",
		method:"POST",
		url:"json_complementos.php",
		data:datos
	}).done(function(json){
		console.log("datos consuldos: ",json);
		if (json[0]=="Exito") {
			CargarDatos2();
		}
	}).fail(function(){

	}).always(function(){

	})
}

function eliminar_sabor(id){

	var datos = {"eliminar_datos_sabor":"si_eliminalo","idsabortorta":id};
	$.ajax({
		dataType:"json",
		method:"POST",
		url:"json_complementos.php",
		data:datos
	}).done(function(json){
		console.log("datos consuldos: ",json);
		if (json[0]=="Exito") {
			CargarDatos3();
		}
	}).fail(function(){

	}).always(function(){

	})
}




//Aqui comienzan las funciones con las que mandamos a llenar a las tablas
//1- Relleno. 2- remojo. 3- sabor torta.

function CargarDatos1(){
	var datos = {"consultar_datos_relleno":"si_consultalos"};
	$.ajax({
		dataType: "json",
		method: "POST",
		url: "json_complementos.php",
		data: datos
	}).done(function(json){

		console.log("Datos consultados: ", json);
		if (json[0]=="Exito") {
			Swal.close();
			$("#aqui_tabla1").empty().html(json[1]);//llena la tabla
			$("#tabla_relleno").DataTable();//le da el formato
			$("#rellenos_registrados").empty().html(json[2]);//Digita el numero de registros
		}

	}).fail(function(){

	}).always(function(){

	})
}

function CargarDatos2(){
	var datos = {"consultar_datos_remojo":"si_consultalos"};
	$.ajax({
		dataType: "json",
		method: "POST",
		url: "json_complementos.php",
		data: datos
	}).done(function(json){

		console.log("Datos consultados: ", json);
		if (json[0]=="Exito") {
			Swal.close();
			$("#aqui_tabla2").empty().html(json[1]);//llena la tabla
			$("#tabla_remojo").DataTable();//le da el formato
			$("#remojos_registrados").empty().html(json[2]);//Digita el numero de registros
		}

	}).fail(function(){

	}).always(function(){

	})
}

function CargarDatos3(){
	var datos = {"consultar_datos_sabor":"si_consultalos"};
	$.ajax({
		dataType: "json",
		method: "POST",
		url: "json_complementos.php",
		data: datos
	}).done(function(json){

		console.log("Datos consultados: ", json);
		if (json[0]=="Exito") {
			Swal.close();
			$("#aqui_tabla3").empty().html(json[1]);//llena la tabla
			$("#tabla_sabor").DataTable();//le da el formato
			$("#sabores_registrados").empty().html(json[2]);//Digita el numero de registros
		}

	}).fail(function(){

	}).always(function(){

	})
}