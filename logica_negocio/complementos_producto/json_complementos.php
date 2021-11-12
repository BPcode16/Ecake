<?php
    include_once("../../Conexion/Modelo_generico.php");
    $modelo=new Modelo_generico();

    if (isset($_POST['consultar_datos_sabor']) && $_POST['consultar_datos_sabor']=="si_consultalos") {
		$sql = "SELECT * FROM tbl_sabortorta";
		$resultado = $modelo->get_query($sql);

		$html=$html_tr="";
		if ($resultado[0]=="1") {
			foreach ($resultado[2] as $row) {
				
				
				$html_tr.='<tr>
                            <td>'.$row['sabortorta'].'</td>
                            <td>'.$row['estado'].'</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar" data-id="'.$row['idsabortorta'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="'.$row['idsabortorta'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
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
			print json_decode(array("Error",$resultado));
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
                            <a href="javascript:void(0)" class="btn_editar" data-id="'.$row['idremojo'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="'.$row['idremojo'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
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
			print json_decode(array("Error",$resultado));
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
                            <a href="javascript:void(0)" class="btn_editar" data-id="'.$row['idrelleno'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="'.$row['idrelleno'].'"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
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
			print json_decode(array("Error",$resultado));
		}
		
	}
?>