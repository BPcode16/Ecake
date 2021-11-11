<?php

    include_once("../../Conexion/Modelo_generico.php");
    $modelo=new Modelo_generico();

if (isset($_POST['consultar_datos']) && $_POST['consultar_datos']=="si_consultalos") {
    $sql = "SELECT * FROM tbl_categorias";
    $resultado = $modelo->get_query($sql);

    $html=$html_tr="";
    if ($resultado[0]=="1") {
        foreach ($resultado[2] as $row) {
            
            
            $html_tr.='<tr>
                        <td>'.$row['nombre'].'</td>
                        <td>'.$row['descripcion'].'</td>
                        <td>
                        <a href="javascript:void(0)" class="btn_editar" data-id="'.$row['idcliente'].'" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar categoría"></i></a>
                        <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="'.$row['idcliente'].'"><i class="mdi mdi-delete" title="Eliminar categoría"></i></a>
                        </td> 
                    </tr>';
            
        }

        $html.='<table id="tabla_categoria" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Nombre de la categoría</th>
                        <th>descripción</th>
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