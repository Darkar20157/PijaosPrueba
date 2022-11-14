<?php
//PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "mailer/src/Exception.php";
require "mailer/src/PHPMailer.php";
require "mailer/src/SMTP.php";
class ModeloUsuarios{
  /*=============================================
  MOSTRAR USUARIOS
  =============================================*/
  public static function MdlMostrarUsuarios($tabla, $item, $valor){
    if ($valor != ""){
      $sql = "SELECT * FROM $tabla WHERE $item = '$valor'";
      $consult = oci_parse(Conex::conexion(), $sql);
      $result = oci_execute($consult);
      $respuesta = oci_fetch_assoc($consult);
      if(empty($respuesta['CORREO']) || empty($respuesta['PASS'])){
        $respuesta = "";
        return $respuesta;
      }else{
          oci_free_statement($consult);
          oci_close(Conex::conexion());
          return $respuesta;
      }
    }elseif($valor == ""){
      echo "<span class='badge bg-danger'>No existe el usuario</span>";
    }

  }
  public static function mdlInsertarUsuarios($item1, $item2, $item3, $item4, 
  $item5, $item6, $item7, $item8, $item9, $item10, $item11, $item12, $item13, $item14, $item15, $item16, 
  $item17, $tabla, $cedula, $nombres, $apellidos, $celular, $correo, $residencia, $genero, $politicas, 
  $fnacimiento, $tipoCedula, $fexpedicion){
    if($cedula != null){
      $correo = strtolower($correo);
      $clave = crypt($cedula, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
      $estado = 0;
      $confimacion = 0;
      $tipo = "Cliente";
      $foto = 'avatar2.jpg';
      $sql = oci_parse(Conex::conexion(),"INSERT INTO $tabla($item1, $item2, $item3, $item4,
      $item5, $item6, $item7, $item8, $item9, $item10, $item11, $item12, $item13, $item14,
      $item15, $item16, $item17) VALUES(:ced, :nom, :ape, :cel, :cor, :pas, :est, :conf, :tu, :ciu, :gen, 
      TO_DATE(:fn, 'YYYY-MM-DD'), :fot, :pol, :td, sysdate, TO_DATE(:fex, 'YYYY-MM-DD'))");

      oci_bind_by_name($sql, ":ced", $cedula);
      oci_bind_by_name($sql, ":nom", $nombres);
      oci_bind_by_name($sql, ":ape", $apellidos);
      oci_bind_by_name($sql, ":cel", $celular);
      oci_bind_by_name($sql, ":cor", $correo);
      oci_bind_by_name($sql, ":pas", $clave);
      oci_bind_by_name($sql, ":est", $estado);
      oci_bind_by_name($sql, ":conf", $confimacion);
      oci_bind_by_name($sql, ":tu", $tipo);
      oci_bind_by_name($sql, ":ciu", $residencia);
      oci_bind_by_name($sql, ":gen", $genero);
      oci_bind_by_name($sql, ":fn", $fnacimiento);
      oci_bind_by_name($sql, ":fot", $foto);
      oci_bind_by_name($sql, ":pol", $politicas);
      oci_bind_by_name($sql, ":td", $tipoCedula);
      oci_bind_by_name($sql, ":fex", $fexpedicion);
      

      $result = oci_execute($sql);
      if($result){
        $mail = new PHPMailer(true);
        try {
          //Server settings
          $mail->SMTPDebug = 0;                      //Enable verbose debug output
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'ganaganapuntos@ganagana.com.co';                     //SMTP username
          $mail->Password   = 'Ganagana2022*';                               //SMTP password
          $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
          $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      
          //Recipients
          $mail->setFrom('ganaganapuntos@ganagana.com.co', 'Puntos GanaGana');
          $mail->addAddress($correo, $nombres);     //Add a recipient
      
          //Content
          $mail->isHTML(true);                            //Set email format to HTML
          $mail->Subject = 'Registro de Puntos GanaGana';
          $mail->Body    = "
        <div>
          <div style='background-color:#f5f5f5;padding:20px'>
            <div style='max-width:600px;margin:0 auto'>
              <div style='background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #9c27b0;margin-bottom:20px'>
                <div style='border-bottom:1px solid #f2f3f5;padding:20px 30px'>
                  <p style='margin:0;color:#333333'>
                   <h2 style='color: #0d2bd3;'> <b>
                      Hola, ". $nombres. "
                    </b></h2>
                  </p>
                </div>
                <div style='padding:20px 30px'>
                  <div style='font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px'>
                    <table cellpadding='0' cellspacing='0' width='100%' style='line-height:1.3em'>
                      <tbody>
                        <tr>
                          <td style='vertical-align:top;color:#686f7a'>                            
                            <p style='color: #000; font-size: ;'>Gracias por inscribirte en Puntos GanaGana, Estamos a un paso de activar tu cuenta, <strong style='color: #0d2bd3;'>Recuerda que tu contrase&ntilde;a es tu n&uacute;mero de c&eacute;dula</strong></p>                       
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <p>
                      Al activar tu cuenta por este correo aceptas y autorizas el tratamiento de datos personales de GanaGana, si quieres consultar m&aacute;s sobre el tratamiento de datos personales de GanaGana ingresa a este enlace <a href='https://www.ganagana.com.co/index.php/aviso-de-proteccion-de-datos'>Consultar</a>
                    </p>
                    <a href='http://186.115.218.51:85/puntosganagana/verificacion?ced=".$cedula."' style='font-size:16px;color:#ffffff;text-decoration:none;border-radius:2px;background-color:#9c27b0;border-top:12px solid #9c27b0;border-bottom:12px solid #9c27b0;border-right:18px solid #9c27b0;border-left:18px solid #9c27b0;display:inline-block'>Activar Cuenta  
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>";
          if($mail->Send()){
            echo "<script>
                      Swal.fire({
                        icon: 'success',
                        title: 'Buen Trabajo',
                        text: 'Te haz registrado exitosamente. Ahora activa tu cuenta desde tu correo electronico',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if(result.isConfirmed) {
                          window.location.href = 'salir';
                        }
                      })
                </script>";
          }else{
            echo "<script>
                    Swal.fire(
                    'Oops',
                    'Ha ocurrido algo, Intenta mas tarde',
                    'error'
                    )
                    setTimeout(function(){
                      window.location.href = 'salir';
                    },2000);
                  </script>";
          }
        }catch (Exception $e) {
          echo "<script>
                  Swal.fire(
                  'Oops',
                  'Ha ocurrido algo, Intenta mas tarde',
                  'error'
                  )
                  setTimeout(function(){
                    window.location.href = 'salir';
                  },2000);
                </script>";
        }
      }
      oci_close(Conex::conexion());
    }
  }
  public static function mdlListarClientes(){
    $table = "REGISTER_USERS";
    $sql = "SELECT * FROM $table";
    $consult = oci_parse(Conex::conexion(),$sql);
    $result = oci_execute($consult);
    return $consult;
  }
  public static function mdlValidarClaveAnterior($item1, $item2, $cedula, $table){
    $sql = "SELECT $item1 FROM $table WHERE $item2 = $cedula";
    $consult = oci_parse(Conex::conexion(), $sql);
    $result = oci_execute($consult);
    while($row = oci_fetch_array($consult, OCI_ASSOC)){
      $passA = $row['PASS'];
    }
    return $passA;
  }
  public static function mdlCambiarClave($passEncrypt, $table, $cedula, $item1, $item2, $item3){
    $sql = "UPDATE $table SET $item1 = '$passEncrypt', $item2 = 1  WHERE $item3 = $cedula";
    $consult = oci_parse(Conex::conexion(), $sql);
    $result = oci_execute($consult);
    if($result){
      return "Correcto";
    }
  
  }
  public static function mdlActualizarDatos($nombre, $apellido, $fecha, $cedula, $celular, 
  $ciudad, $genero, $correo, $table, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9){

    $sql = "UPDATE $table SET $item2 = '$nombre', $item3 = '$apellido', $item4 = TO_DATE('$fecha', 'YYYY-MM-DD'), 
    $item5 = '$celular', $item6 = '$ciudad', $item7 = '$genero', $item8 = '$correo' 
    WHERE $item9 = $cedula";
    $consult = oci_parse(Conex::conexion(), $sql);
    $result = oci_execute($consult);
    if($result){
      return true;
    }
  }
  public static function mdlActualizarPerfil($tabla, $item1, $item2, $item3, $item4,
  $tablaD, $item1D, $item2D, $item3D, $tablaP, $item1P, $item2P, $fechaN, $ciudad, 
  $genero, $estrato, $id, $cedula, $estado){
    $sql = oci_parse(Conex::conexion(), "INSERT INTO $tablaD($item1D, $item2D, $item3D) 
    VALUES(:id, :ced, :est)");
    oci_bind_by_name($sql, ":id", $id);
    oci_bind_by_name($sql, ":ced", $cedula);
    oci_bind_by_name($sql, ":est", $estado);
    $result = oci_execute($sql);
    if($result){
      $sql = "UPDATE $tabla SET $item1 = TO_DATE('$fechaN', 'YYYY-MM-DD HH24:MI:SS'), $item2 = '$ciudad', 
      $item3 = '$genero', $item4 = '$estrato' WHERE CEDULA = $cedula";
      $consult = oci_parse(Conex::conexion(), $sql);
      $result = oci_execute($consult);
      if($result){
        $sql = "SELECT $item2P FROM $tablaP WHERE $item1P = $cedula";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
          $row = oci_fetch_assoc($consult);
          $puntosA = $row['PUNTOS'];
          $puntosT = $puntosA + 45;
          $sql = "UPDATE $tablaP SET $item2P = $puntosT WHERE $item1P = $cedula";
          $consult = oci_parse(Conex::conexion(), $sql);
          $result = oci_execute($consult);
          if($result){
            return "Correcto";
          }else{
            return "Incorrecto";
          }
        }else{
          return "Incorrecto";
        }
      }else{
        return "Incorrecto";
      }
    }else{
      return "Incorrecto";
    }
  }
  public static function mdlActrualizarFoto($ced, $table, $item1, $item2, $item3){
    $sql = "UPDATE $table SET $item1 = '$item3' WHERE $item2 = $ced";
    $consult = oci_parse(Conex::conexion(), $sql);
    $result = oci_execute($consult);
    if($result){
      return "Correcto";
    }else{
      return "Incorrecto";
    }
  }
  public static function mdlRecuperarContraseña($table, $item1, $item2, 
  $passEncrypt, $cedula, $correo, $nuevaPass){
    $sql = "UPDATE $table SET $item2 = '$passEncrypt' WHERE $item1 = $cedula";
    $consult = oci_parse(Conex::conexion(), $sql);
    $result = oci_execute($consult);
    if($result){
      $mail = new PHPMailer(true);
      try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ganaganapuntos@ganagana.com.co';                     //SMTP username
        $mail->Password   = 'Ganagana2022*';                               //SMTP password
        $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('ganaganapuntos@ganagana.com.co', 'Puntos GanaGana');
        $mail->addAddress($correo, 'Usuario');     //Add a recipient
    
        //Content
        $mail->isHTML(true);                            //Set email format to HTML
        $mail->Subject = 'Recupera tu cuenta';
        $mail->Body    = "
        <div>
          <div style='background-color:#f5f5f5;padding:20px'>
            <div style='max-width:600px;margin:0 auto'>
              <div style='background:#fff;font:14px sans-serif;color:#686f7a;border-top:4px solid #9c27b0;margin-bottom:20px'>
                <div style='border-bottom:1px solid #f2f3f5;padding:20px 30px'>
                  <p style='margin:0;color:#333333'>
                   <h2 style='color: #0d2bd3;'> <b>
                      Se&ntilde;or Usuario
                    </b></h2>
                  </p>
                </div>
                <div style='padding:20px 30px'>
                  <div style='font-size:16px;line-height:1.5em;border-bottom:1px solid #f2f3f5;padding-bottom:10px;margin-bottom:20px'>
                    <table cellpadding='0' cellspacing='0' width='100%' style='line-height:1.3em'>
                      <tbody>
                        <tr>
                          <td style='vertical-align:top;color:#686f7a'>                            
                            <p style='color: #000; font-size: ;'>Haz completado el proceso recuperaci&oacute;n de contrase&ntilde;a de tu cuenta Puntos GanaGana, tu nueva contrase&ntilde;a registrada es: <strong style='color: #0d2bd3;'> ".$nuevaPass." </strong></p>                       


                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <a href='http://186.115.218.51:85/puntosganagana/' style='font-size:16px;color:#ffffff;text-decoration:none;border-radius:2px;background-color:#9c27b0;border-top:12px solid #9c27b0;border-bottom:12px solid #9c27b0;border-right:18px solid #9c27b0;border-left:18px solid #9c27b0;display:inline-block'>Ingresar
                      
                    </a>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        ";
        if($mail->Send()){
          echo "<script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Buen Trabajo',
                    text: 'Revisa tu correo y restablezca tu contraseña',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3085d6'
                  }).then((result) => {
                    if(result.isConfirmed) {
                      window.location.href = 'salir';
                    }
                  })
                </script>";
        }else{
          echo "<script>
                  Swal.fire(
                  'Oops',
                  'Ha ocurrido algo, Intenta mas tarde',
                  'error'
                  )
                  setTimeout(function(){
                    window.location.href = 'salir';
                  },2000);
                </script>";
        }
      }catch (Exception $e) {
        echo "<script>
                Swal.fire(
                'Oops',
                'Ha ocurrido algo1, Intenta mas tarde',
                'error'
                )
                setTimeout(function(){
                  window.location.href = 'recuperacion';
                },2000);
              </script>";
      }
    }else{
      echo "<script>
              Swal.fire(
              'Oops',
              'Ha ocurrido algo2, Intenta mas tarde',
              'error'
              )
              
            </script>";
    }
  }
  public static function mdlMunicipios($table){
    $sql = "SELECT * FROM $table";
    $consult = oci_parse(Conex::conexion(), $sql);
    $result = oci_execute($consult);
    if($result){
      $i = 0;
      while($row = oci_fetch_assoc($consult)){
        $array[$i] = array("CODIGO_CIUDAD" => $row['CODIGO_CIUDAD'], "CIUDAD" => $row['CIUDAD']);
        $i = $i + 1;
      }
      return $array;
    }
  }
}
