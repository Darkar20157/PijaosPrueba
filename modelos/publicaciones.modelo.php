<?php
class mdlPublicaciones{
    public static function consultarPublicaciones($table, $empieza, $por_pagina){
        $sql = "WITH PAGINADOR AS (
            SELECT
            ROWNUM AS FILA,
            FOTO,
            TITULO,
            VALOR_PUNTOS,
            FECHA_INICIAL,
            FECHA_FINAL,
            CANTIDAD,
            ESTADO,
            DESCRIPCION
            FROM
            PROMO_PRODUCT
            ORDER BY FILA ASC
        )
        SELECT * FROM PAGINADOR WHERE FILA >= $empieza AND FILA <= $por_pagina";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            return $consult;
        }else{
            return "No se encontro ninguna publicacion";
        }
    }
}
?>