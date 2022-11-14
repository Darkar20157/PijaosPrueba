<?php

class ctrValidarPuntosUsuarios{
    public static function validacion($cedula){
        $item1 = "CS.IDE";
        $item2 = "CS.IDENTIFICACION_CLIENTE";
        $item3 = "RU.NOMBRES";
        $item4 = "RU.APELLIDOS";
        $item5 = "CS.VLR_RECAUDO_TOTAL";
        $item6 = "CS.IDE_TIPOPRODUCTO";
        $item7 = "CS.IDE_PRODUCTO";
        $item8 = "CS.ESTADO";
        $item9 = "RU.CEDULA";
        $item10 = "CS.DES_PRODUCTO";
        $table1 = "GANAPOINTS.CUSTOMER_SALES";
        $table2 = "GANAPOINTS.REGISTER_USERS";
        $respuesta = mdlValidarPuntos::consultPuntos($cedula, $item1, $item2, $item3, $item4, $item5, $table1,
        $table2, $item6, $item7, $item8, $item9, $item10);
        return $respuesta;
    }
    public static function almacenarValidacion($respuesta){
        $item1 = "CEDULA";
        $item2 = "PUNTOS";
        $table1 = "DETAIL_POINTS";
        $item3 = "NOMBRES";
        $item4 = "ID_PRODUCTO";
        $item5 = "NOM_PRODUCTO";
        $item6 = "PUNTOS";
        $item7 = "VALOR_RECAUDO";
        $item8 = "FECHA_HORA";
        $table2 = "PUNTOS_PRODUCTO";
        $respuesta = mdlValidarPuntos::existencia($item1, $item2, $table1, $respuesta , $item3, $item4, $item5,
        $item6, $item7, $item8, $table2);
    }
}
?>