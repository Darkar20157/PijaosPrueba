<?php
require "../modelos/conexion.php";
if(isset($_POST['ced'])){
    $ced = $_POST['ced'];
    validacion::ctrValidacionCedula($ced);

}elseif(isset($_POST['correo'])){
    $correo = $_POST['correo'];
    validacion::ctrValidarUsuario($correo);
}elseif(isset($_POST['rCed']) && isset($_POST['rCorreo'])){
    $cedula = $_POST['rCed'];
    $correo = $_POST['rCorreo'];
    $fexpedicion = $_POST['fexpedicion'];
    validacion::ctrRecuperacion($cedula, $fexpedicion, $correo);
}

//Validas si usuario y cedula ya esta registrados
class validacion{
    /*===============================
        Controlador
    =================================*/
    public static function ctrValidacionCedula($ced){
        $item1 = "CEDULA";
        $table = "REGISTER_USERS";
        validacion::mdlValidacionCedula($ced, $item1, $table);
    }
    public static function ctrValidarUsuario($correo){
        $item1 = "CORREO";
        $table = "REGISTER_USERS";
        validacion::mdlValidacionUsuario($correo, $item1, $table);
    }
    public static function ctrRecuperacion($cedula, $fexpedicion, $correo){
        $table = "REGISTER_USERS";
        $item1 = "CEDULA";
        $item2 = "CORREO";
        $item3 = "FECHA_EXP";
        validacion::mdlRecuperarContraseña($cedula, $fexpedicion, $correo, $table,
        $item1, $item2, $item3);
    }
    /*===============================
        Modelo
    =================================*/
    private static function mdlValidacionCedula($ced, $item1, $table){
        $sql = "SELECT ROWNUM AS $item1 FROM $table WHERE $item1 = $ced";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            while($row = oci_fetch_array($consult, OCI_ASSOC)){
                $ced = $row['CEDULA'];
            }
            if($ced == 1){
                echo "Incorrecto";
            }else{
                echo "Correcto";
            }
        }
    }
    private static function mdlValidacionUsuario($correo, $item1, $table){
        $sql = "SELECT ROWNUM AS $item1 FROM $table WHERE $item1 = '$correo'";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            while($row = oci_fetch_array($consult, OCI_ASSOC)){
                $correo = $row['CORREO'];
            }
            if(empty($correo)){
                echo "Correcto";
            }elseif($correo == 1){
                echo "Incorrecto";
            }
        }
    }
    private static function mdlRecuperarContraseña($cedula, $fexpedicion, $correo, $table,
    $item1, $item2, $item3){
        $sql = "SELECT * FROM $table WHERE $item1 = $cedula AND $item2 = '$correo' AND TO_CHAR($item3, 'YYYY-MM-DD') = '$fexpedicion'";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        $row = oci_fetch_assoc($consult);
        $fechaBD = $row['FECHA_EXP'];
        $fexpedicion = date('d/m/y', strtotime($fexpedicion));
        if($result){
            if($row['CEDULA'] == $cedula && $row['CORREO'] == $correo && $fechaBD == $fexpedicion){
                $row = json_encode($row);
                print_r($row);
            }else{
                die("Incorrecto");
            }
        }else{
            die("Incorrecto");
        }
    }
}
?>