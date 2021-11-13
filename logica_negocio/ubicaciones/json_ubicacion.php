<?php
include_once("../../Conexion/Modelo_generico.php");
$modelo = new Modelo_generico();

if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_actualizalo") {

    if ($_POST['idmunicipio'] == 0) {
        $costoenvio = $_POST['costoenvio'];
        $iddepartamento = $_POST['iddepartamento'];

        $sql = "UPDATE tbl_municipio
            SET costoenvio = '$costoenvio'
            WHERE iddepartamento = '$iddepartamento';";
        $resultado = $modelo->insertar_query($sql);

        if ($resultado == FALSE) {

            print json_encode(array("Exito", $_POST, $resultado));
            exit();
        } else {

            print json_encode(array("Error", $_POST, $resultado));
            exit();
        }
    } else {
        $array_update = array(
            "table" => "tbl_municipio",
            "idmunicipio" => $_POST['idmunicipio'],
            "costoenvio" => $_POST['costoenvio']
        );

        $resultado = $modelo->actualizar_generica($array_update);

        if ($resultado[0] == '1') {

            print json_encode(array("Exito", $_POST, $resultado));
            exit();
        } else {

            print json_encode(array("Error", $_POST, $resultado));
            exit();
        }
    }
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_conid_especifico") {

    $resultado = $modelo->get_todos("tbl_municipio", "WHERE idmunicipio = '" . $_POST['id'] . "'");
    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['eliminar_datos']) && $_POST['eliminar_datos'] == "si_eliminalo") {
    $idmunicipio = $_POST['idmunicipio'];
    $iddepartamento = $_POST['iddepartamento'];

    if ($idmunicipio == 0) {
        $sql = "UPDATE tbl_municipio
        SET costoenvio = NULL
        WHERE iddepartamento = '$iddepartamento'";
    } else {
        $sql = "UPDATE tbl_municipio
        SET costoenvio = NULL
        WHERE idmunicipio = '$idmunicipio';";
    }
    $resultado = $modelo->insertar_query($sql);

    if ($resultado == FALSE) {

        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos'] == "si_consultalos") {
    $sql = "SELECT m.iddepartamento, m.idmunicipio, m.nombre as nombre1, d.nombre as nombre, m.costoenvio
        FROM tbl_municipio m
        JOIN tbl_departamento d
        ON m.iddepartamento = d.iddepartamento WHERE costoenvio is not NULL";

    $resultado = $modelo->get_query($sql);

    $html = $html_tr = "";
    if ($resultado[0] == "1") {

        foreach ($resultado[2] as $row) {
            $envio = $row['costoenvio'];
            if($envio == 0) {
                $envio = "Gratuito";
            } else {
                $envio = "$ ".number_format($envio, 2);
            }
            $html_tr .= '<tr>
                            <td>' . $row['nombre'] . '</td>
                            <td>' . $row['nombre1'] . '</td>
                            <td>' . $envio . '</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar" data-id="' . $row['idmunicipio'] . '" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar municipio"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="' . $row['idmunicipio'] . '"><i class="mdi mdi-delete" title="Eliminar registro"></i></a>
                            </td> 
                        </tr>';
        }

        $html .= '<table id="tabla_cliente" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Departamento</th>
                            <th>Municipio</th>
                            <th>Costo de envío</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
        $html .= $html_tr;
        $html .= '</tbody>
            		</table>';

        print json_encode(array("Exito", $html, $resultado[4]));
    } else {
        print json_decode("Error");
    }
} else if (isset($_POST['consultar_boton']) && $_POST['consultar_boton'] == "si_consultalo") {

    $resultado = $modelo->get_todos("tbl_municipio", "WHERE iddepartamento = '" . $_POST['departamento'] . "' AND costoenvio is not NULL");
    if ($resultado[4] == 0) {
        $cadena = "
        <button id='btn_eliminar' class='btn btn-secondary ml-auto' disabled>Remover envíos a este departamento</button>";

        echo  $cadena . "";
    } else {
        $cadena = "
        <button id='btn_eliminar' class='btn btn-secondary ml-auto'>Remover envíos a este departamento</button>";

        echo  $cadena . "";
    }
}