<?php
class ControladorUsuarios{
  /*=============================================
  INGRESO DE USUARIO
  =============================================*/
  public static function ctrIngresoUsuario(){
      if(isset($_POST["ingresar"])){
        if($_POST['ingUsuario'] != "" || $_POST['password'] != ""){
          $encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
          $inputCorreo = strtolower($_POST['ingUsuario']);
          $tabla = "REGISTER_USERS";
          $item  = "CORREO";
          $valor = $inputCorreo;
          //Recibe return del modelo usuarios
          $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
            if ($respuesta != "") {
              if($respuesta["CORREO"] == $inputCorreo && $respuesta["PASS"] == $encriptar){
                if($respuesta['TYPE_USERS'] == "Cliente"){
                  if($respuesta['ESTADO'] == 2){
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["CORREO"]        = $respuesta["CORREO"];
                    $_SESSION['CEDULA']        = $respuesta['CEDULA'];
                    $_SESSION['NOMBRE']        = $respuesta['NOMBRES']." ".$respuesta['APELLIDOS'];
                    $_SESSION["TYPE_USER"]     = $respuesta["TYPE_USERS"];
                    $_SESSION['ESTADO']        = $respuesta['ESTADO'];
                    $_SESSION['CONFIRMACION']  = $respuesta['CONFIRMACION'];
                    
                    $respuesta = ctrValidarPuntosUsuarios::validacion($_SESSION['CEDULA']);
                    if($respuesta != false){
                      ctrValidarPuntosUsuarios::almacenarValidacion($respuesta);
                      echo "<script> window.location = 'dashboardCliente' </script>";
                    }else{
                      echo "<script> window.location = 'dashboardCliente' </script>";
                    }
                  }elseif($respuesta['ESTADO'] == 0){
                    echo "<script>
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: 'Activa tu cuenta desde tu correo electrónico',
                        confirmButtonText: '¡Vale!',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if(result.isConfirmed) {
                          window.location.href = 'salir';
                        }
                      })
                    </script>";
                  }elseif($respuesta['ESTADO'] == 1){
                    echo "<script>
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: 'Haz cumplido una sansion en nuestra App;(',
                        confirmButtonText: '¡Vale!',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if(result.isConfirmed) {
                          
                        }
                      })
                    </script>";
                  }
                }elseif($respuesta['TYPE_USERS'] == "Asesor"){
                  $_SESSION["iniciarSesion"] = "ok";
                  $_SESSION['NOMBRES']       = $respuesta['NOMBRES'];
                  $_SESSION['APELLIDOS']     = $respuesta['APELLIDOS'];
                  $_SESSION['CORREO']        = $respuesta['CORREO'];
                  $_SESSION['CEDULA']        = $respuesta['CEDULA'];
                  $_SESSION["TYPE_USER"]     = $respuesta["TYPE_USERS"];
                  $_SESSION['FOTO']          = $respuesta['FOTO'];
                  $_SESSION['ESTADO']        = $respuesta['ESTADO'];

                  echo "<script> window.location.href = 'dashboard' </script>";
                }
              }else{
                echo "<script>
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: 'Usuario o Clave erroneos, intentalo de nuevo',
                        confirmButtonText: 'Intentar de Nuevo',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if(result.isConfirmed) {
                          window.location.href = 'salir';
                        }
                      })
                    </script>";
              }
            }else{
              echo "<script>
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: 'Error al ingresar, intentalo de nuevo',
                        confirmButtonText: 'Intentar de Nuevo',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if(result.isConfirmed) {
                          window.location.href = 'salir';
                        }
                      })
                    </script>";
            }
        }elseif($_POST['ingUsuario'] == "" || $_POST['password'] == ""){
          echo "<script>
                  Swal.fire(
                    'Oops',
                    'Los campos estan vacios',
                    'error'
                  )
                </script>";
        }
      }
  }
  public static function ctrRegistrarCliente(){
    if(isset($_POST["confirmar"])){
      $tipoCedula = $_POST['tipDoc'];
      $cedula = $_POST['cedula'];
      $nombres = $_POST['nombres'];
      $apellidos = $_POST['apellidos'];
      $celular = $_POST['celular'];
      $correo = $_POST['correo'];
      //$area = $_POST['area'];
      //$subProceso = $_POST['subProceso'];
      $fnacimiento = $_POST['fnacimiento'];
      $fexpedicion = $_POST['fexpedicion'];
      $genero = $_POST['genero'];
      $residencia = $_POST['residencia'];
      $politicas = $_POST['terminos'];
      if($politicas == false || empty($politicas)){
        echo "<script>
                Swal.fire({
                  icon: 'error',
                  title: 'Oops',
                  text: '¡Oye genio! no haz aceptado terminos y condiciones',
                  confirmButtonText: 'Intentar de Nuevo',
                  confirmButtonColor: '#3085d6'
                }).then((result) => {
                  if(result.isConfirmed) {
                    window.location.href = 'salir';
                  }
                })
              </script>";
      }else{
        $tabla = "REGISTER_USERS";
        $item1 = "CEDULA";
        $item2 = "NOMBRES";
        $item3 = "APELLIDOS";
        $item4 = "CELULAR";
        $item5 = "CORREO";
        $item6 = "PASS";
        $item7 = "ESTADO";
        $item8 = "CONFIRMACION";
        $item9 = "TYPE_USERS";
        $item10 = "CIUDAD";
        $item11 = "GENERO";
        $item12 = "FECHA_NAC";
        $item13 = "FOTO";
        $item14 = "POLITICAS";
        $item15 = "TYPE_DOCUMENTO";
        $item16 = "FECHA_CREACION";
        $item17 = "FECHA_EXP";
        $politicas = 1;
        $respuesta = ModeloUsuarios::mdlInsertarUsuarios($item1, $item2, $item3, $item4, 
        $item5, $item6, $item7, $item8, $item9, $item10, $item11, $item12, $item13, $item14, $item15, $item16, 
        $item17, $tabla, $cedula, $nombres, $apellidos, $celular, $correo, $residencia, $genero, $politicas, $fnacimiento, 
        $tipoCedula, $fexpedicion);
      }
    }
  }
  public static function ctrCambiarPass(){
    if(isset($_POST['guardar'])){
    $cedula = $_POST['cedula'];
    $passA = crypt($_POST['passwordA'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];
    $item1 = "PASS";
    $item2 = "CEDULA";
    $table = "REGISTER_USERS";
    $respuesta = ModeloUsuarios::mdlValidarClaveAnterior($item1, $item2, $cedula, $table);
    if($respuesta == $passA){
      if($pass1 == $pass2){
        $passEncrypt = crypt($pass1, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $table = "REGISTER_USERS";
        $item1 = "PASS";
        $item2 = "CONFIRMACION";
        $item3 = "CEDULA";
        $respuesta = ModeloUsuarios::mdlCambiarClave($passEncrypt, $table, $cedula, $item1, $item2, $item3);
        if($respuesta == "Correcto"){
          echo "<script>
                  Swal.fire(
                  'Buen Trabajo',
                  'Haz Cambiado tu Clave',
                  'success'
                  )
                  setTimeout(function(){
                    window.location.href = 'salir';
                  },2000);
                </script>";
        }
      }else{
        echo "<script>
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Las claves no coinciden'
                })
              </script>";
      }
    }else{
      echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La clave no coincide con la actual'
              })
            </script>";
    }
  }
}
public static function ctrActualizarDatos(){
  if(isset($_POST['actualizar'])){
    if(empty($_POST['NOMBRES']) || empty($_POST['APELLIDOS']) || empty($_POST['CORREO'])){
      echo "
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Hay campos vacios o Active todos los campos'
        })
        setTimeout(function(){
          window.location.href = 'perfil';
        },3500);
      </script>
      ";
    }else{
      $nombre = $_POST['NOMBRES'];
      $apellido = $_POST['APELLIDOS'];
      $fecha = $_POST['FECHA'];
      $cedula = $_POST['cedula'];
      $celular = $_POST['CELULAR'];
      $ciudad = $_POST['CIUDAD'];
      $genero = $_POST['GENERO'];
      $correo = $_POST['CORREO'];
      $table = "REGISTER_USERS";
      $item2 = "NOMBRES";
      $item3 = "APELLIDOS";
      $item4 = "FECHA_NAC";
      $item5 = "CELULAR";
      $item6 = "CIUDAD";
      $item7 = "GENERO";
      $item8 = "CORREO";
      $item9 = "CEDULA";
      $respuesta = ModeloUsuarios::mdlActualizarDatos($nombre, $apellido, $fecha, $cedula, $celular, 
      $ciudad, $genero, $correo, $table, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9);
      if($respuesta == true){
        echo "<script>
                Swal.fire(
                'Buen Trabajo',
                'Haz actualizado tus datos personales',
                'success'
                )
                setTimeout(function(){
                  window.location.href = 'perfil';
                },2000);
              </script>";
      }else{
        echo "<script>
                Swal.fire(
                'Oops',
                'Algo ha pasado con la actualizacion, intenta mas tarde!',
                'error'
                )
                setTimeout(function(){
                  window.location.href = 'perfil';
                },2000);
              </script>";
      }
    }
  }
}
public static function ctrActualizarPerfil(){
  if(isset($_POST['guardar'])){
    $fechaN = $_POST['FECHA'];
    $ciudad = $_POST['CIUDAD'];
    $genero = $_POST['GENERO'];
    $estrato = $_POST['ESTRATO'];
    $id = $_POST['ID'];
    $cedula = $_POST['CED'];
    $estado = 0;
    $tabla = "REGISTER_USERS";
    $item1 = "FECHA_NAC";
    $item2 = "CIUDAD";
    $item3 = "GENERO";
    $item4 = "ESTRATO";
    $tablaD = "DESAFIOS";
    $item1D = "IDE_PROMO";
    $item2D = "CEDULA";
    $item3D = "ESTADO";
    $tablaP = "DETAIL_POINTS";
    $item1P = "CEDULA";
    $item2P = "PUNTOS";
    $respuesta = ModeloUsuarios::mdlActualizarPerfil($tabla, $item1, $item2, $item3, $item4,
    $tablaD, $item1D, $item2D, $item3D, $tablaP, $item1P, $item2P, $fechaN, $ciudad, 
    $genero, $estrato, $id, $cedula, $estado);
    if($respuesta == 'Correcto'){
      echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Excelente',
              text: 'Acabas de obtener 45 puntos',
              confirmButtonText: '¡Gracias!',
              confirmButtonColor: '#3085d6'
            }).then((result) => {
              if(result.isConfirmed) {
                window.location.href = 'promo';
              }
            })
          </script>";
    }else{
      echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops',
              text: 'Ha ocurrido algo',
              confirmButtonText: 'Intentar de Nuevo',
              confirmButtonColor: '#3085d6'
            }).then((result) => {
              if(result.isConfirmed) {
                window.location.href = 'promo';
              }
            })
          </script>";
    }
  }
}
public static function ctrActualizarFoto(){
  if(isset($_POST['Guardar'])){
    if(empty($_FILES['photo']['name'])){
      echo "<script>
              Swal.fire(
              'Oops',
              'No haz insertado ninguna foto',
              'error'
              )
              setTimeout(function(){
                window.location.href = 'perfil';
              },2000);
            </script>";
    }else{
      $photoName = $_FILES['photo']['name'];
      $photoRuta = $_FILES['photo']['tmp_name'];
      $photoType = $_FILES['photo']['type'];
      $photoSize = $_FILES['photo']['size'];
      if(strlen($photoName) > 30 || $photoSize >= 2000000){
        echo "<script>
              Swal.fire(
              'Oops',
              'La foto es muy pesada o el nombre de la foto son muy largos',
              'error'
              )
              setTimeout(function(){
                window.location.href = 'perfil';
              },3000);
            </script>";
      }elseif($photoType == "image/jpeg" || $photoType == "image/jpg" || $photoType == "image/png"){
        $ruta = "./vistas/imgClientes";
        $ruta = $ruta."/".$photoName;
        move_uploaded_file($photoRuta, $ruta);
        $table = "REGISTER_USERS";
        $item1 = "FOTO";
        $item2 = "CEDULA";
        $response = ModeloUsuarios::mdlActrualizarFoto($_SESSION['CEDULA'], $table, $item1, $item2,
        $photoName);
        if($response == "Correcto"){
          echo "<script>
                  Swal.fire(
                  '¡Exelente!',
                  'Haz actualizado tu foto exitosamente',
                  'success'
                  )
                  setTimeout(function(){
                    window.location.href = 'perfil';
                  },2000);
                </script>";
          }
        }
      }
    }
  }
  public static function ctrMisDatos($cedula){
    $table = "REGISTER_USERS";
    $item1 = "CEDULA";
    $respuesta = ModeloUsuarios::MdlMostrarUsuarios($table, $item1, $cedula);
    return $respuesta;
  }
  public static function ctrRecuperarContraseña(){
    if(isset($_POST['recuperar'])){
      $cedula = $_POST['cedula'];
      $correo = $_POST['correo'];
      $fexpedicion = $_POST['fexpedicion'];
      $nuevaPass = rand(100000, 999999);
      $passEncrypt = crypt($nuevaPass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
      $table = "REGISTER_USERS";
      $item1 = "CEDULA";
      $item2 = "PASS";
      $respuesta = ModeloUsuarios::mdlRecuperarContraseña($table, $item1, $item2, 
      $passEncrypt, $cedula, $correo, $nuevaPass);
    }
  }
  public static function ctrMunicipios(){
    $table = "MUNICIPIOS";
    $municipios = ModeloUsuarios::mdlMunicipios($table);
    return $municipios;
  }
  public static function ctrBuscarCodigo($cedula){
    if(isset($_POST['ingresar'])){
      $codShare = $_POST['codShare'];
      $table = "REFERIDOS";
      $item1 = "";
      $item2 = "";
      $item3 = "";
    }
  }
}
?>