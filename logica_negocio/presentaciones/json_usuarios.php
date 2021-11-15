<?php

include_once("../../Conexion/Modelo_generico.php");
$modelo = new Modelo_generico();


if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_actualizalo") {

    $array_update = array(
        "table" => "tbl_presentacion",
        "idpresentacion" => $_POST['idpresentacion'],
        "tamanio" => $_POST['tamanio'],
        "precio" => $_POST['precio']
    );

    $resultado = $modelo->actualizar_generica($array_update);

    if ($resultado[0] == '1' && $resultado[4] > 0) {
        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {

        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_conid_especifico") {

    $resultado = $modelo->get_todos("tbl_presentacion", "WHERE idpresentacion = '" . $_POST['id'] . "'");
    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['eliminar_datos']) && $_POST['eliminar_datos'] == "si_eliminalo") {
    $array = array(
        "table" => "tbl_presentacion",
        "idproducto" => $_POST['idproducto']
    );
    $resultado = $modelo->eliminar_generica($array);
    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['eliminar_datos']) && $_POST['eliminar_datos'] == "si_eliminalo2") {
    $array = array(
        "table" => "tbl_presentacion",
        "idpresentacion" => $_POST['idpresentacion']
    );
    $resultado = $modelo->eliminar_generica($array);
    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {
    $array_insertar = array(
        "table" => "tbl_presentacion",
        "idproducto" => $_POST['lista2'],
        "tamanio" => $_POST['tamanio'],
        "precio" => $_POST['precio']
    );
    $result = $modelo->insertar_generica($array_insertar);
    if ($result[0] == '1') {

        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos'] == "si_consultalos") {
    $sql = "SELECT p.idproducto, p.nombre,
        (select count(*) from tbl_presentacion t1 where t1.idproducto=p.idproducto) presentaciones
      from tbl_productos p";
    $resultado = $modelo->get_query($sql);

    $html = $html_tr = "";
    if ($resultado[0] == "1") {
        foreach ($resultado[2] as $row) {


            $html_tr .= '<tr>
                            <td>' . $row['idproducto'] . '</td>
                            <td>' . $row['nombre'] . '</td>
                            <td>' . $row['presentaciones'] . '</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar" data-id="' . $row['idproducto'] . '" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar"  data-id="' . $row['idproducto'] . '"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
                            </td> 
                        </tr>';
        }

        $html .= '<table id="tabla_cliente" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Presentaciones</th>
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
        print json_decode("");
    }
} else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos'] == "si_tabla") {
    $idproducto = 0;
    $idproducto = $_POST['idproducto'];
    if ($idproducto > 0) {
        $sql = "SELECT pr.idpresentacion, pr.idproducto, p.nombre, tamanio, precio FROM tbl_presentacion pr INNER JOIN tbl_productos p ON pr.idproducto = p.idproducto WHERE pr.idproducto = $idproducto";
        $resultado = $modelo->get_query($sql);
    } else if ($idproducto == -1) {
        $sql = "SELECT pr.idpresentacion, pr.idproducto, p.nombre, tamanio, precio FROM tbl_presentacion pr INNER JOIN tbl_productos p ON pr.idproducto = p.idproducto WHERE pr.idproducto = $idproducto";
        $resultado = $modelo->get_query($sql);
    } else {
        $sql = "SELECT pr.idpresentacion, pr.idproducto, p.nombre, tamanio, precio FROM tbl_presentacion pr INNER JOIN tbl_productos p ON pr.idproducto = p.idproducto";
        $resultado = $modelo->get_query($sql);
    }
    $html = $html_tr = "";
    if ($resultado[0] == "1") {
        if ($resultado[4] > 0) {
            foreach ($resultado[2] as $row) {


                $html_tr .= '<tr>
                            <td>' . $row['idproducto'] . '</td>
                            <td>' . $row['nombre'] . '</td>
                            <td>' . $row['tamanio'] . '</td>
                            <td>' . $row['precio'] . '</td>
                            <td>
                            <a href="javascript:void(0)" class="btn_editar2" data-id="' . $row['idpresentacion'] . '" style="margin-right: 25px;"><i class="mdi mdi-lead-pencil" title="Editar producto"></i></a>
                            <a href="javascript:void(0)" class="text-danger btn_eliminar2"  data-id="' . $row['idpresentacion'] . '"><i class="mdi mdi-delete" title="Eliminar producto"></i></a>
                            </td> 
                        </tr>';
            }

            $html .= '<table id="tabla_presentaciones" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Tamaño</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
            $html .= $html_tr;
            $html .= '</tbody>
            		</table>';
        } else {
            $html .= '<h6>No tiene presentaciones.</h6>
                        ';
        }
        if($idproducto == -1) {
            
            $html = '<h6>Seleccione un producto.</h6>
                        ';
        }
        print json_encode(array("Exito", $html, $resultado[4]));
    } else {
        print json_decode("");
    }
}
