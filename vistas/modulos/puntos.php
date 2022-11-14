<?php
$respuesta = ctrValidarPuntosUsuarios::validacion($_SESSION['CEDULA']);
/*===================
Actualizar puntos BD
=====================*/
if($respuesta != false){
    ctrValidarPuntosUsuarios::almacenarValidacion($respuesta);   
}
$consult = ControladorPuntos::ctrMostrarPromocionales();
?>
<div class="main-container">
    <a href="dashboardCliente" class="btn-esc">Esc</a>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="title">
                    <h3>Mis puntos</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="input-group-label">
                    <label for="puntos"><img src="https://img.icons8.com/external-icongeek26-flat-icongeek26/28/ffffff/external-coin-netherlands-icongeek26-flat-icongeek26.png"/></label>
                    <input class="points" type="text" id="puntos" name="puntos" disabled>
                    <input type="hidden" id="ced" value="<?php echo $_SESSION['CEDULA']; ?>">
                    <input type="hidden" id="nom" value="<?php echo $_SESSION['NOMBRE']; ?>">
                </div>
            </div>
        </div>
    </div>
    <!--=============================    
    Carrousel
    =================================-->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="title-premios-mayores">Premios mayores</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="100000">
                            <img src="./vistas/img/publicidad1.jpg" class="d-block w-100" >
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--=============================    
    Cards de promocionales
    =================================-->
    <br>
    <div class="container">
        <div class="row">
            <?php
            while($row = oci_fetch_array($consult, OCI_ASSOC)){
                ?>
                <div class="col-6 col-xs-6 col-lg-4 col-xl-4 col-xxl-4">
                    <div class="main-card">
                        <div class="card-img">
                            <img src="./vistas/imgPromociones/<?php echo $row['FOTO']; ?>">
                        </div>
                        <div class="card-content">
                            <div class="title-card">
                                <h5>Valor: $<?php echo $row['VALOR_PESOS']; ?></h5>
                            </div>
                            <div class="card-puntos">
                                <h6>Puntos: <?php echo $row['VALOR_PUNTOS']; ?></h6>
                            </div>
                            <div class="body-card">
                                <p><?php echo $row['DESCRIPCION']; ?></p>
                                <small>Disponibles. <?php echo $row['CANTIDAD']; ?></small>
                            </div>
                            <div class="button-card">
                                <button class="btn btn-primary" onclick="validarPuntos(
                                                                        <?php echo $row['ID']; ?>, 
                                                                        '<?php echo $row['VALOR_PESOS']; ?>',
                                                                        '<?php echo $_SESSION['CORREO']; ?>'
                                                                        )" >Redimir</button>
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
</div>
<br>