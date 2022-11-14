<?php
require_once "../modelos/conexionServer.php";
$activos = $_POST['activo'];
$sql = "SELECT * FROM MAET_SITIOSVENTA WHERE ACTIVO = $activos";
$consult = oci_parse(Conex::conexionServer(), $sql);
$result = oci_execute($consult);
$i = 0;
while($row = oci_fetch_assoc($consult)){
    $cy = str_replace(',', '.',$row['CX']);
    $cx = str_replace(',', '.',$row['CY']);
    $array[$i] = array("CX" => $cx, "CY" => $cy);
    $i = $i + 1;
}
$json = json_encode($array);
print_r($json);
?>