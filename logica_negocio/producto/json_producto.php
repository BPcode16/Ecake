<?php 

    include_once("../../Conexion/Modelo_generico.php");
    $modelo=new Modelo_generico();

    if (isset($_GET['subir_imagen']) && $_GET['subir_imagen']=="subir_imagen_ajax") {
        //$trozos = explode(".",$_FILES['file-0']['name']);
		//$extension = end($trozos);
		//$name = "img_".$_GET['id'].".".$extension;
        $vari = '';
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
			function generate_string($input, $strength = 16) {
    			$input_length = strlen($input);
    			$random_string = '';
    			for($i = 0; $i < $strength; $i++) {
        		$random_character = $input[mt_rand(0, $input_length - 1)];
        		$random_string .= $random_character;
    			}
    			return $random_string;
			}
			$vari = generate_string($permitted_chars, 5);

		$file_path = "imagenes_producto/$vari.png";
        $file_path_ruta = "logica_negocio/producto/imagenes_producto/$vari.png";
		try {
			$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);

            //Aqui hacemos la actualizacion a la base y le asignamos la imagen
            $array_update = array(

                "table" => "tbl_productos",
                "idproducto" => $_GET['id'],
                "imagenprincipal" => $file_path,
                
            );
    
            $resultado = $modelo->actualizar_generica($array_update);

            if($resultado[0]=='1' && $resultado[4]>0){

                print json_encode(array("Exito",$mover, $resultado));
                exit();
    
            }else{
    
                print json_encode(array("Error",$mover,$resultado));
                exit();
    
            }
			 
		} catch (Exception $e) {
			print json_encode(array("Error",$e));
				exit();
		}
		


		 

	}else if(isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo"){

        $array_update = array(
            

            "table" => "tbl_productos",
            "idproducto" => $_POST['llave_producto'],
            "idcategoria" => $_POST['categoria'],
            "nombre" => $_POST['nombre'],
            "descripcion" => $_POST['descrip'],
            "tiempoprocesamiento" => $_POST['tiempo'],
            "estado" => 1,
            "imagenprincipal" => "",
            "idrelleno" => $_POST['relleno'],
            "idremojo" => $_POST['remojo'],
            "idsabortorta" => $_POST['sabor']
        );

        $resultado = $modelo->actualizar_generica($array_update);

        if($resultado[4]>0){

            //print json_encode(array("Exito",$_POST,$resultado));
            //xit();
            //aqui obtenemos el id del registro que acabamos de hacer
            $producto_nuevo = $modelo->get_todos("tbl_productos","WHERE nombre = '".$_POST['nombre']."' ");

        	print json_encode(array("Exito",$producto_nuevo[2][0],$_POST,$resultado));
			exit();

        }else if($resultado[0]=='1'){

            $producto_nuevo = $modelo->get_todos("tbl_productos","WHERE nombre = '".$_POST['nombre']."' ");
            print json_encode(array("Exito",$producto_nuevo[2][0],$_POST,$resultado));
			exit();
        

        }else{
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }

    }else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_conid_especifico") {

        $resultado = $modelo->get_todos("tbl_productos","WHERE idproducto = '".$_POST['idproducto']."'");
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if(isset($_POST['eliminar_datos']) && $_POST['eliminar_datos']=="si_eliminalo"){
    $array = array(
        "table"=>"tbl_productos",
        "idproducto"=>$_POST['idproducto']
    );
    $resultado = $modelo->eliminar_generica($array);
    if($resultado[0]=='1'){
        print json_encode(array("Exito",$_POST,$resultado));
        exit();

    }else {
        print json_encode(array("Error",$_POST,$resultado));
        exit();
    }

}else if(isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro"){
		
    $nombre=$_POST['nombre'];
		
        $array_insertar = array(
            "table" => "tbl_productos",
            "idcategoria" => $_POST['categoria'],
            "nombre" => $nombre,
            "descripcion" => $_POST['descrip'],
            "tiempoprocesamiento" => $_POST['tiempo'],
            "estado" => 1,
            "imagenprincipal" => "",
            "idrelleno" => $_POST['relleno'],
            "idremojo" => $_POST['remojo'],
            "idsabortorta" => $_POST['sabor']
        );
        $result = $modelo->insertar_generica($array_insertar);//Aqui hace el insert
        if($result[0]=='1'){
            //aqui obtenemos el id del registro que acabamos de hacer
            $producto_nuevo = $modelo->get_todos("tbl_productos","WHERE nombre = '".$nombre."' ");

        	print json_encode(array("Exito",$producto_nuevo[2][0],$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }


	}else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos']=="si_consultalos") {
        //Comienzan los combobox
        //array de categoria
        $arrar_select = array(
            "table"=>"tbl_categorias",
            "idcategoria"=>"nombre"
        );

        //array de relleno
        $arrar_relleno = array(
            "table"=>"tbl_relleno",
            "idrelleno"=>"saborrelleno"
        );

        //array de remojo
        $arrar_remojo = array(
            "table"=>"tbl_remojo",
            "idremojo"=>"saborremojo"
        );
        
        //array de sabor torta
        $arrar_sabor = array(
            "table"=>"tbl_sabortorta",
            "idsabortorta"=>"sabortorta"
        );

        $estado_activo="WHERE estado=1";


        //retorna la informaciond e los combos
        $result_select= $modelo->crear_select($arrar_select, $estado_activo);
        $result_relleno= $modelo->crear_select($arrar_relleno, $estado_activo);
        $result_remojo= $modelo->crear_select($arrar_remojo, $estado_activo);
        $result_sabor= $modelo->crear_select($arrar_sabor, $estado_activo);
        //Comienza la tabla
		$sql = "SELECT
        p.idproducto, ct.nombre idcategoria, p.nombre, p.descripcion, p.tiempoprocesamiento, p.estado, p.imagenprincipal, rl.saborrelleno idrelleno, rm.saborremojo idremojo, sb.sabortorta idsabortorta
        FROM
            tbl_productos p
        LEFT JOIN tbl_categorias ct
            ON p.idcategoria=ct.idcategoria
        LEFT JOIN tbl_relleno rl ON p.idrelleno=rl.idrelleno
        LEFT JOIN tbl_remojo rm ON p.idremojo=rm.idremojo
        LEFT JOIN tbl_sabortorta sb ON p.idsabortorta=sb.idsabortorta";
            $resultado = $modelo->get_query($sql);

		$html=$html_tr="";
		if ($resultado[0]=="1") {
			foreach ($resultado[2] as $row) {
				
				
				$html_tr.='<tr>
                            <td><img alt="img" width="90" height="100" src="'.$row['imagenprincipal'].'"></td>
                            <td>'.$row['idcategoria'].'</td>
                            <td>'.$row['nombre'].'</td>
                            <td>'.$row['descripcion'].'</td>
                            <td>'.$row['tiempoprocesamiento'].'</td>
                            
                            <td>'.$row['idrelleno'].'</td>
                            <td>'.$row['idremojo'].'</td>
                            <td>'.$row['idsabortorta'].'</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar_p" data-id="'.$row['idproducto'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar_p"  data-id="'.$row['idproducto'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
                            </td> 
                        </tr>';
				
			}
            

			$html.='<table id="tabla_producto" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Fotografía</th>
                            <th>Categoría</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Días de procesado</th>
                            
                            <th>Relleno</th>
                            <th>Remojo</th>
                            <th>Sabor torta</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
            $html.=$html_tr;
            $html.='</tbody>
            		</table>';

           	print json_encode(array("Exito",$html,$resultado[4], $result_select, $result_relleno, $result_remojo, $result_sabor));
               exit();

		}else{
			print json_decode("");
            exit();
		}
		
	}
