<?php
$cedula = explode('=',$_SERVER['REQUEST_URI']);
$cedula = $cedula['1'];
$response = ControladorValidarCuentas::ctrConsultUsuario($cedula);
$nombre = $response['NOMBRES'];
if(!empty($response) && $response['ESTADO'] == 0){
    ?>
    <div class="main-container2">
        <div class="container2">
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <img src="./vistas/img/logo1.png">
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                <h1>
                    Gracias por registrarte <?php echo $nombre ?> estas a un paso para activar tu cuenta, 
                    da clic en activar cuenta y recuerda que tu clave de ingreso por primera vez es tu número de cédula
                </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="flecha"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form method="POST">
                        <input type="number" name="ced" value="<?php echo $cedula ?>" hidden>
                        <button class="btn btn-success" name="validar" style="font-size: 30px">Validar Cuenta</button>
                        <?php
                        ControladorValidarCuentas::ctrValidarCuenta();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}else{
    ?>
    <script>
        window.location.href = '404';
    </script>
    <?php
}
?>