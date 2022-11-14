<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="shortcut icon" href="vistas/logo1.png" type="image/x-icon">
  <title>Puntos GanaGana</title>
  <!-- Theme style -->
  <?php
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
    if($_SESSION['TYPE_USER'] == "Cliente"){
      if(isset($_GET['ruta'])){
        if($_GET['ruta'] == "dashboardCliente"){
          ?>
          <link rel="stylesheet" href="./vistas/css/pantalla_carga.css">
          <link rel="stylesheet" href="./vistas/css/Bootstrap/bootstrap.css">
          <link rel="stylesheet" href="./vistas/css/dashboardCliente.css">
        <?php
        }elseif($_GET['ruta'] == "perfil" || $_GET['ruta'] == "puntos" || $_GET['ruta'] == "codBarras" || 
        $_GET['ruta'] == "tutorial" || $_GET['ruta'] == "ubicanos" || $_GET['ruta'] == "registrarProducto" ||
        $_GET['ruta'] == "promo"){
          ?>
          <link rel="stylesheet" href="./vistas/css/pantalla_carga.css">
          <link rel="stylesheet" href="./vistas/css/Bootstrap/bootstrap.css">
          <link rel="stylesheet" href="./vistas/css/mainMovil.css">
          <link rel="stylesheet" href="./vistas/css/myPerfil.css">
          <link rel="stylesheet" href="./vistas/css/imgInput.css">
          <link rel="stylesheet" href="./vistas/css/puntos.css">
          <link rel="stylesheet" href="./vistas/css/codBarras.css">
          <link rel="stylesheet" href="./vistas/css/swalfire.css">
        <?php
        }else{
          ?>
          <link rel="stylesheet" href="./vistas/css/pantalla_carga.css">
          <link rel="stylesheet" href="./vistas/css/error404.css">
          <?php
        }
      }else{
      ?>
        
      <?php
      }
      ?>
      <!-- SweetAlert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
      <!-- Screenshot -->

    <?php
    }elseif($_SESSION['TYPE_USER'] == "Asesor"){
    ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./vistas/css/pantalla_carga.css">
    <link rel="stylesheet" href="./vistas/css/navbar.css">
    <link rel="stylesheet" href="./vistas/css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./vistas/css/stylesBootstrap.css">
    <link rel="stylesheet" href="./vistas/css/imgInput.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <?php
    }
  }else{
  ?>
    <link rel="stylesheet" href="./vistas/css/pantalla_carga.css">
    <link rel="stylesheet" href="./vistas/css/navbar.css">
    <link rel="stylesheet" href="./vistas/css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./vistas/css/stylesBootstrap.css">
    <link rel="stylesheet" href="./vistas/css/stylesLogin.css">
    <link rel="stylesheet" href="./vistas/css/verificacion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="./vistas/css/swalfire.css">
  <?php
  }
  ?>
</head>
<!--=====================================
CUERPO DOCUMENTO
======================================-->
<body id="web">
<div class="container-loader" id="cargando">
  <div class="loarder">
      <img src="vistas/img/logo1.png">
  </div>
</div>
<?php
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
    if($_SESSION['TYPE_USER'] == "Cliente" && $_SESSION['ESTADO'] == 2){
      /*=============================================
      CONTENT CLIENTE
      =============================================*/
      if(isset($_GET["ruta"])){
        if($_GET['ruta'] == "dashboardCliente" || $_GET['ruta'] == "perfil" || $_GET["ruta"] == "salir" || 
          $_GET['ruta'] == "puntos" || $_GET['ruta'] == "codBarras" || $_GET['ruta'] == "tutorial" ||
          $_GET['ruta'] == "ubicanos" || $_GET['ruta'] == "registrarProducto" || $_GET['ruta'] == "promo"){
            include "modulos/" . $_GET["ruta"] . ".php";
        }else{
          include "modulos/404.php";
        }
      }else{
        include "modulos/404.php";
      }
    }elseif($_SESSION['TYPE_USER'] == "Asesor" && $_SESSION['ESTADO'] == 2){
      /*=============================================
      NAVBAR ASESOR Y ADMINISTRADOR
      =============================================*/
      include "plantillas/plantilla.php";

      /*=============================================
      CONTENT ASESOR Y ADMINISTRADOR
      =============================================*/
      if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "dashboard" || $_GET['ruta'] == "registrarEmpleado" || $_GET["ruta"] == "salir" ||
          $_GET['ruta'] == "registrarClientes" || $_GET['ruta'] == "parametrizacion" || 
          $_GET['ruta'] == "perfilEmpleados" || $_GET['ruta'] == "publicaciones" ||
          $_GET['ruta'] == "promociones"){
            include "modulos/" . $_GET["ruta"] . ".php";
        }else{
          include "modulos/404.php";
        }
      }else{
        include "modulos/dashboard.php";
      }
    }else{
      include "modulos/404.php";
    }
  /*=============================================
      CONTENT
  =============================================*/
  }elseif(isset($_GET['ruta'])){
    if($_GET['ruta'] == 'verificacion' || $_GET['ruta'] == 'recuperacion'){
      include "modulos/" . $_GET["ruta"] . ".php";
    }else{
      include "modulos/login.php";
    }
  }else{
    include "modulos/login.php";
  }
?>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="./vistas/js/Jquery/jquery-3.6.0.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<!-- JsBarcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script src="./vistas/js/Screenshot/screenshotCanvas.js"></script>

<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLVCpxUzi-wGyct4DXjZU4VhpXubeVeOE&libraries=places"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- MY SCRIPTS -->
<script src="./vistas/js/cargando.js"></script>
<script src="./vistas/js/login.js"></script>
<script src="./vistas/js/navbar.js"></script>
<script src="./vistas/js/editar.js"></script>
<script src="./vistas/js/range.js"></script>
<script src="./vistas/js/clientes.js"></script>
<script src="./vistas/js/dashboard.js"></script>
<script src="./vistas/js/inputView.js"></script>
<script src="./vistas/js/puntos.js"></script>
<script src="./vistas/js/codBarras.js"></script>
<script src="./vistas/js/paginador.js"></script>
<script src="./vistas/js/validaciones.js"></script>
<script src="./vistas/js/ubicacion.js"></script>
<script src="./vistas/js/productos.js"></script>
</body>
</html>
