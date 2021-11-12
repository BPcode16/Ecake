$(function(){
    CargarDatos1();
    CargarDatos2();
    CargarDatos3();
    
});


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