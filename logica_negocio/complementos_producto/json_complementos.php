<?php
    include_once("../../Conexion/Modelo_generico.php");
    $modelo=new Modelo_generico();

    
    if (isset($_POST['consultar_info_sabor']) && $_POST['consultar_info_sabor']=="si_conid_especifico") {

        $resultado = $modelo->get_todos("tbl_sabortorta","WHERE idsabortorta = '".$_POST['id']."'");
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if (isset($_POST['consultar_info_remojo']) && $_POST['consultar_info_remojo']=="si_conid_especifico") {

        $resultado = $modelo->get_todos("tbl_remojo","WHERE idremojo = '".$_POST['id']."'");
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if (isset($_POST['consultar_info_relleno']) && $_POST['consultar_info_relleno']=="si_conid_especifico") {

        $resultado = $modelo->get_todos("tbl_relleno","WHERE idrelleno = '".$_POST['id']."'");
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if(isset($_POST['eliminar_datos_sabor']) && $_POST['eliminar_datos_sabor']=="si_eliminalo"){
        $array = array(
            "table"=>"tbl_sabortorta",
            "idsabortorta"=>$_POST['idsabortorta']
        );
        $resultado = $modelo->eliminar_generica($array);
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }

    }else if(isset($_POST['eliminar_datos_remojo']) && $_POST['eliminar_datos_remojo']=="si_eliminalo"){
        $array = array(
            "table"=>"tbl_remojo",
            "idremojo"=>$_POST['idremojo']
        );
        $resultado = $modelo->eliminar_generica($array);
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }

    }else if(isset($_POST['eliminar_datos_relleno']) && $_POST['eliminar_datos_relleno']=="si_eliminalo"){
        $array = array(
            "table"=>"tbl_relleno",
            "idrelleno"=>$_POST['idrelleno']
        );
        $resultado = $modelo->eliminar_generica($array);
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }

    }else if(isset($_POST['registrar_info_sabor']) && $_POST['registrar_info_sabor']=="si_registra_info_sabor"){

		$idsabortorta=$_POST['idsabortorta'];
        $nombre= $_POST['nombre_sabor'];
        $estado = $_POST['estado'];

        if ($idsabortorta=="") {
            # code...
            $array_insertar = array(
                "table" => "tbl_sabortorta",
                "sabortorta" => $nombre,
                "estado" => $estado,
            );
    
            $result = $modelo->insertar_generica($array_insertar);
            if($result[0]=='1'){
    
                print json_encode(array("Exito",$_POST,$result));
                exit();
    
            }else {
                print json_encode(array("Error",$_POST,$result));
                exit();
            }
        }else{
            $array_update = array(
                "table" => "tbl_sabortorta",
                "idsabortorta" => $idsabortorta,
                "sabortorta" => $nombre,
                "estado" => $estado,
            );
    
            $resultado = $modelo->actualizar_generica($array_update);
    
            if($resultado[0]=='1' && $resultado[4]>0){
    
                print json_encode(array("Exito",$_POST,$resultado));
                exit();
    
            }else{
    
                print json_encode(array("Error",$_POST,$resultado));
                exit();
    
            }
        }
		
        


	}else if(isset($_POST['registrar_info_remojo']) && $_POST['registrar_info_remojo']=="si_registra_info_remojo"){
		
        $idremojo=$_POST['idremojo'];
        $nombre= $_POST['nombre_remojo'];
        $estado = $_POST['estado'];

        if ($idremojo=="") {
            # code...
            $array_insertar = array(
                "table" => "tbl_remojo",
                "saborremojo" => $nombre,
                "estado" => $estado,
            );
    
            $result = $modelo->insertar_generica($array_insertar);
            if($result[0]=='1'){
    
                print json_encode(array("Exito",$_POST,$result));
                exit();
    
            }else {
                print json_encode(array("Error",$_POST,$result));
                exit();
            }
        }else{
            $array_update = array(
                "table" => "tbl_remojo",
                "idremojo" => $idremojo,
                "saborremojo" => $nombre,
                "estado" => $estado,
            );
    
            $resultado = $modelo->actualizar_generica($array_update);
    
            if($resultado[0]=='1' && $resultado[4]>0){
    
                print json_encode(array("Exito",$_POST,$resultado));
                exit();
    
            }else{
    
                print json_encode(array("Error",$_POST,$resultado));
                exit();
    
            }
        }
		
        


	}else if(isset($_POST['registrar_info']) && $_POST['registrar_info']=="si_registra_info"){
        $idrelleno=$_POST['idrelleno'];
        $nombre= $_POST['nombre_relleno'];
        $estado = $_POST['estado'];
		if ($idrelleno=="") {
            # code...
            $array_insertar = array(
                "table" => "tbl_relleno",
                "saborrelleno" => $nombre,
                "estado" => $estado,
            );
            $result = $modelo->insertar_generica($array_insertar);
            if($result[0]=='1'){
    
                print json_encode(array("Exito",$_POST,$result));
                exit();
    
            }else {
                print json_encode(array("Error",$_POST,$result));
                exit();
            }
        }else{
            $array_update = array(
                "table" => "tbl_relleno",
                "idrelleno" => $idrelleno,
                "saborrelleno" => $nombre,
                "estado" => $estado,
            );
    
            $resultado = $modelo->actualizar_generica($array_update);
    
            if($resultado[0]=='1' && $resultado[4]>0){
    
                print json_encode(array("Exito",$_POST,$resultado));
                exit();
    
            }else{
    
                print json_encode(array("Error",$_POST,$resultado));
                exit();
    
            }
        }
        
		
        


	}else if(isset($_POST['consultar_datos_sabor']) && $_POST['consultar_datos_sabor']=="si_consultalos") {
		$sql = "SELECT * FROM tbl_sabortorta";
		$resultado = $modelo->get_query($sql);

		$html=$html_tr="";
		if ($resultado[0]=="1") {
			foreach ($resultado[2] as $row) {
				
				
				$html_tr.='<tr>
                            <td>'.$row['sabortorta'].'</td>
                            <td>'.$row['estado'].'</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar_sabor" data-id="'.$row['idsabortorta'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar_sabor"  data-id="'.$row['idsabortorta'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
                            </td> 
                        </tr>';
				
			}

			$html.='<table id="tabla_sabor" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sabor de la torta</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
            $html.=$html_tr;
            $html.='</tbody>
            		</table>';

           	print json_encode(array("Exito",$html,$resultado[4]));

		}else{
			//print json_decode(array("Error",$resultado));
		}
		
	}else if (isset($_POST['consultar_datos_remojo']) && $_POST['consultar_datos_remojo']=="si_consultalos") {
		$sql = "SELECT * FROM tbl_remojo";
		$resultado = $modelo->get_query($sql);

		$html=$html_tr="";
		if ($resultado[0]=="1") {
			foreach ($resultado[2] as $row) {
				
				
				$html_tr.='<tr>
                            <td>'.$row['saborremojo'].'</td>
                            <td>'.$row['estado'].'</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar_remojo" data-id="'.$row['idremojo'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar_remojo"  data-id="'.$row['idremojo'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
                            </td> 
                        </tr>';
				
			}

			$html.='<table id="tabla_remojo" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Remojo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
            $html.=$html_tr;
            $html.='</tbody>
            		</table>';

           	print json_encode(array("Exito",$html,$resultado[4]));

		}else{
			//print json_decode(array("Error",$resultado));
		}
		
	}else if (isset($_POST['consultar_datos_relleno']) && $_POST['consultar_datos_relleno']=="si_consultalos") {
		$sql = "SELECT * FROM tbl_relleno";
		$resultado = $modelo->get_query($sql);

		$html=$html_tr="";
		if ($resultado[0]=="1") {
			foreach ($resultado[2] as $row) {
				
				
				$html_tr.='<tr>
                            <td>'.$row['saborrelleno'].'</td>
                            <td>'.$row['estado'].'</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar_relleno" data-id="'.$row['idrelleno'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar_relleno"  data-id="'.$row['idrelleno'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
                            </td> 
                        </tr>';
				
			}

			$html.='<table id="tabla_relleno" class="table table-bordered " cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Relleno</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
            $html.=$html_tr;
            $html.='</tbody>
            		</table>';

           	print json_encode(array("Exito",$html,$resultado[4]));

		}else{
			//print json_decode(array("Error",$resultado));
		}
		
	}
?>