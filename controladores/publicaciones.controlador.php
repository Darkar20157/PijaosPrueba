<?php
class ctrPublicaciones{
    public static function mostrarPublicaciones($empieza, $por_pagina){
        $table = "PROMO_PRODUCT";
        $respuesta = mdlPublicaciones::consultarPublicaciones($table, $empieza, $por_pagina);
        return $respuesta;
    }
}

?>