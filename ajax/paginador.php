<?php
require_once "../modelos/conexion.php";
if(isset($_POST['id1'])){
    $id1 = $_POST['id1'];
    Paginador::ctrPaginandoPromo($id1);
}elseif(isset($_POST['id2'])){
    $id2 = $_POST['id2'];
    Paginador::ctrPaginando($id2);
}elseif(isset($_POST['idDelete1'])){
    $id1 = $_POST['idDelete1'];
    Paginador::ctrEliminarPromo($id1);
}elseif(isset($_POST['idDelete2'])){
    $id2 = $_POST['idDelete2'];
    Paginador::ctrEliminarPromocion($id2);
}

class Paginador{
    public static function ctrPaginandoPromo($id1){
        $por_pagina = 3;
        $pagina = $id1;
        $empieza = ($pagina-1) * $por_pagina;
        $por_pagina = $por_pagina * $pagina;
        $table = "PROMOCIONES";
        Paginador::mdlPaginadorPromo($table, $empieza, $por_pagina);
    }
    public static function ctrPaginando($id2){
        $por_pagina = 3;
        $pagina = $id2;
        $empieza = ($pagina-1) * $por_pagina;
        $por_pagina = $por_pagina * $pagina;
        $table = "PROMO_PRODUCT";
        Paginador::mdlPaginador($table, $empieza, $por_pagina);
    }
    /*==================================
        Productos
    ====================================*/
    public static function ctrEliminarPromo($id){
        $table = "PROMO_PRODUCT";
        Paginador::mdlElimnarPromo($table, $id);
    }
    /*==================================
        Promociones
    ====================================*/
    public static function ctrEliminarPromocion($id){
        $table = "PROMOCIONES";
        Paginador::mdlElimnarPromocion($table, $id);
    }
    /*==================================
        Productos
    ====================================*/
    private static function mdlPaginador($table ,$empieza, $por_pagina){
        $sql = "WITH PAGINADOR AS (
            SELECT
            ROWNUM AS FILA,
            ID,
            FOTO,
            VALOR_PESOS,
            VALOR_PUNTOS,
            FECHA_INICIAL,
            FECHA_FINAL,
            CANTIDAD,
            ESTADO,
            DESCRIPCION
            FROM
            $table
            ORDER BY FILA ASC
        )
        SELECT * FROM PAGINADOR WHERE FILA >= $empieza+1 AND FILA <= $por_pagina";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            while($row = oci_fetch_array($consult, OCI_ASSOC)){
            ?>
            <div class="col-md-12 col-lg-5 col-xl-3 col-xxl-3" id="col">
                <div class="card-delete" onclick="eliminarPromo1(<?php echo $row['ID'] ?>)">
                    <img src="https://img.icons8.com/ios-filled/30/ffffff/delete-sign--v1.png"/>   
                </div>
                <div class="main-card">
                    <div class="card-img">
                        <img src="./vistas/imgPromociones/<?php echo $row['FOTO'] ?>" width="160" height="120">
                    </div>
                    <div class="card-content">
                        <div class="title-card">
                            <h5><?php echo $row['VALOR_PESOS']; ?></h5>
                            <h6>Points: <?php $row['VALOR_PUNTOS']; ?></h6>
                        </div>
                        <div class="body-card">
                            <p><?php echo $row['DESCRIPCION']; ?></p>
                            <small>Cant. <?php echo $row['CANTIDAD']; ?></small>
                        </div>
                        <div class="footer-card">
                            <small>Valido desde: <?php echo $row['FECHA_INICIAL']; ?></small>
                            <small>Valido hasta: <?php echo $row['FECHA_FINAL'] ?></small>
                        </div>                        
                    </div>
                </div>
            </div>
        <?php
            }
        }
    }
    /*==================================
        Promociones
    ====================================*/
    private static function mdlPaginadorPromo($table, $empieza, $por_pagina){
        $sql = "WITH PAGINADOR AS (
            SELECT
            ROWNUM AS FILA,
            ID,
            FOTO,
            TITULO,
            DESCRIPCION,
            FECHA_INICIAL,
            FECHA_FINAL,
            ESTADO,
            PUNTOS,
            FECHA_CREACION
            FROM
            $table
            ORDER BY FILA ASC
        )
        SELECT * FROM PAGINADOR WHERE FILA >= $empieza+1 AND FILA <= $por_pagina";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            while($row = oci_fetch_array($consult, OCI_ASSOC)){
            ?>
            <div class="col-md-12 col-lg-5 col-xl-3 col-xxl-3" id="col">
                <div class="card-delete" onclick="eliminarPromo2(<?php echo $row['ID'] ?>)">
                    <img src="https://img.icons8.com/ios-filled/30/ffffff/delete-sign--v1.png"/>   
                </div>
                <div class="main-card">
                    <div class="card-img">
                        <img src="./vistas/imgPromociones/<?php echo $row['FOTO'] ?>" width="160" height="120">
                    </div>
                    <div class="card-content">
                        <div class="title-card">
                            <h3><?php echo $row['TITULO']; ?></h3>
                            <h4>Points: <?php echo $row['PUNTOS']; ?></h4>
                        </div>
                        <div class="body-card">
                            <p><?php echo $row['DESCRIPCION']; ?></p>
                        </div>
                        <div class="footer-card">
                            <small>Valido desde: <?php echo $row['FECHA_INICIAL']; ?></small>
                            <small>Valido hasta: <?php echo $row['FECHA_FINAL'] ?></small>
                        </div>                        
                    </div>
                </div>
            </div>
        <?php
            }
        }
    }
    /*===================================
        Productos
    =====================================*/
    private static function mdlElimnarPromo($table, $id){
        $sql = "DELETE FROM $table WHERE ID = $id";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            echo "Correcto";
        }else{
            echo "Error";
        }
    }
    /*===================================
        Promociones
    =====================================*/
    private static function mdlElimnarPromocion($table, $id){
        $sql = "DELETE FROM $table WHERE ID = $id";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            echo "Correcto";
        }else{
            echo "Error";
        }
    }
}
?>