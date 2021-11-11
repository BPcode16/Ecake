<?php

    include_once("../../Conexion/Modelo_generico.php");
    $modelo=new Modelo_generico();

    if(isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo"){

        $array_update = array(
            "table" => "tbl_categorias",
            "idcategoria" => $_POST['llave_categoria'],
            "nombre" => $_POST['nombre'],
            "descripcion" => $_POST['descrip'],
            
        );

        $resultado = $modelo->actualizar_generica($array_update);

        if($resultado[0]=='1' && $resultado[4]>0){

            print json_encode(array("Exito",$_POST,$resultado));
            exit();

        }else{

            print json_encode(array("Error",$_POST,$resultado));
            exit();

        }

    }else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_conid_especifico") {

        $resultado = $modelo->get_todos("tbl_categorias","WHERE idcategoria = '".$_POST['id']."'");
        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if(isset($_POST['eliminar_datos']) && $_POST['eliminar_datos']=="si_eliminalo"){
        $array = array(
            "table"=>"tbl_categorias",
            "idcategoria"=>$_POST['idcategoria']
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
		

		
        $array_insertar = array(
            "table" => "tbl_categorias",
            "nombre" => $_POST['nombre'],
            "descripcion" => $_POST['descrip'],
            "estado" => 1
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){

        	print json_encode(array("Exito",$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }


	}else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos']=="si_consultalos") {
    $sql = "SELECT * FROM tbl_categorias";
    $resultado = $modelo->get_query($sql);

    $html=$html_tr="";
    if ($resultado[0]=="1") {
        foreach ($resultado[2] as $row) {
            
            
            $html_tr.='<tr>
                        <td>'.$row['nombre'].'</td>
                        <td>'.$row['descripcion'].'</td>
                        <td>'.$row['estado'].'</td>
                        <td>
                        <a href="javascript:void(0)" class="btn_editar" data-id="'.$row['idcategoria'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar categoría"></i></a>
                        <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="'.$row['idcategoria'].'"><i class="mdi mdi-delete" title="Eliminar categoría"></i></a>
                        </td> 
                    </tr>';
            
        }

        $html.='<table id="tabla_categoria" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Nombre de la categoría</th>
                        <th>Descripción</th>
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
        print json_decode(array("Error",$resultado));
    }

    }

?>