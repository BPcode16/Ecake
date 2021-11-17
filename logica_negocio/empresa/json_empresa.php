<?php

include_once("../../Conexion/Modelo_generico.php");
$modelo = new Modelo_generico();

if (isset($_POST['opciones']) && $_POST['opciones'] == "editoImg") {



    $imgData = "";

    if (is_uploaded_file($_FILES['fileImage']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['fileImage']['tmp_name']));
    }

    $sql = "UPDATE tbl_empresa SET logo='{$imgData}', nombre='" . $_POST['nombre'] . "', email='" . $_POST['email'] . "', telefono='" . $_POST['telefono'] . "', horario='" . $_POST['horario'] . "', direccion='" . $_POST['direccion'] . "' WHERE idempresa= 1";
    $result = $modelo->get_query($sql);
    if ($result[0] == '1') {

        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['opciones']) && $_POST['opciones'] == "editoSinImg") {

    $sql = "UPDATE tbl_empresa SET nombre='" . $_POST['nombre'] . "', email='" . $_POST['email'] . "', telefono='" . $_POST['telefono'] . "', horario='" . $_POST['horario'] . "', direccion='" . $_POST['direccion'] . "' WHERE idempresa= 1";
    $result = $modelo->get_query($sql);
    if ($result[0] == '1') {

        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
} else if (isset($_POST['mostrar']) && $_POST['mostrar'] == "si_consultalos") {
    $sql = "SELECT nombre,email,email,telefono,horario,direccion FROM tbl_empresa WHERE idempresa = 1";
    $resultado1 = $modelo->get_query($sql);
    //print json_encode(array("Error"));
    if ($resultado1[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado1[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado1));
        exit();
    }
} else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos'] == "si_imagen") {
    $sql = "SELECT * FROM tbl_empresa WHERE idempresa = 1";
    $resultado = $modelo->get_query($sql);

    $html = "";
    if ($resultado[0] == "1") {
        foreach ($resultado[2] as $row) {

            $html = '<a class="image-popup-no-margins" href="data:image/jpeg;base64,' . base64_encode($row['logo']) . '">
            <img src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" class="img-responsive" width="250"></a>';
        }
    }
    print json_encode(array("Exito", $html, $resultado[4]));
} else if (isset($_POST['consultar_datos']) && $_POST['consultar_datos'] == "si_imagenLogo") {
    $sql = "SELECT * FROM tbl_empresa WHERE idempresa = 1";
    $resultado = $modelo->get_query($sql);

    $html = "";
    if ($resultado[0] == "1") {
        foreach ($resultado[2] as $row) {

            $html = '<a href="index.php" class="logo">
            <img src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" height="66" alt="logo"></a>';
        }
    }
    print json_encode(array("Exito", $html, $resultado[4]));
}
