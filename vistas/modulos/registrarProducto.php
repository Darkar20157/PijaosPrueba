<div class="main-container">
    <a href="dashboardCliente" class="btn-esc">Esc</a>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5>Registrar Productos</h5>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="POST">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h5 style="font-size: .9rem;">Seleccione Producto</h5>
                    <select class="form-select" name="producto" id="producto" tabindex="-1" aria-disabled="true">
                        <option value="">Seleccione una Opcion</option>
                        <option value="12072 BALOTO">Baloto</option>
                        <option value="24444 RASPA">Raspa</option>
                        <option value="6780 CELSIA">Celsia</option>
                    </select>
                    <input type="hidden" name="cedula" id="cedula" value="<?php echo $_SESSION['CEDULA']; ?>">
                </div>
                <div class="col-12 col-md-4">
                    <h5 style="font-size: .9rem;">Serie</h5>
                    <input class="form-control" type="text" name="serie" id="serie">
                </div>
                <div class="col-12 col-md-4">
                    <h5 style="font-size: .9rem;">Colilla</h5>
                    <input class="form-control" type="number" name="colilla" id="colilla">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input type="hidden" name="valor" id="valor">
                    <button type="button" class="btn btn-success" style="font-size: .7rem;" onclick="validacionProducto()" id="validar">Validar datos</button>
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-12">
                    <h5 style="font-size: .9rem;">Area</h5>
                    <select style="font-size: .9rem" class="form-select" name="area" id="area">
                        <option style="font-size: .7rem" value="">Selecciona una Opcion</option>
                        <option style="font-size: .7rem" value="Comercial">Comercial</option>
                        <option style="font-size: .7rem" value="Aseguramiento y Control">Aseguramiento y Control</option>
                        <option style="font-size: .7rem" value="Femseapto">Femseapto</option>
                        <option style="font-size: .7rem" value="Talento Humano">Talento Humano</option>
                        <option style="font-size: .7rem" value="Estrategica">Estrategica</option>
                        <option style="font-size: .7rem" value="Compliance">Compliance</option>
                        <option style="font-size: .7rem" value="Abastecimiento">Abastecimiento</option>
                        <option style="font-size: .7rem" value="Sistemas y comunicaciones">Sistemas y comunicaciones</option>
                        <option style="font-size: .7rem" value="Financiera y Contable">Financiera y Contable</option>
                        <option style="font-size: .7rem" value="Integral">Integral</option>
                        <option style="font-size: .7rem" value="Susolucion">Susolucion</option>
                        <option style="font-size: .7rem" value="Juridica">Juridica</option>
                        <option style="font-size: .7rem" value="Negocios">Negocios</option>
                        <option style="font-size: .7rem" value="Invercomes">Invercomes</option>
                        <option style="font-size: .7rem" value="Operativa">Operativa</option>
                    </select>
                </div>
            </div>
            -->
            <div class="row">
                <div class="col-12" id="botonRegistrar">
                </div>
            </div>
            <?php
            ControladorProducto::ctrRegistrarProducto();
            ?>
        </form>
    </div>
</div>