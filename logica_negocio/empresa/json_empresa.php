<?php

include_once("../../Conexion/Modelo_generico.php");
$modelo = new Modelo_generico();

if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {


    $contra = $modelo->encryptPass($_POST['pass']);

    $array_insertar = array(
        "table" => "tbl_empleado",
        "nombre" => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "correo" => $_POST['correo'],
        "pass" => $contra,
        "estado" => 1,
        "administrador" => $_POST['administrador'],
        "idempresa" => 1
    );
    $result = $modelo->insertar_generica($array_insertar);
    if ($result[0] == '1') {

        print json_encode(array("Exito", $_POST, $result));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $result));
        exit();
    }
}if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_actualizalo") {


    $contra = $modelo->encryptPass($_POST['pass']);

    $array_update = array(
        "table" => "tbl_empleado",
        "idempleado" => $_POST['llave_empleado'],
        "nombre" => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "correo" => $_POST['correo'],
        "pass" => $contra,
        "estado" => 1,
        "administrador" => $_POST['administrador'],
        "idempresa" => 1
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
        print json_encode(array("Exito", $_POST, $resultado[2][0],$passdes));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
} else if (isset($_POST['actualizar_estados']) && $_POST['actualizar_estados'] == "paso_admin") {

    $resultado = $modelo->actualizarAdmin("tbl_empleado",$_POST['id'],$_POST['administrador']);

    if ($resultado[0] == '1' && $resultado[4] > 0) {

        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {

        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
}else if (isset($_POST['actualizar_estados']) && $_POST['actualizar_estados'] == "paso_activo") {

    $estadoObtenido = 1;
    $resultadoId = $modelo->get_todos("tbl_empleado", "WHERE idempleado = '" . $_POST['id'] . "'");

    foreach ($resultadoId[2] as $row) {
        $estadoObtenido= $row['estado'];
    }

    if ($estadoObtenido==1) {
        $resultado = $modelo->actualizarActivo("tbl_empleado",$_POST['id'],0);
    } else {
        $resultado = $modelo->actualizarActivo("tbl_empleado",$_POST['id'],1);
    }
    
    

    if ($resultado[0] == '1' && $resultado[4] > 0) {

        print json_encode(array("Exito", $_POST, $resultado));
        exit();
    } else {

        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
}else if(isset($_POST['eliminar_datos']) && $_POST['eliminar_datos']=="si_eliminalo"){
    $array = array(
        "table"=>"tbl_empleado",
        "idempleado"=>$_POST['id']
    );
    $resultado = $modelo->eliminar_generica($array);
    if($resultado[0]=='1'){
        print json_encode(array("Exito",$_POST,$resultado));
        exit();

    }else {
        print json_encode(array("Error",$_POST,$resultado));
        exit();
    }
}else if(isset($_POST['empleados_registra']) && $_POST['empleados_registra']=="conteo"){

    $resultado = $modelo->contarRegistros("tbl_empleado");
    if ($resultado[0] == '1') {
        print json_encode(array("Exito", $_POST, $resultado[2][0]));
        exit();
    } else {
        print json_encode(array("Error", $_POST, $resultado));
        exit();
    }
}else if (isset($_POST['registro_duplicado']) && $_POST['registro_duplicado'] == "comprobar") {
    
    if ($_POST['paso']=="insert") {

        $resultado = $modelo->get_todos("tbl_empleado", "WHERE correo = '" . $_POST['correo'] . "'");

        if ($resultado[0] == '1' && $resultado[4] > 0) {
            print json_encode(array("Error", $_POST, $resultado));
            exit();
        } else {
            print json_encode(array("Exito", $_POST, $resultado));
            exit();
        } 
    } else {
        $encontro="";
        $sql = "SELECT * FROM tbl_empleado ORDER BY idempleado";
        $resultadoCorreo = $modelo->get_query($sql);
        foreach ($resultadoCorreo[2] as $row) {
            if ($_POST['correo'] == $row['correo'] && $_POST['id']!=$row['idempleado']) {
                $encontro=$row['correo'];
            }
        }

        if ($encontro=="") {
            print json_encode(array("Exito", $_POST, $resultado));
            exit();
        } else {
            print json_encode(array("Error", $_POST, $resultado));
            exit();
        } 
    }
    

    
}