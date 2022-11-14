<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <h2><img src="https://img.icons8.com/fluency/38/undefined/loyalty-card.png"/> Parametrizacion de Promociones</h2>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-12 col-xl-12 col-xxl-12" id="col">
                    <h2>Imagen de Venta</h2>
                    <input class="form-control" type="file" id="photo" name="photo" onchange="getImage(event)">
                    <label class="photo-view" for="photo">
                        <div class="preview">
                            <img src="https://img.icons8.com/cute-clipart/120/000000/add-image.png"/>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5" id="col">
                    <h2>Titulo de la Promocion</h2>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="title" id="title">
                    </div>
                </div>
                <div class="col-xs-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5" id="col">
                    <h2>Puntos</h2>
                    <label for="puntos" class="form-label">Puntos</label> <span class="badge bg-primary" id="punt">50</span>
                    <input type="range" class="form-range" min="0" max="1000" id="points" name="points">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5" id="col">
                    <h2>Fecha Inicial</h2>
                    <input class="form-control" type="date" id="dateStart" name="dateStart">
                </div>
                <div class="col-xs-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5" id="col">
                    <h2>Fecha Final</h2>
                    <input class="form-control" type="date" id="dateEnd" name="dateEnd">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12" id="col">
                    <h2>Descripcion</h2>
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                        <label for="descripcion">Descripcion</label>
                    </div>
                    <br>
                    <button class="btn btn-success" style="text-align: center; width: 100%" name="subir">Subir Promocional</button>
                </div>
            </div>
        </form>
        <?php
            $controller = ControladorPuntos::ctrSubirPromociones();
        ?>
    </div>
</div>