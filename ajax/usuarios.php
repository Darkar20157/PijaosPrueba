<?php
require_once "../modelos/conexion.php";
if(isset($_POST['cedula'])){
    usuariosClientes::mdlEliminar();
}elseif(isset($_POST['ced'])){
    $ced = $_POST['ced'];
    usuariosClientes::mdlResetear($ced);
}
class usuariosClientes{
    public static function mdlEliminar(){
        echo $result = usuariosClientes::mdlEliminarUsuarios();
    }
    public static function mdlResetear($ced){
        $table = "REGISTER_USERS";
        $item1 = "CONFIRMACION";
        $item2 = "PASS";
        $item3 = "CEDULA";
        $result = usuariosClientes::mdlResetearUsuarios($ced, $table, $item1, $item2, $item3);
    }
    private static function mdlEliminarUsuarios(){
        $ced = $_POST['cedula'];
        $item1 = $_POST['item1'];
        $item2 = $_POST['item2'];
        $sql = "DELETE FROM $item1 WHERE $item2 = $ced";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            return "ok";
        }
    }
    private static function mdlResetearUsuarios($ced, $table, $item1, $item2, $item3){
        $newPass = crypt($ced, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $sql = "UPDATE $table SET $item1 = 0, $item2 = '$newPass'
        WHERE $item3 = $ced";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            echo "ok";
        }else{
            echo "error";
        }
    }
}

?>