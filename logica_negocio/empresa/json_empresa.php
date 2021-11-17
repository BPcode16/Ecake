<?php

include_once("../../Conexion/Modelo_generico.php");
$modelo = new Modelo_generico();

if (isset($_POST['ingreso_datos'])) {


    $array_update = array(
        "table" => "tbl_empresa",
        "idempresa" => 1,
        "nombre" => $_POST['nombre'],
        "email" => $_POST['email'],
        "telefono" => $_POST['telefono'],
        "horario" => $_POST['horario'],
        //"logo" => $_POST['logo'],
        "direccion" => $_POST['direccion']
    );
    $result = $modelo->actualizar_generica($array_update);
    if ($result[0] == '1') {

        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos'] == "si_consultalos") {
    $resultado = $modelo->get_todos("tbl_empresa", "WHERE idempresa = 1");

    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0],""));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
}
