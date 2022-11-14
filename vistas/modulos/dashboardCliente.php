<?php
if($_SESSION['CONFIRMACION'] == 0){
    $cedula = $_SESSION['CEDULA'];
?>
    <div class="offcanvas offcanvas-bottom show" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Actualiza tu Clave</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="POST">
                <input type="hidden" name="cedula" value="<?php echo $_SESSION['CEDULA']; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h5>Digite la Clave Actual</h5>
                            <input class="form-control" type="password" name="passwordA">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <h5>Digite la Nueva Clave</h5>
                            <input class="form-control" type="password" name="password1">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <h5>Confirme la Clave</h5>
                            <input class="form-control" type="password" name="password2">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success" type="submit" name="guardar" style="width: 100%">Guardar</button>
                        </div>
                    </div>
                </div>
                <?php
                $cambio = new ControladorUsuarios;
                $cambio->ctrCambiarPass();
                ?>
            </form>
        </div>
    </div>
<?php
}
?>
<div class="main-container">
    <div class="sub-modulos">
        <div class="sub-modulo">
            <a id="tutorial" href="tutorial" class="opcion">Tutorial</a>
        </div>
        <div class="sub-modulo" href="ubicanos">
            <a href="ubicanos" class="opcion">Ubicanos </a>
        </div>
        <div class="sub-modulo">
            <a href="registrarProducto" class="opcion">Registrar Producto</a>
        </div>
        <div class="sub-modulo">
            <a href="https://forms.gle/tpQk7UTk2x9eettS7" class="opcion">Danos tu opinion</a>
        </div>
    </div>
    <div class="logo">
        <img src="vistas/img/logo1.png">
    </div>
    <div class="salir">
        <a href="salir"><img src="https://img.icons8.com/fluency/48/ffffff/shutdown.png"/></a>
        <button class="opciones">
            <img src="https://img.icons8.com/ios-glyphs/30/ffffff/sorting-options.png"/>
        </button>
    </div>
    <div class="main-modulos">
        <a class="modulo-1" href="perfil">
            <div class="head">
                <img src="vistas/img/letras1.png">
            </div>
        </a>
        <a class="modulo-2" href="codBarras">
            <div class="head">
                <img src="vistas/img/letras2.png">
            </div>
        </a>
        <a class="modulo-3" href="promo">
            <!--
            <div class="notificaciones">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="1280.000000pt" height="1280.000000pt" viewBox="0 0 1280.000000 1280.000000" preserveAspectRatio="xMidYMid meet">
                    <metadata>
                    Created by potrace 1.15, written by Peter Selinger 2001-2017
                    </metadata>
                    <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" stroke="none">
                    <path d="M5605 12784 c-294 -52 -556 -222 -718 -466 -98 -147 -80 -95 -455 -1303 -77 -247 -188 -603 -246 -790 -58 -187 -168 -540 -244 -785 l-138 -444 -120 -37 c-137 -43 -721 -224 -1059 -329 -126 -40 -300 -94 -385 -120 -1613 -501 -1572 -487 -1679 -548 -393 -221 -611 -658 -550 -1098 34 -249 148 -468 335 -644 55 -52 488 -363 1397 -1005 l1318 -930 -6 -255 c-10 -461 -27 -2045 -29 -2580 -1 -552 -1 -550 46 -700 31 -100 111 -246 181 -335 313 -396 860 -525 1312 -311 117 55 101 44 640 446 248 185 822 613 1277 953 l826 617 179 -61 c98 -34 324 -110 503 -171 516 -175 807 -273 1395 -473 940 -319 1012 -343 1107 -359 515 -89 1026 211 1202 705 64 179 81 368 50 550 -11 64 -74 264 -196 624 -195 574 -322 950 -477 1407 -54 161 -165 486 -245 721 l-145 429 616 826 c340 455 779 1043 976 1307 299 400 367 498 413 590 183 372 140 810 -112 1141 -155 204 -371 339 -644 406 -43 10 -175 13 -595 12 -530 -2 -2032 -19 -2555 -29 l-265 -5 -930 1316 c-511 724 -951 1340 -977 1370 -250 286 -636 423 -1003 358z"/>
                    </g>
                </svg>
            </div>
            -->
            <div class="head">
                <img src="vistas/img/letras3.png">
            </div>
        </a>
        <a class="modulo-4" href="puntos">
            <div class="head">
                <img src="vistas/img/letras4.png">
            </div>
        </a>
    </div>
</div>