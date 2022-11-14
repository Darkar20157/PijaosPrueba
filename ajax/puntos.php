<?php
require_once "../modelos/conexion.php";
if(isset($_POST['idProducto']) && isset($_POST['ced'])){
    $correo = $_POST['correo'];
    $respuesta1 = UsuariosPuntos::mdlConsultar();
    $respuesta2 = UsuariosPuntos::mdlConsultarId();
    $valor = $respuesta2['valor_puntos'];
    if($respuesta1 == "Incorrecto" || $respuesta2 == "Incorrecto"){
        echo "Incorrecto";
    }elseif($respuesta1 < $valor){
        echo "no ok";
    }elseif($respuesta1 >= $valor){
        $array = array(
            "ced" => $_POST['ced'],
            "nom" => $_POST['nom'],
            "puntos" => $respuesta1,
            "id" => $_POST['idProducto'],
            "id_producto" => $respuesta2['id_producto'],
            "nom_producto" => $respuesta2['nom_producto'],
            "valor_pesos" => $respuesta2['valor_pesos'],
            "valor_puntos" => $respuesta2['valor_puntos'],
            "correo" => $correo);
        $array = json_encode($array);
        print_r($array);
    }
}elseif(isset($_POST['ced'])){
    $respuesta = UsuariosPuntos::mdlConsultar();
    echo $respuesta;
}
class UsuariosPuntos{
    //Consultamos puntos
    public static function mdlConsultar(){
        $table = "DETAIL_POINTS";
        $item1 = "CEDULA";
        $ced = $_POST['ced'];
        $respuesta1 = UsuariosPuntos::mdlConsultarPuntos($table, $item1, $ced);
        if($respuesta1 == "Incorrecto"){
            return $respuesta1;
        }else{
            while($row = oci_fetch_array($respuesta1, OCI_ASSOC)){
                if($row['PUNTOS'] < 1){
                    $misPuntos = 0;
                    return $misPuntos;
                }else{
                    $misPuntos = (string)$row['PUNTOS'];
                    $misPuntos = str_replace(',', '.', $misPuntos);
                    $misPuntos = (float)$misPuntos;
                    $misPuntos = round($misPuntos);
                    return $misPuntos;
                }
            }
        }
    }
    //BD CONSULTAR PUNTOS
    private static function mdlConsultarPuntos($table, $item1, $ced){
        $sql = "SELECT * FROM $table WHERE $item1 = $ced";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            return $consult;
        }else{
            return "Incorrecto";
        }
    }
    //Consultamos si hay productos
    public static function mdlConsultarId(){
        $table = "PROMO_PRODUCT";
        $item = "ID";
        $id = $_POST['idProducto'];
        $respuesta2 = UsuariosPuntos::mdlConsultarIdProducto($table, $item, $id);
        if($respuesta2 == "Incorrecto"){
            return false;
        }else{
            while($row = oci_fetch_array($respuesta2, OCI_ASSOC)){
                $idProducto = $row['ID_PRODUCTO'];
                $nomProducto = $row['NOM_PRODUCTO'];
                $valorPesos = $row['VALOR_PESOS'];
                $valorPuntos = $row['VALOR_PUNTOS'];
            }
            $array = array(
                "id_producto" => $idProducto,
                "nom_producto" => $nomProducto,
                "valor_pesos" => $valorPesos,
                "valor_puntos" => $valorPuntos);
            return $array;
        }
    }
    private static function mdlConsultarIdProducto($table, $item, $id){
        $sql = "SELECT * FROM $table WHERE $item = $id";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            return $consult;
        }else{
            return "Incorrecto";
        }
    }
}
?>