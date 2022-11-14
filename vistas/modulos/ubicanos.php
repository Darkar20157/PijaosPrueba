<div class="main-container">
    <a href="dashboardCliente" class="btn-esc">Esc</a>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5>Puntos de Venta</h5>
                <!--<iframe src="https://www.google.com/maps/d/u/1/embed?mid=17sTCfseKd2_0EbsTXuR2MvoAvfL82GPi&ehbc=2E312F" width="1000" height="480"></iframe>-->
            </div>
            <div class="col-12">
                
                <style>
                    #map{
                        height: 100%;
                    }
                </style>
                <div id="map" style="width: 100%; height: 80vh;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5 id="myGPS">Mi ubicacion: </h5>
                <button class="btn btn-primary" onclick="ubicame()">Ubicame</button>
            </div>
        </div>
    </div>
</div>