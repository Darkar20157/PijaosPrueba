<?php
class mdlValidarPuntos{
    public static function consultPuntos($cedula, $item1, $item2, $item3, $item4, $item5, $table1,
    $table2, $item6, $item7, $item8, $item9, $item10){
        $sql = "SELECT
            $item1,
            $item2,
            $item3,
            $item4,
            $item5,
            $item6,
            $item7,
            $item10
        FROM
            $table1 CS
            INNER JOIN $table2 RU ON $item2 = $item9
        WHERE
            $item8 = 1
        AND
            $item2 = $cedula";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            $i = 0;
            while($row = oci_fetch_assoc($consult)){
                $array[$i] = array("IDE" => $row['IDE'], "IDENTIFICACION_CLIENTE" => $row['IDENTIFICACION_CLIENTE'],
                "NOMBRES" => $row['NOMBRES'], "APELLIDOS" => $row['APELLIDOS'], "VLR_RECAUDO_TOTAL" => $row['VLR_RECAUDO_TOTAL'],
                "IDE_TIPOPRODUCTO" => $row['IDE_TIPOPRODUCTO'], "IDE_PRODUCTO" => $row['IDE_PRODUCTO'], 
                "DES_PRODUCTO" => $row['DES_PRODUCTO']);
                $i = $i + 1;
            }
            if(!empty($array)){
                for ($i=0; $i < count($array); $i++) { 
                    $ideProducto = $array[$i]['IDE_TIPOPRODUCTO'];
                    switch ($ideProducto){
                        //CHANCE
                        case 1:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = (71 * $valor) / 100;
                            $generadorPuntos = ($generadorPuntos * 0.61) / 100;
                            $generadorPuntos = $generadorPuntos / 10;
                            //$generadorPuntos = ceil($generadorPuntos);
                            break;
                        //LOTERIAS
                        case 2:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = ($valor * 20) / 100;
                            $generadorPuntos = ($generadorPuntos * 0.61) / 100;
                            $generadorPuntos = $generadorPuntos / 10;
                            //$generadorPuntos = ceil($generadorPuntos);
                            break;
                        //ACUMULADO
                        case 3:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = ($valor * 71) / 100;
                            $generadorPuntos = ($generadorPuntos * 0.61) / 100;
                            $generadorPuntos = $generadorPuntos / 10;
                            //$generadorPuntos = ceil($generadorPuntos);
                            break;
                        //RECAUDOS
                        case 5:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = 1;
                            break;
                        //RECARGAS EN LINEA
                        case 6:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = (7 * $valor) / 100;
                            $generadorPuntos = ($generadorPuntos * 0.61) / 100;
                            $generadorPuntos = $generadorPuntos / 10;
                            //$generadorPuntos = ceil($generadorPuntos);
                            break;
                        //ASTRO
                        case 7:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = (19 * $valor) / 100;
                            $generadorPuntos = ($generadorPuntos * 0.61) / 100;
                            $generadorPuntos = $generadorPuntos / 10;
                            //$generadorPuntos = ceil($generadorPuntos);
                            break;
                        
                        //PROMOCIONALES
                        case 22:
                            $valor = $array[$i]['VLR_RECAUDO_TOTAL'];
                            $generadorPuntos = (71 * $valor) / 100;
                            $generadorPuntos = ($generadorPuntos * 0.61) / 100;
                            $generadorPuntos = $generadorPuntos / 10;
                            //$generadorPuntos = ceil($generadorPuntos);
                            break;
                    }
                    $ide = $array[$i]['IDE'];
                    $sql2 = "UPDATE CUSTOMER_SALES SET ESTADO = 0 WHERE IDE = $ide";
                    $consult2 = oci_parse(Conex::conexion(), $sql2);
                    $result2 = oci_execute($consult2);
                    $array3[$i] = array("CED" => $cedula, "NOM" => $array[$i]['NOMBRES'], "APE" => $array[$i]['APELLIDOS'],
                    "PUN" => $generadorPuntos, "VLR" => $array[$i]['VLR_RECAUDO_TOTAL'], "IDP" => $array[$i]['IDE_PRODUCTO'],
                    "NOMP" => $array[$i]['DES_PRODUCTO']);
                }
                return $array3;
            }else{
                return false;
            }
        }
    }
    public static function existencia($item1, $item2, $table1, $respuesta , $item3, $item4, $item5,
    $item6, $item7, $item8, $table2){
        $puntosTotales = 0;
        for ($i=0; $i < count($respuesta); $i++) {

            $ced = $respuesta[$i]['CED'];
            $nom = $respuesta[$i]['NOM']." ".$respuesta[$i]['APE'];
            $id_producto = $respuesta[$i]['IDP'];
            $nom_producto = $respuesta[$i]['NOMP'];
            $puntosDecimal = (float)$respuesta[$i]['PUN'];
            $puntosDecimal = number_format($puntosDecimal,2,",","");
            $valor_recaudo = $respuesta[$i]['VLR'];

            $sql = oci_parse(Conex::conexion(), "INSERT INTO $table2($item1, $item3, $item4, $item5, $item6, 
            $item7, $item8) VALUES(:ced, :nom, :idp, :nomp, :pun, :vlr, systimestamp)");
            
            oci_bind_by_name($sql, ":ced", $ced);
            oci_bind_by_name($sql, ":nom", $nom);
            oci_bind_by_name($sql, ":idp", $id_producto);
            oci_bind_by_name($sql, ":nomp", $nom_producto);
            oci_bind_by_name($sql, ":pun", $puntosDecimal);
            oci_bind_by_name($sql, ":vlr", $valor_recaudo);

            $result1 = oci_execute($sql);
            if($result1){
                $string = (string)$puntosDecimal;
                $string = str_replace(',', '.', $string);
                $puntosTotales = (float)$string;
                $puntosTotales = (float)$puntosTotales + (float)$puntosDecimal;
                /////////////////////////////////////////////////////////////////
                $cedula = $respuesta[0]['CED'];
                $puntos = $puntosTotales;
                $sql = "SELECT * FROM $table1 WHERE $item1 = $cedula";
                $consult = oci_parse(Conex::conexion(), $sql);
                $result = oci_execute($consult);
                while($row = oci_fetch_array($consult, OCI_ASSOC)){
                    $existencia = $row['CEDULA'];
                    $misPuntos = (string)$row['PUNTOS'];
                    echo $misPuntosString = str_replace(',', '.', $misPuntos);
                    $misPuntosString = (float)$misPuntosString;
                }
                if(empty($existencia)){
                    oci_free_statement($consult);
                    $sql = "INSERT INTO $table1($item1, $item2) VALUES($cedula, $puntos)";
                    $consult = oci_parse(Conex::conexion(), $sql);
                    $result = oci_execute($consult);
                    if($result){
                        oci_free_statement($consult);
                        oci_close(Conex::conexion());
                    }
                }else{
                    $puntos_totales = (float)$misPuntosString + (float)$puntos;
                    $puntos_totales = number_format($puntos_totales,2,",","");
                    $sql = "UPDATE $table1 SET $item2 = '$puntos_totales' WHERE $item1 = $cedula";
                    $consult = oci_parse(Conex::conexion(), $sql);
                    $result = oci_execute($consult);
                }
            }
        }
    }
}

?>