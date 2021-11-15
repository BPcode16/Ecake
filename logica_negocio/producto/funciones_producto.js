$(function(){

	var fecha = new Date();
	console.log("JQuery si esta funcionando");

	
	$('#fecha').datepicker({
	    format: "dd/mm/yyyy",
	    language: "es",
	    autoclose: true,
	    endDate:fecha

	});
	
	CargarDatos();

	//Detecta el cambio en el input cuando ingresa la img
	//CUIDADO NO SABEMOS SI VA AQUI
	$(document).on("change", "#imagen_producto", function(e){
		validar_archivo($(this));
	})

	$(document).on("click", ".btn_eliminar_p", function(e){
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

	

    $(document).on("click", "#registrar_producto", function(e){
		e.preventDefault();
		$("#md_registrar_producto").modal("show");
	})

	
});

//Aqui inicia el registro del producto
$(document).on("submit", "#formulario_registro", function(e){
	e.preventDefault();

	var datos = $("#formulario_registro").serialize();
	console.log("Datos: ", datos);

	$.ajax({
				dataType: "json",
				method: "POST",
				url: "json_producto.php",
				data: datos
			}).done(function(json){

				console.log("Aqui debe ser: ", json[1]['idproducto']);
				if (json[0]=="Exito") {

					$("#md_registrar_producto").modal("hide");
					$('#ingreso_datos').val("si_registro");
					if ($("#imagen_producto").val()!="") {
						subir_archivo($("#imagen_producto"), json[1]['idproducto']);
					}
					CargarDatos();
				}else{
					CargarDatos();
				}

			}).fail(function(){

			}).always(function(){

			})


});	


//AQUI EL METODO EDITAR

$(document).on("click",".btn_editar_p",function(e){
	e.preventDefault(); 

	var id = $(this).attr("data-id");
	console.log("El id es: ",id);
	var datos = {"consultar_info":"si_conid_especifico","idproducto":id}//este id es el que se lleva a json_catalogo al if de consultar_info
	$.ajax({
		dataType: "json",
		method: "POST",
		url:'json_producto.php',
		data : datos,
	}).done(function(json) {
		Swal.close();
		console.log("EL consultar especifico",json);
		if (json[0]=="Exito") {

			$('#llave_producto').val(id);
			$('#categoria').val(json[2]['idcategoria']);
			$('#ingreso_datos').val("si_actualizalo");
			$('#nombre').val(json[2]['nombre']);
			$('#descrip').val(json[2]['descripcion']);
			$('#relleno').val(json[2]['idrelleno']);
			$('#remojo').val(json[2]['idremojo']);
			$('#sabor').val(json[2]['idsabor']);
			$('#tiempo').val(json[2]['tiempoprocesamiento']);

			
			$('#md_registrar_producto').modal('show');
		}
		
	}).fail(function(){

	}).always(function(){

	})

});


//AQUI EL METODO DE ELIMINAR

function eliminar(id){

	var datos = {"eliminar_datos":"si_eliminalo","idproducto":id};
	$.ajax({
		dataType:"json",
		method:"POST",
		url:"json_producto.php",
		data:datos
	}).done(function(json){
		console.log("datos consuldos: ",json);
		if (json[0]=="Exito") {
			CargarDatos();
		}
	}).fail(function(){

	}).always(function(){

	})
}


//Metodo que sube el archivo
function subir_archivo(archivo,idproducto){

	Swal.fire({
      title: '¡Subiendo imagen!',
      html: 'Por favor espere mientras se sube el archivo',
      timerProgressBar: true,
      allowEscapeKey:false,
      allowOutsideClick:false,
      onBeforeOpen: () => {
        Swal.showLoading()
      }
  	});

  console.log("aca archivos",archivo,idproducto);
  // return null;
		var file =archivo.files;
		//var formData = new FormData();
		//formData.append('formData', $("#crear_seccion_home"));
		var data = new FormData();
		//Append files infos
		jQuery.each(archivo[0].files, function(i, file) {
			data.append('file-'+i, file);
		});

     console.log("data",data);
     $.ajax({  
        url: "json_producto.php?id="+idproducto+'&subir_imagen=subir_imagen_ajax',  
        type: "POST", 
        dataType: "json",  
        data: data,  
        cache: false,
        processData: false,  
        contentType: false, 
        context: this,

        success: function (json) {
	          Swal.close();
	            console.log("eljson_img",json[0]);
	            

	        if(json[0]=="Exito"){  
	             Swal.fire(
		          '¡Excelente!',
		          'La información ha sido almacenada correctamente!',
		          'success'
	        	);

				$('#md_registrar_producto').modal('show');
				CargarDatos();
        	  
            }else{
				console.log("Este es el error que devuelve json", json[0]);
                Swal.fire(
		          '¡Error!',
		          'No ha sido posible registrar la imagen',
		          'error'
		        );
				$('#md_registrar_producto').modal('show');
				CargarDatos();
            }

        }
    });
}


//AQUI EL METODO DE CARGA
function CargarDatos(){
	var datos = {"consultar_datos":"si_consultalos"};
	$.ajax({
		dataType: "json",
		method: "POST",
		url: "json_producto.php",
		data: datos
	}).done(function(json){
		if (json[0]=="Exito") {
			console.log("Datos consultados aqui: ", json[3][0]);
			$("#aqui_tabla").empty().html(json[1]);//llena la tabla
			$("#tabla_producto").DataTable();//le da el formato
			$("#cantidad_productos").empty().html(json[2]);
			$("#categoria").empty().html(json[3][0]);
			$("#relleno").empty().html(json[4][0]);
			$("#remojo").empty().html(json[5][0]);
			$("#sabor").empty().html(json[6][0]);
		}

	}).fail(function(){

	}).always(function(){

	})
}

function validar_archivo(file){
	console.log("validar_archivo",file);
	 
     var Lector;
     var Archivos = file[0].files;
     var archivo = file;
     var archivo2 = file.val();
     if (Archivos.length > 0) {


        Lector = new FileReader();
        Lector.onloadend = function(e) {
            var origen, tipo, tamanio;
            //Envia la imagen a la pantalla
            origen = e.target; //objeto FileReader
            //Prepara la información sobre la imagen

            tipo = archivo2.substring(archivo2.lastIndexOf("."));
            console.log("el tipo",tipo);
            tamanio = e.total / 1024;
            console.log("el tamaño",tamanio);

            if (tipo !== ".jpeg" && tipo !== ".JPEG" && tipo !== ".jpg" && tipo !== ".JPG" && tipo !== ".png" && tipo !== ".PNG") {
                console.log("error_tipo");
                $("#error_en_la_imagen").css('display','block');
            }
            else{
                 $("#error_en_la_imagen").css('display','none');
				 //Aqui verificamos que la imagen no pase del tamaño establecido

				 if (tamanio>=5000) {
					console.log("error tamanio");
					$("#error_en_la_imagen_t").css('display','block');//block miestra la variable que esta en el index
				}
				else{
					 $("#error_en_la_imagen_t").css('display','none');// none es para ocultar la variable que tenemos en el index
					 //Aqui verificamos que la imagen no pase del tamaño establecido
					 
					console.log("en el else");
				}
                console.log("en el else");
            }

       };
        Lector.onerror = function(e) {
        console.log(e)
       }
       Lector.readAsDataURL(Archivos[0]);
   }
}