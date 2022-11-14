<?php
date_default_timezone_set("America/Bogota");
require_once "../modelos/conexionVPN.php";
require_once "../modelos/conexion.php";
$serie = $_POST['serie'];
$colilla = $_POST['colilla'];
$idProducto = $_POST['idProducto'];
$idProducto = explode(" ",$idProducto);
$idProducto = $idProducto[0];
$fecha = date('Y-m-d');
$array = ['GANA_SIGA.SIGT_BALOTO', 'GANA_SIGA.SIGT_CHANCES_RASPA', 'GANA_SIGA.SIGT_RECAUDOS_MAESTRO'];
switch ($idProducto) {
    case 12072:
        //BALOTO
        $sql = "SELECT
        SERIE,
        COLILLA,
        VLR_TOTAL_RECAUDO
        FROM
            $array[0]
        WHERE
            SERIE = '$serie'
        AND
            COLILLA = '$colilla'
        AND
            TO_CHAR(FEC_VENTA, 'YYYY-MM-DD') = '$fecha'";
        $consult = oci_parse(ConexionVpn::getInstanciaVpn(), $sql);
        $result = oci_execute($consult);
        if($result){
            $sql2 = "SELECT * FROM REGISTER_PRODUCT WHERE SERIE = '$serie' AND COLILLA = '$colilla' AND IDE_PRODUCTO = $idProducto";
            $consult2 = oci_parse(Conex::conexion(), $sql2);
            $result2 = oci_execute($consult2);
            $row = oci_fetch_array($consult2);
            if(!empty($row)){
                echo "Registrado";
            }else{
                $array = oci_fetch_assoc($consult);
                $json = json_encode($array);
                print_r($json);
            }
        }
        break;
    case 24444:
        //RASPA
        $sql = "SELECT
        SERIE,
        COLILLA,
        VLR_APOSTADO
        FROM
            $array[1]
        WHERE
            SERIE = '$serie'
        AND
            COLILLA = '$colilla'
        AND
        TO_CHAR(FEC_VENTA, 'YYYY-MM-DD') = '$fecha'";

        $consult = oci_parse(ConexionVpn::getInstanciaVpn(), $sql);
        $result = oci_execute($consult);
        if($result){
            $sql2 = "SELECT * FROM REGISTER_PRODUCT WHERE SERIE = '$serie' AND COLILLA = '$colilla' AND IDE_PRODUCTO = $idProducto";
            $consult2 = oci_parse(Conex::conexion(), $sql2);
            $result2 = oci_execute($consult2);
            $row = oci_fetch_array($consult2);
            if(!empty($row)){
                echo "Registrado";
            }else{
                $array = oci_fetch_assoc($consult);
                $json = json_encode($array);
                print_r($json);
            }
        }
        break;
    case 6780:
        //CELSIA
        $sql = "SELECT
        SERIE,
        COLILLA,
        VLR_TOTAL_RECAUDO
        FROM
            $array[2]
        WHERE
            SERIE = '$serie'
        AND
            COLILLA = '$colilla'
        AND
        TO_CHAR(FEC_VENTA, 'YYYY-MM-DD') = '$fecha'";
        $consult = oci_parse(ConexionVpn::getInstanciaVpn(), $sql);
        $result = oci_execute($consult);
        if($result){
            $sql2 = "SELECT * FROM REGISTER_PRODUCT WHERE SERIE = '$serie' AND COLILLA = '$colilla' AND IDE_PRODUCTO = $idProducto";
            $consult2 = oci_parse(Conex::conexion(), $sql2);
            $result2 = oci_execute($consult2);
            $row = oci_fetch_array($consult2);
            if(!empty($row)){
                echo "Registrado";
            }else{
                $array = oci_fetch_assoc($consult);
                $json = json_encode($array);
                print_r($json);
            }
        }
        break;
}
?>