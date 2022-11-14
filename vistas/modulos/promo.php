<?php
$ced = $_SESSION['CEDULA'];
$consult = ControladorPuntos::ctrMostrarPromociones($ced);
?>
<div class="main-container">
    <a href="dashboardCliente" class="btn-esc">Esc</a>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">
                    <h3>Promociones</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- PROMOCIONES -->
    <div class="container">
        <div class="row">
            <?php
            $i = 0;
            while($row = oci_fetch_array($consult, OCI_ASSOC)){
                ?>
                <div class="col-6 col-xs-6 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="main-card">
                        <div class="card-img">
                            <img src="./vistas/imgPromociones/<?php echo $row['FOTO']; ?>">
                        </div>
                        <div class="card-content">
                            <div class="title-card">
                                <h5><?php echo $row['TITULO']; ?></h5>
                            </div>
                            <div class="card-puntos">
                                <h6>Puntos: <?php echo $row['PUNTOS']; ?></h6>
                            </div>
                            <div class="body-card">
                                <p><?php echo $row['DESCRIPCION']; ?></p>
                            </div>
                            <div class="button-card">
                                <?php
                                if(!empty($row['CEDULA'])){
                                ?>
                                    <button class="btn btn-success"><img src="https://img.icons8.com/fluency/28/undefined/good-quality.png"/></button>
                                <?php
                                }else{
                                ?>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="reclamar(<?php echo $row['ID'] ?>, <?php echo $_SESSION['CEDULA'] ?>)">Reclamar</button>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="footer-card">
                                <small>Valido desde: <?php echo $row['FECHA_INICIAL']; ?></small>
                                <small>Valido hasta: <?php echo $row['FECHA_FINAL']; ?></small>
                            </div>                        
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- MODAL - PROMOCIONES -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Completa tu Perfil</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <h6>Estrato</h6>
                                <select class="form-select" name="ESTRATO" id="ESTRATO">
                                    <option value="">Seleccione una Opcion</option>
                                    <option value="Estrato 1">Estrato 1</option>
                                    <option value="Estrato 2">Estrato 2</option>
                                    <option value="Estrato 3">Estrato 3</option>
                                    <option value="Estrato 4">Estrato 4</option>
                                    <option value="Estrato 5">Estrato 5</option>
                                    <option value="Estrato 6">Estrato 6</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <h6>Residencia</h6>
                                <select class="form-select" name="CIUDAD" id="CIUDAD">
                                    <option value="">Selecciona una Opcion</option>
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
                            <div class="col-12 col-md-4">
                                <h6>Genero</h6>
                                <select class="form-select" name="GENERO" id="GENERO">
                                    <option value="">Selecciona una Opcion</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h6>Fecha Nacimiento</h6>
                                <input class="form-control" type="date" id="FECHA" name="FECHA">
                                <input type="hidden" id="ID" name="ID">
                                <input type="hidden" id="CED" name="CED">
                            </div>
                        </div>
                        <?php
                        ControladorUsuarios::ctrActualizarPerfil();
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="guardar" id="guardar">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>