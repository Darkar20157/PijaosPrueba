<div class="main-container">
    <?php
    //Paginador
    $por_pagina = 3;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <h3><img src="https://img.icons8.com/fluency/28/ffffff/upload-to-cloud.png"/> Publicaciones</h5>
            </div>
        </div>
        <div class="row" id="promos">
            <!-- CARDS -->
        </div>
        <div class="row">
            <div class="col" style="display: flex; justify-content: center">
                <?php
                $sql = "SELECT COUNT(*) AS TOTAL FROM PROMOCIONES";
                $consult = oci_parse(Conex::conexion(),$sql);
                $result = oci_execute($consult);
                $total_registros = oci_fetch_array($consult);
                $total_registros = $total_registros['TOTAL'];
                $total_paginacion = ceil($total_registros / $por_pagina);
                ?>
                <nav class="" aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        for ($i=0; $i < $total_paginacion; $i++){
                        ?>
                            <li class="page-item"><a class="page-link" style="cursor: pointer" onclick="paginar1(<?php echo $i+1 ?>)"><?php echo $i+1 ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <?php
    //Paginador
    $por_pagina = 3;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12" id="col">
                <h3><img src="https://img.icons8.com/cotton/28/ffffff/discount--v1.png"/> Productos Parametrizados</h3>
            </div>
        </div>
        <div class="row" id="productos">
            <!-- CARDS -->
        </div>
        <div class="row">
            <div class="col" style="display: flex; justify-content: center">
                <?php
                $sql = "SELECT COUNT(*) AS TOTAL FROM PROMO_PRODUCT";
                $consult = oci_parse(Conex::conexion(),$sql);
                $result = oci_execute($consult);
                $total_registros = oci_fetch_array($consult);
                $total_registros = $total_registros['TOTAL'];
                $total_paginacion = ceil($total_registros / $por_pagina);
                ?>
                <nav class="" aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        for ($i=0; $i < $total_paginacion; $i++){
                        ?>
                            <li class="page-item"><a class="page-link" style="cursor: pointer" onclick="paginar2(<?php echo $i+1 ?>)"><?php echo $i+1 ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>