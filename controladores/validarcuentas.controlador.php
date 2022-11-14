<?php
class ControladorValidarCuentas{
    static public function ctrValidarCuenta(){
        if(isset($_POST['validar'])){
            $table = "REGISTER_USERS";
            $item1 = "ESTADO";
            $item2 = "CEDULA";
            $ced = $_POST['ced'];
            $estado = 2;
            $response = ModeloValidarCuentas::mdlValidarCuentas($table, $item1, $item2, $ced, $estado);
        }
    }
    static public function ctrConsultUsuario($ced){
        $table = "REGISTER_USERS";
        $item1 = "CEDULA";
        $response = ModeloValidarCuentas::mdlConsultCuenta($table, $item1, $ced);
        return $response;
    }
}
?>