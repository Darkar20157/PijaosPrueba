<?php
$resultado = ControladorProducto::ctrConsultarProducto();
$i = 0;
while($row = oci_fetch_assoc($resultado)){
    $array[$i] = array("IDE_PRODUCTO" => $row['IDE_PRODUCTO'], "DES_PRODUCTO" => $row['DES_PRODUCTO']);
    $i = $i + 1;
}
?>
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <h3><img src="https://img.icons8.com/external-icongeek26-flat-icongeek26/28/ffffff/external-coin-netherlands-icongeek26-flat-icongeek26.png"/> Parametrizacion de Puntos</h3>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="col">
                    <h4>Imagen de Venta</h4>
                    <input class="form-control" type="file" id="photo" name="photo" onchange="getImage(event)">
                    <label class="photo-view" for="photo">
                        <div class="preview">
                            <img src="https://img.icons8.com/cute-clipart/120/000000/add-image.png"/>
                        </div>
                    </label>
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="col">
                    <h4>Producto</h4>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="producto" id="producto" style="width: 100%;">
                            <option value="">Selecciona una Opcion</option>
                            <?php
                            for ($i=0; $i < count($array); $i++) { 
                            ?>
                            <option value="<?php echo $array[$i]['IDE_PRODUCTO']?> - <?php echo $array[$i]['DES_PRODUCTO']?>"><?php echo $array[$i]['IDE_PRODUCTO']?> - <?php echo $array[$i]['DES_PRODUCTO']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3" id="col">
                    <h4>Valor del Promocional</h4>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="number" name="title" id="title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-11 col-lg-3 col-xl-3 col-xxl-3" id="col">
                    <h4>Puntos</h4>
                    <label for="puntos" class="form-label">Puntos</label> <span class="badge bg-primary" id="punt">50</span>
                    <input type="range" class="form-range" min="0" max="10000" id="points" name="points">
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="col">
                    <h4>Fecha Inicial</h4>
                    <input class="form-control" type="date" id="dateStart" name="dateStart">
                </div>
                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="col">
                    <h4>Fecha Final</h4>
                    <input class="form-control" type="date" id="dateEnd" name="dateEnd">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4" id="col">
                    <h4>Cantidad</h4>
                    <label for="puntos" class="form-label">Cantidad</label> <span class="badge bg-success" id="cant">50</span>
                    <input type="range" class="form-range" min="0" max="100" id="amount" name="amount">
                </div>
                <div class="col-xs-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7" id="col">
                    <h4>Descripcion</h4>
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                        <label for="descripcion">Descripcion</label>
                    </div>
                    <button class="btn btn-success" style="text-align: center; width: 100%; font-size: 15px; margin-top: 10px" name="subir">Subir Promocional</button>
                </div>
            </div>
        </form>
        <?php
            $controller = ControladorPuntos::ctrPromocionales();
        ?>
    </div>
</div>