<?php
$respuesta = ControladorPuntos::ctrMostrarCodigoBarras($_SESSION['CEDULA']);
$array = array();
$i = 0;
while($row = oci_fetch_array($respuesta, OCI_ASSOC)){
    $fecha = explode(",", $row['FEC_CARGA']);
    $array[$i] = array("nom" => $row['CAMPO_ADICIONAL_CUATRO'],"pun" => $row['CAMPO_ADICIONAL_UNO'],
    "cod" => $row['NUM_DOCUMENTO'], "fecha" => $fecha[0], "est" => $row['PAGADA']);
    $i = $i + 1;
}
?>
<div class="main-container">
    <a href="dashboardCliente" class="btn-esc">Esc</a>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title">
                    <h3>Tu Codigo de Barras</h3>
                </div>
                <br>
                <div class="container-codBarras">
                    <input type="hidden" id="cod" value="<?php echo $array[0]['cod'] ?>">
                    <input type="hidden" id="fecha" value="<?php echo $array[0]['fecha'] ?>">
                    <div>
                        <h6 id="producto"></h6>
                        <div class="cod-barras" id="viewCod"></div>
                    </div>
                    <small class="fecha" id="mFecha"></small>
                </div>
                <button class="btn btn-success" onclick="mostrarCod('<?php echo $array[0]['nom'] ?>')">
                    <img src="https://img.icons8.com/ios/30/ffffff/circled-chevron-up.png"/> Ver mi ultimo codigo
                </button>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5>Historial Rendencion</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" id="col-cofig">
                <div class="timeline">
                <?php
                for ($i=1; $i < count($array); $i++){ 
                    $fechaHora = $array[$i]['fecha'];
                    $fecha = explode(" ",$fechaHora);
                ?>
                <!-- timeline time label -->
                    <div class="time-label">
                        <span class="badge bg-danger"><?php echo $fecha[0]; ?></span>
                    </div>
                    <div>
                        <!-- icono -->
                        <i class="fas fa-envelope bg-blue" style="background-color: blue">
                            <img src="https://img.icons8.com/ios/30/ffffff/barcode.png"/>
                        </i>
                        <div class="timeline-item">
                            <span class="time"><img src="https://img.icons8.com/fluency/30/ffffff/clock--v1.png"/><?php echo $fecha[1]; ?></span>
                            <h6 class="timeline-header">Redimiste: <?php echo $array[$i]['nom'] ?></h6>
                            <div class="timeline-body">
                                <h6>Mi codigo de barras es: </h6>
                                <input type="hidden" class="myCod" value="<?php echo $array[$i]['cod']; ?>">
                                <div class="codBarras" id="cod"><svg class="barcode" id='barcode2'></svg></div>
                            </div>
                            <div class="timeline-footer">
                                <?php
                                if($array[$i]["est"] == 'S'){
                                ?>
                                <span class="badge bg-danger" style="width: 100%">Finalizado</span>
                                <?php
                                }elseif($array[$i]["est"] == "N"){
                                ?>
                                <span class="badge bg-warning" style="width: 100%">Pendiente</span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                    <div>
                        <i class="fas fa-clock bg-gray">
                            <img src="https://img.icons8.com/fluency/22/ffffff/clock--v1.png"/>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="myModal" id="myModal">
        <img id="close" src="https://img.icons8.com/color/48/ffffff/close-window.png"/>
        <svg class="myCode" id='barcode'></svg>
        <button class="btn btn-primary" id="screen"><img src="https://img.icons8.com/ios-filled/40/ffffff/screenshot.png"/></button>
    </div>
</div>
<br>
