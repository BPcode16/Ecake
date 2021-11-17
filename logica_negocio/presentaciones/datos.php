<?php
$conexion = mysqli_connect('localhost', 'root', '', 'eco');
$i = 1;
$idproducto = $_POST['idproducto'];

$sql = "SELECT idproducto,
			 nombre
		from tbl_productos";

$result = mysqli_query($conexion, $sql);

$cadena = "
	<label>Presentaciones de:</label> 
			<select class='form-control form-select-lg mb-3' id='lista2' name='lista2' onchange='actualizar_tbl()'>
			<option value='-1'>Seleccione un producto</option>
			<option value='0'>Todos</option>";
while ($ver = mysqli_fetch_row($result)) {
	if($ver[0]==$idproducto && $idproducto>0) {
		$cadena = $cadena . '<option name='.$i.' selected value=' . $ver[0] . '>' . ($ver[1]) . '</option>';
	} else {
		$cadena = $cadena . '<option name='.$i.' value=' . $ver[0] . '>' . ($ver[1]) . '</option>';
	}
}

echo  $cadena . "</select>";
