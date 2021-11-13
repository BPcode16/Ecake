<?php
$conexion = mysqli_connect('localhost', 'root', '', 'eco');
$departamento = $_POST['departamento'];
$idmunicipio = $_POST['idmunicipio'];
$i = 0;
$selected = "";

$sql = "SELECT idmunicipio,
			 iddepartamento,
			 nombre,
			 costoenvio
		from tbl_municipio 
		where iddepartamento='$departamento'";

$result = mysqli_query($conexion, $sql);

$cadena = "
	<label>Municipio </label> 
			<select class='form-control form-select-lg mb-3' id='lista2' name='lista2'>
			<option value='0'>Todos</option>";
while ($ver = mysqli_fetch_row($result)) {

	if($ver[0] == $idmunicipio) {
		$selected = "selected";
	} else {
		$selected = "";
	}

	$cadena = $cadena . '<option '.$selected.' name='.$i.' value=' . $ver[0] . '>' . ($ver[2]) . '</option>';
}

echo  $cadena . "</select>";
