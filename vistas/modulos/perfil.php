<?php
date_default_timezone_set("America/Bogota");
$misDatos = ControladorUsuarios::ctrMisDatos($_SESSION['CEDULA']);
$fechaN = fecha($misDatos);
function fecha($misDatos){
    if(empty($misDatos['FECHA_NAC'])){
        $fechaN = 0;
        return $fechaN;
    }else{
        /*============================================
            FORMATO PARA SERVIDOR
        ==============================================*/
        $fechaN = date("Y-m-d", strtotime($misDatos['FECHA_NAC']));
        return $fechaN;
        /*============================================
            FORMATO PARA LOCALHOST
        ==============================================
        $fecha = explode("/",$misDatos['FECHA_NAC']);
        $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $fechaN = date('Y-m-d', strtotime($fecha));
        return $fechaN;
        */
    }
}
?>
<div class="circulo">
    <div class="foto">
        <img class="imgfoto" src="./vistas/imgClientes/<?php echo $misDatos['FOTO']; ?>" alt="miNombre">
        
        <label class="photo" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <img src="https://img.icons8.com/ios-glyphs/30/000000/unsplash.png"/>
        </label>
    </div>
    <div class="nombre">
        <h3><?php echo $misDatos['NOMBRES']." ".$misDatos['APELLIDOS'] ?></h3>
    </div>
</div>
<div class="main-container">
    <!-- <a class="salir" href="dashboardCliente"><img src="https://img.icons8.com/ios-filled/50/000000/esc.png"/></a> -->
        <a href="dashboardCliente" class="btn-esc">Esc</a>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>Mi Perfil</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-success" id="editar" onclick="ePerfil()">Editar Datos</button>
            </div>
        </div>
        <form method="POST">
            <input type="hidden" name="cedula" value="<?php echo $misDatos['CEDULA']; ?>">
            <div class="row">
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub">Tipo Documento</h3>
                        <p class="paragraph"><?php echo $misDatos['TYPE_DOCUMENTO'] ?></p>
                    </div>
                </div>
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub">Cedula</h3>
                        <p class="paragraph"><?php echo $misDatos['CEDULA'] ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub" id="eNombre">Nombres</h3>
                        <input class="form-control" type="text" id="NOMBRES" name="NOMBRES" value="<?php echo $misDatos['NOMBRES'] ?>" readonly>
                    </div>
                </div>
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub" id="eApellido">Apellidos</h3>
                        <input class="form-control" type="text" id="APELLIDOS" name="APELLIDOS" value="<?php echo $misDatos['APELLIDOS'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub" id="eFecha">Fecha Nacimiento</h3>
                        <input class="form-control" type="date" id="FECHA" name="FECHA" value="<?php echo $fechaN;?>" readonly>
                    </div>
                </div>
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub" id="eCelular">Celular</h3>
                        <input class="form-control" type="number" id="CELULAR" name="CELULAR" value="<?php echo $misDatos['CELULAR'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub" id="eGenero">Genero</h3>
                        <select class="form-select" name="GENERO" id="GENERO" disabled>
                            <option value="<?php if(empty($misDatos['GENERO'])){echo "";}else{echo $misDatos['GENERO'];} ?>"><?php if(empty($misDatos['GENERO'])){echo "Seleccione una Opcion";}else{echo $misDatos['GENERO'];} ?></option>
                            <option value="" disabled><?php if(empty($misDatos['GENERO'])){echo "(Ninguno)";}else{echo "(".$misDatos['GENERO'].")";} ?></option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="col-6" id="col-editar">
                    <div class="subtitle">
                        <h3 class="sub" id="eCiudad">Residencia</h3>
                        <select class="form-select" name="CIUDAD" id="CIUDAD" disabled>
                            <option value="<?php if(empty($misDatos['CIUDAD'])){echo "";}else{echo $misDatos['CIUDAD'];} ?>"><?php if(empty($misDatos['CIUDAD'])){echo "Seleccione una Opcion";}else{echo $misDatos['CIUDAD'];} ?></option>
                            <option value="" disabled><?php if(empty($misDatos['CIUDAD'])){echo "(Ninguno)";}else{echo "(".$misDatos['CIUDAD'].")";} ?></option>
                            <option value="Ibague">Ibague</option>
                            <option value="Coello">Coello</option>
                            <option value="Guamo">Guamo</option>
                            <option value="Mariquita">Mariquita</option>
                            <option value="Fresno">Fresno</option>
                            <option value="Espinal">Espinal</option>
                            <option value="Herveo">Herveo</option>
                            <option value="Libano">Libano</option>
                            <option value="Honda">Honda</option>
                            <option value="Ataco">Ataco</option>
                            <option value="Natagaima">Natagaima</option>
                            <option value="Ortega">Ortega</option>
                            <option value="Cajamarca">Cajamarca</option>
                            <option value="Purificacion">Purificacion</option>
                            <option value="Venadillo">Venadillo</option>
                            <option value="Chaparral">Chaparral</option>
                            <option value="Falan">Falan</option>
                            <option value="Rovira">Rovira</option>
                            <option value="Saldaña">Saldaña</option>
                            <option value="Rioblanco">Rioblanco</option>
                            <option value="Palocabildo">Palocabildo</option>
                            <option value="Cunday">Cunday</option>
                            <option value="Coyaima">Coyaima</option>
                            <option value="San Antonio">San Antonio</option>
                            <option value="Villahermosa">Villahermosa</option>
                            <option value="San Luis">San Luis</option>
                            <option value="Icononzo">Icononzo</option>
                            <option value="Flandes">Flandes</option>
                            <option value="Melgar">Melgar</option>
                            <option value="Alpujarra">Alpujarra</option>
                            <option value="Muriilo">Muriilo</option>
                            <option value="Alvarado">Alvarado</option>
                            <option value="Dolores">Dolores</option>
                            <option value="Anzoategui">Anzoategui</option>
                            <option value="Lerida">Lerida</option>
                            <option value="Ronce Valles">Ronce Valles</option>
                            <option value="Guayabal">Guayabal</option>
                            <option value="Villarrica">Villarrica</option>
                            <option value="Santa Isabel">Santa Isabel</option>
                            <option value="Valle de San Juan">Valle de San Juan</option>
                            <option value="Casabianca">Casabianca</option>
                            <option value="Suarez">Suarez</option>
                            <option value="Prado">Prado</option>
                            <option value="Planadas">Planadas</option>
                            <option value="Carmen de Apicala">Carmen de Apicala</option>
                            <option value="Piedras">Piedras</option>
                            <option value="Armero">Armero</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="subtitle">
                        <h3 class="sub" id="eCorreo">Correo</h3>
                        <input class="form-control" type="email" id="CORREO" name="CORREO" value="<?php echo $misDatos['CORREO'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="subtitle">
                        <button class="btn btn-success" type="submit" id="actualizar" name="actualizar" disabled>Actualizar datos</button>
                    </div>
                </div>
            </div>
            <?php
            ControladorUsuarios::ctrActualizarDatos();
            ?>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="subtitle">
                    <button class="btn btn-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Cambiar Clave</button>
                    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Actualizar Clave</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body small">
                            <form method="POST">
                                <input type="hidden" name="cedula" value="<?php echo $misDatos['CEDULA']; ?>">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Digite la Clave Actual</h5>
                                            <input class="form-control" type="password" name="passwordA" id="passwordA">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="mostrar-pass">
                                            <p> Mostrar Clave </p>
                                            <input class="form-check-input" type="checkbox" onchange="mostrarPassPerfil(1)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Digite la Nueva Clave</h5>
                                            <input class="form-control" type="password" name="password1" id="password1">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="mostrar-pass">
                                            <p> Mostrar Clave </p>
                                            <input class="form-check-input" type="checkbox" onchange="mostrarPassPerfil(2)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Confirme la Nueva Clave</h5>
                                            <input class="form-control" type="password" name="password2" id="password2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="mostrar-pass">
                                            <p> Mostrar Clave </p>
                                            <input class="form-check-input" type="checkbox" onchange="mostrarPassPerfil(3)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-success" name="guardar">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                ControladorUsuarios::ctrCambiarPass();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Foto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="file" id="photo" name="photo" onchange="getImage(event)">
                                    <label class="photo-view" for="photo">
                                        <div class="preview" style="padding: 20px 30px">
                                            <img src="https://img.icons8.com/external-others-justicon/200/ffffff/external-photo-camera-photography-others-justicon-5.png"/>
                                        </div>
                                    </label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="Guardar" name="Guardar">Guardar Cambios</button>
                                </div>
                                <?php
                                ControladorUsuarios::ctrActualizarFoto();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>Comparte tu Codigo</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><img src="https://img.icons8.com/tiny-color/30/000000/experimental-share-tiny-color.png"/></span>
                        <input type="text" class="form-control" id="codShare" name="codShare" placeholder="Digita el codigo de tu amigo" aria-describedby="basic-addon1">
                    </div>
                    <button class="btn btn-success" name="ingresar">Ingresar Codigo</button>
                    <?php
                    ControladorUsuarios::ctrBuscarCodigo($_SESSION['CEDULA']);
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
-->
