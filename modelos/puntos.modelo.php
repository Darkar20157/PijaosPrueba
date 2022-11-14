<?php
include_once "conexionVPN.php";
class ModeloPuntos{
    public static function mdlSubirPromocionales($nombreFoto, $idProducto, $nomProducto, $titulo, $puntos, 
    $fechaInicial, $fechaFinal, $cantidad, $estado, $descripcion, $table){
        if(!empty($titulo) && !empty($descripcion)){
            $sql = oci_parse(Conex::conexion(),"INSERT INTO $table(FOTO, VALOR_PESOS, VALOR_PUNTOS, FECHA_INICIAL,
            FECHA_FINAL, CANTIDAD, ESTADO, DESCRIPCION, ID_PRODUCTO, NOM_PRODUCTO) VALUES(:fot, :tit, :vp, 
            TO_DATE(:fi, 'YYYY-MM-DD HH24:MI:SS'), TO_DATE(:ff, 'YYYY-MM-DD HH24:MI:SS'), 
            :cant, :est, :descrip, :idP, :nomP)");

            oci_bind_by_name($sql, ":fot", $nombreFoto);
            oci_bind_by_name($sql, ":tit", $titulo);
            oci_bind_by_name($sql, ":vp", $puntos);
            oci_bind_by_name($sql, ":fi", $fechaInicial);
            oci_bind_by_name($sql, ":ff", $fechaFinal);
            oci_bind_by_name($sql, ":cant", $cantidad);
            oci_bind_by_name($sql, ":est", $estado);
            oci_bind_by_name($sql, ":descrip", $descripcion);
            oci_bind_by_name($sql, ":idP", $idProducto);
            oci_bind_by_name($sql, ":nomP", $nomProducto);

            $result = oci_execute($sql);
            if($result){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }
    public static function mdlSubirPromociones($nombreFoto, $titulo, 
    $puntos, $fechaInicial, $fechaFinal, $estado, $descripcion, $table,
    $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8){
        if(!empty($titulo) && !empty($descripcion)){
            $sql = oci_parse(Conex::conexion(),"INSERT INTO $table($item1, $item2, 
            $item3, $item4, $item5, $item6, $item7, $item8) VALUES(:fot, :tit, :descr, 
            TO_DATE(:fi, 'YYYY-MM-DD HH24:MI:SS'), TO_DATE(:ff, 'YYYY-MM-DD HH24:MI:SS'),
            :est, :pun, sysdate)");

            oci_bind_by_name($sql, ":fot", $nombreFoto);
            oci_bind_by_name($sql, ":tit", $titulo);
            oci_bind_by_name($sql, ":descr", $descripcion);
            oci_bind_by_name($sql, ":fi", $fechaInicial);
            oci_bind_by_name($sql, ":ff", $fechaFinal);
            oci_bind_by_name($sql, ":est", $estado);
            oci_bind_by_name($sql, ":pun", $puntos);

            echo $result = oci_execute($sql);
            if($result){
                return true;
            }else{
                return false;
            }

        }else{

        }
    }
    public static function mdlMostrarPromocionalesClientes($table, $item1, $item2, $item3){
        $sql = "SELECT * FROM $table WHERE $item1 = 1 AND $item2 <= sysdate AND $item3 >= sysdate ORDER BY ID ASC";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        return $consult;
    }
    /*=======================================
        PROMOCIONES
    =========================================*/
    public static function mdlMostrarPromocionesClientes($table, $item1, $item2, $item3, $ced){
        $sql = "SELECT * FROM DESAFIOS WHERE CEDULA = $ced";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        $row = oci_fetch_assoc($consult);
        if(empty($row['CEDULA'])){
            $sql = "WITH CONSULTA_COMPLETA1 AS(
                SELECT * FROM $table WHERE $item1 = 1 AND $item2 <= SYSDATE AND $item3 >= SYSDATE
            ),CONSULTA_COMPLETA2 AS(
                SELECT * FROM DESAFIOS WHERE CEDULA = $ced
            )
            SELECT * FROM CONSULTA_COMPLETA1";
            $consult = oci_parse(Conex::conexion(), $sql);
            $result = oci_execute($consult);
            return $consult;
        }else{
            $sql = "WITH CONSULTA_COMPLETA1 AS(
                SELECT * FROM $table WHERE $item1 = 1 AND $item2 <= SYSDATE AND $item3 >= SYSDATE
            ),CONSULTA_COMPLETA2 AS(
                SELECT * FROM DESAFIOS WHERE CEDULA = $ced
            )
            SELECT * FROM CONSULTA_COMPLETA1, CONSULTA_COMPLETA2";
            $consult = oci_parse(Conex::conexion(), $sql);
            $result = oci_execute($consult);
            return $consult;
        }
    }
    /*=======================================
        PROMOCIONES
    =========================================*/
    //////////////////////////////////////////
    /*=======================================
        ULTIMO CODIGO
    =========================================*/
    public static function mdlConsultarUltimoCod($table, $item1, $item2, $item3){
        $sql = "SELECT *
        FROM(
            SELECT *
            FROM $table
            ORDER BY $item1 DESC
            )
        WHERE ROWNUM <= 6
        AND $item2 = $item3";
        $consult = oci_parse(ConexionVpn::getInstanciaVpn(), $sql);
        $result = oci_execute($consult);
        return $consult;
    }
}

?>