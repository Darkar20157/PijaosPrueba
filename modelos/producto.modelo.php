<?php
require_once "conexion.php";
require_once "conexionVPN.php";
class ModeloProducto{
    public static function mdlRegistrarProducto($serie, $colilla, $idProducto, $nomProducto, 
    $cedula, $estado, $puntos, $valor){
        $puntos = number_format($puntos, 2, ',', '');
        $sql = oci_parse(Conex::conexion(),"INSERT INTO REGISTER_PRODUCT (SERIE, COLILLA, IDE_PRODUCTO, NOM_PRODUCTO,
        CEDULA, FECHA, ESTADO, PUNTOS, VALOR) VALUES(:ser, :col, :idP, :nomP, :ced, sysdate, :est, :pun, :vlr)");
        oci_bind_by_name($sql, ":ser", $serie);
        oci_bind_by_name($sql, ":col", $colilla);
        oci_bind_by_name($sql, ":idP", $idProducto);
        oci_bind_by_name($sql, ":nomP", $nomProducto);
        oci_bind_by_name($sql, ":ced", $cedula);
        oci_bind_by_name($sql, ":est", $estado);
        oci_bind_by_name($sql, ":pun", $puntos);
        oci_bind_by_name($sql, ":vlr", $valor);
        $result = oci_execute($sql);
        if($result){
            return "Correcto";
        }else{
            return "Incorrecto";
        }
    }
    public static function mdlInsertarPuntos($cedula, $puntos){
        $sql = "SELECT * FROM DETAIL_POINTS WHERE CEDULA = $cedula";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        $row = oci_fetch_assoc($consult);
        $puntosAnteriores = (string)$row['PUNTOS'];
        $puntosAnteriores = str_replace(',', '.', $puntosAnteriores);
        $puntos = number_format($puntos, 2, ".", "");
        $puntosTotales = $puntos + $puntosAnteriores;
        $puntosTotales = str_replace(".",",",$puntosTotales);
        $sql2 = "UPDATE DETAIL_POINTS SET PUNTOS = '$puntosTotales' WHERE CEDULA = $cedula";
        $consult2 = oci_parse(Conex::conexion(), $sql2);
        $result2 = oci_execute($consult2);
        if($result2){
            return "Correcto";
        }else{
            return "Incorrecto";
        }
    }
    public static function mdlConsultarProducto($table, $item1, $item2){
        $sql = "SELECT * FROM $table WHERE $item1 = '$item2'";
        $consult = oci_parse(ConexionVpn::getInstanciaVpn(), $sql);
        $result = oci_execute($consult);
        if($result){
            return $consult;
        }else{
            return "error";
        }
    }
}
?>