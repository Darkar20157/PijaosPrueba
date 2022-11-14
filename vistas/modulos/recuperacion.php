<div class="main-container2">
    <div class="container2">
        <div class="row">
            <div class="col-12" style="text-align: center;">
                <img src="./vistas/img/logo1.png">
            </div>
        </div>
        <form method="POST">
            <div class="row">
                <div class="col-12" style="text-align: center;">
                    <h1>Recuperar Contraseña</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <h2>Digite numero de cedula</h2>
                    <input class="form-control" type="number" name="cedula" id="cedula">
                </div>
                <div class="col-12 col-md-4">
                    <h2>Fecha de expedicion de la Cedula</h2>
                    <input class="form-control" type="date" name="fexpedicion" id="fexpedicion">
                </div>
                <div class="col-12 col-md-4">
                    <h2>Digite correo electronico</h2>
                    <input class="form-control" type="email" name="correo" id="correo">
                </div>
            </div>
            <div class="row">
                <div class="col-12" id="boton">
                    <button type="button" class="btn btn-primary" name="recuperar" id="recuperar" onclick="consultCedYCorreo()">Validar Cuenta</button>
                </div>
            </div>
            <?php
            ControladorUsuarios::ctrRecuperarContraseña();
            ?>
        </form>
    </div>
</div>
<br>