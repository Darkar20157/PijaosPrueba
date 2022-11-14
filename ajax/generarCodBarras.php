<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "../mailer/src/Exception.php";
require "../mailer/src/PHPMailer.php";
require "../mailer/src/SMTP.php";
//Generar codigo de barras
require_once "../modelos/conexion.php";
require_once "../modelos/conexionVPN.php";
date_default_timezone_set("America/Bogota");
$random = rand(100000, 999999);
$cedula = $_POST['ced'];
$nombre = $_POST['nom'];
$id = $_POST['id'];
$ide_producto = $_POST['id_producto'];
$nomProducto = $_POST['nom_producto'];
$valor_pesos = $_POST['valor_pesos'];
$puntosProducto = $_POST['valor_puntos'];
$correo = $_POST['correo'];
//GENERAMOS CODIGO DE BARRAS SIN QUE SE REPITA
$respuesta = GenerarCodigo::generarCodigoBarras($random, $cedula, $puntosProducto, $id, $nomProducto,
$puntosProducto);
$respuesta3 = GenerarCodigo::preparandoRedencion($respuesta, $cedula, $nombre, $id, $ide_producto, $nomProducto, 
$valor_pesos, $puntosProducto, $correo);

class GenerarCodigo{
    /*===============================
    Consultamos Codigo Barras Existe
    =================================*/
    public static function generarCodigoBarras($random, $cedula, $puntosCliente, $idProducto, $nomProducto,
    $puntosProducto){
        $table = "GANA_SIGA.SIGT_OBLIG_PAGOS_GENERICOS";
        $item0 = "IDE_PRODUCTO";
        $item1 = "NUM_DOCUMENTO";
        $item2 = "PAGADA";
        $pag = "N";
        $ide = 25667;
        $respuesta2 = GenerarCodigo::consultarCodigoBarras($table, $item0, $item1, $item2, $pag,
        $ide);
        while($row = oci_fetch_array($respuesta2, OCI_ASSOC)){
            while($random == $row['NUM_DOCUMENTO']){
                $random = rand(100000, 999999);
            }
        }
        return $random;
    }
    private static function consultarCodigoBarras($table, $item0, $item1, $item2, $pag, $ide){
        $sql = "SELECT $item1, $item2 FROM $table WHERE $item2 = '$pag' AND 
        IDE_PRODUCTO = $ide";
        $consult = oci_parse(ConexionVpn::getInstanciaVpn(), $sql);
        $result = oci_execute($consult);
        if($result){
            return $consult;
        }
    }
    /*==================================
    Preparamos la redencion
    ====================================*/
    public static function preparandoRedencion($respuesta, $cedula, $nombre, $id, $ide_producto, $nomProducto, 
    $valor_pesos, $puntosProducto, $correo){
        $sql3 = "SELECT MAX(IDE_OBLIGACION) AS ID FROM GANA_SIGA.SIGT_OBLIG_PAGOS_GENERICOS";
        $consult3 = oci_parse(ConexionVpn::getInstanciaVpn(), $sql3);
        $result3 = oci_execute($consult3);
        $ultFila = oci_fetch_assoc($consult3);
        /*========================================================================================*/
        $table = "GANA_SIGA.SIGT_OBLIG_PAGOS_GENERICOS";
        $item0 = 'IDE_OBLIGACION';
        $item1 = "IDE_PRODUCTO";
        $item2 = "NUM_DOCUMENTO";
        $item3 = "NOMBRE_CLIENTE";
        $item4 = "PERIODO_PAGO";
        $item5 = "NOMBRE_PAGO";
        $item6 = "VLR_PAGO";
        $item7 = "CAMPO_ADICIONAL_UNO";
        $item8 = "CAMPO_ADICIONAL_DOS";
        $item9 = "FEC_CARGA";
        $item10 = "PAGADA";
        $item11 = "CAMPO_ADICIONAL_TRES";
        $item12 = "CAMPO_ADICIONAL_CUATRO";
        //==========================================================================================//
        $table2 = "PETITIONS_POINTS";
        $item13 = "IDE_OBLIGACION";
        $item15 = "COD_BARRAS";
        $item16 = "CEDULA_CLIENTE";
        $item17 = "NOM_CLIENTE";
        $item18 = "VALOR_PAGO";
        $item19 = "PUNTOS_REDIMIDOS";
        $item20 = "ID_PRODUCTO_JUGADO";
        $item21 = "NOM_PRODUCTO";
        $item22 = "FEC_REDENCION";
        $item23 = "ESTADO";
        /*========================================================================================*/
        $ultFila = $ultFila['ID'] + 1;
        $ideProducto = 25667;
        $fecha = date('Y-m-d H:i:s');
        $fecha_limite = date("Y-m-d", strtotime($fecha. '+1 days'));
        $nombrePago = "PAGOS PUNTOS GANAGANA";
        $estado = 'N';
        //Insertamos en la tabla
        $respuesta4 = GenerarCodigo::insertarRedencion($table, $item0, $item1, $item2, $item3, $item4, $item5, 
        $item6, $item7, $item8, $item9, $item10, $item11, $item12, $table2, $item13, $item15, $item16, 
        $item17, $item18, $item19, $item20, $item21, $item22, $item23, $ultFila, $ideProducto, $respuesta, 
        $nombre, $fecha_limite, $nombrePago, $valor_pesos, $puntosProducto, $cedula, $ide_producto, $nomProducto, 
        $fecha, $estado);
        
        if($respuesta4 == "Correcto"){
            $table = "DETAIL_POINTS";
            $item1 = "CEDULA";
            $item2 = "PUNTOS";
            //Descontamos los puntos al usuario
            $respuesta5 = GenerarCodigo::descontarPuntos($table, $item1, $item2, $cedula, $puntosProducto);
            if($respuesta5 == "Correcto"){
                $table = "PROMO_PRODUCT";
                $item1 = "CANTIDAD";
                $item2 = "ID";
                $respuesta6 = GenerarCodigo::descontarCantidad($id, $table, $item1, $item2);
                if($respuesta6 == "Correcto"){
                    try{
                        $mail = new PHPMailer(true);
                        //Server settings
                        $mail->SMTPDebug = 0;    //Enable verbose debug output
                        $mail->isSMTP();        //Send using SMTP
                        $mail->Host       = 'smtp.office365.com'; //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;   //Enable SMTP authentication
                        $mail->Username   = 'ganaganapuntos@ganagana.com.co';  //SMTP username
                        $mail->Password   = 'Ganagana2022*';   //SMTP password
                        $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
                        $mail->Port       = 587;
                        
                        //Recipients
                        $mail->setFrom('ganaganapuntos@ganagana.com.co', 'Puntos GanaGana');
                        $mail->addAddress($correo, $nombre);     //Add a recipient
    
                        //Content
                        $mail->isHTML(true);  //Set email format to HTML
                        $mail->Subject = 'Redencion de Puntos';
                        $mail->Body = 'Haz redimido: '.$puntosProducto.' puntos, en PUNTOS GANAGANA';
                        $mail->send();
                        oci_close(ConexionVpn::getInstanciaVpn());
                        echo "Correcto";
                    }catch(Exception $e){
                        echo "Incorrecto";
                    }
                }else{
                    echo "Incorrecto";
                }
            }else{
                echo "Incorrecto";
            }
        }else{
            echo "Incorrecto";
        }
    }
    //Insertar BD VPN y Enviar un correo de aviso
    private static function insertarRedencion($table, $item0, $item1, $item2, $item3, $item4, $item5, 
    $item6, $item7, $item8, $item9, $item10, $item11, $item12, $table2, $item13, $item15, $item16, 
    $item17, $item18, $item19, $item20, $item21, $item22, $item23, $ultFila, $ideProducto, $respuesta, 
    $nombre, $fecha_limite, $nombrePago, $valor_pesos, $puntosProducto, $cedula, $ide_producto, $nomProducto, 
    $fecha, $estado){

        $sql = oci_parse(ConexionVpn::getInstanciaVpn(), 
        "INSERT INTO $table($item0, $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, 
        $item10, $item11, $item12) VALUES(:id, :idp, :nd, :nom, TO_DATE(:pp, 'YYYY-MM-DD HH24:MI:SS'), :nomp, 
        :vlr, :ca1, :ca2, TO_TIMESTAMP(:fc, 'YYYY-MM-DD HH24:MI:SS'), :pg, :ca3, :ca4)");
        
        oci_bind_by_name($sql, ':id', $ultFila);
        oci_bind_by_name($sql, ':idp', $ideProducto);
        oci_bind_by_name($sql, ':nd', $respuesta);
        oci_bind_by_name($sql, ':nom', $nombre);
        oci_bind_by_name($sql, ':pp', $fecha_limite);
        oci_bind_by_name($sql, ':nomp', $nombrePago);
        oci_bind_by_name($sql, ':vlr', $valor_pesos);
        oci_bind_by_name($sql, ':ca1', $puntosProducto);
        oci_bind_by_name($sql, ':ca2', $respuesta);
        oci_bind_by_name($sql, ':ca3', $cedula);
        oci_bind_by_name($sql, ':ca4', $nomProducto);
        oci_bind_by_name($sql, ':fc', $fecha);
        oci_bind_by_name($sql, ':pg', $estado);

        $result = oci_execute($sql);

        if($result){
            $fecha_registro = date('Y-m-d');
            $sql2 = oci_parse(Conex::conexion(), 
            "INSERT INTO $table2($item13, $item15, $item16, $item17, $item18, $item19, $item20, $item21,
            $item22, $item23) VALUES(:ibg, :cb, :cc, :nomc, :vlr, :pun, :ipj, :nomp, 
            TO_DATE(:fec, 'YYYY-MM-DD'), :est)");

            oci_bind_by_name($sql2, ':ibg', $ultFila);
            oci_bind_by_name($sql2, ':cb', $respuesta);
            oci_bind_by_name($sql2, ':cc', $cedula);
            oci_bind_by_name($sql2, ':nomc', $nombre);
            oci_bind_by_name($sql2, ':vlr', $valor_pesos);
            oci_bind_by_name($sql2, ':pun', $puntosProducto);
            oci_bind_by_name($sql2, ':ipj', $ide_producto);
            oci_bind_by_name($sql2, ':nomp', $nomProducto);
            oci_bind_by_name($sql2, ':fec', $fecha_registro);
            oci_bind_by_name($sql2, ':est', $estado);

            $result2 = oci_execute($sql2);

            if($result2){
                return "Correcto";
            }else{
                die("Incorrecto");
            }
        }else{
            echo die("Incorrecto");
        }
    }
    /*=========================
    BD se descuentan los puntos
    ===========================*/
    private static function descontarPuntos($table, $item1, $item2, $cedula, $puntosProducto){
        $sql = "SELECT $item2 FROM $table WHERE $item1 = $cedula";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        while($row = oci_fetch_array($consult, OCI_ASSOC)){
            $puntosActuales = (string)$row['PUNTOS'];
            $puntosActuales = str_replace(',', '.', $puntosActuales);
        }
        $puntosProducto = (string)$puntosProducto;
        $puntosTotales = $puntosActuales - $puntosProducto;
        $puntosTotales = (float)$puntosTotales;
        $sql2 = "UPDATE $table SET $item2 = $puntosTotales WHERE $item1 = $cedula";
        $consult2 = oci_parse(Conex::conexion(), $sql2);
        $result2 = oci_execute($consult2);
        if($result2){
            return "Correcto";
        }else{
            die("Incorrecto");
        }
    }
    private static function descontarCantidad($id, $table, $item1, $item2){
        $sql = "SELECT $item1 FROM $table WHERE $item2 = $id";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        while($row = oci_fetch_array($consult, OCI_ASSOC)){
            $cantidadAnterior = $row['CANTIDAD'];
        }
        $cantidadActual = $cantidadAnterior - 1;
        $sql2 = "UPDATE $table SET $item1 = $cantidadActual WHERE $item2 = $id";
        $consult = oci_parse(Conex::conexion(), $sql2);
        $result = oci_execute($consult);
        if($result){
            return "Correcto";
        }else{
            return "Incorrecto";
        }
    }
}
?>