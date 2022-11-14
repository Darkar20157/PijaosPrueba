<?php
date_default_timezone_set("America/Bogota");
class ControladorPuntos{
    public static function ctrPromocionales(){
        if(isset($_POST['subir'])){
            /*---------------------------
            Codicionales para las fotos
            -----------------------------*/
            $nombreFoto = $_FILES['photo']['name'];
            $archivoFoto = $_FILES['photo']['tmp_name'];
            $tipoFoto = $_FILES['photo']['type'];
            $tamanoPhoto = $_FILES['photo']['size'];
            /*---------------------------
            Variables del formulario
            -----------------------------*/
            $producto = $_POST['producto'];
            $producto = explode("-", $producto);
            $idProducto = $producto[0];
            $nomProducto = $producto[1];
            $titulo = $_POST['title'];
            $puntos = $_POST['points'];
            $fechaInicial = $_POST['dateStart'];
            $fechaFinal = $_POST['dateEnd'];
            $cantidad = $_POST['amount'];
            $estado = 1;
            $descripcion = $_POST['description'];
            if(strlen($nombreFoto) <= 30 && $tamanoPhoto <= 2000000){
                if($tipoFoto == "image/jpg" || $tipoFoto == "image/jpeg" || $tipoFoto == "image/png"){
                    $ruta = "./vistas/imgPromociones";
                    $ruta = $ruta."/".$nombreFoto;
                    move_uploaded_file($archivoFoto, $ruta);
                    $table = "PROMO_PRODUCT";
                    $respuesta = ModeloPuntos::mdlSubirPromocionales($nombreFoto, $idProducto, $nomProducto, 
                    $titulo, $puntos, $fechaInicial, $fechaFinal, $cantidad, $estado, $descripcion, $table);
                    if($respuesta == true){
                        echo "<script>
                                Swal.fire(
                                'Buen Trabajo',
                                'Tu publicacion promocional se ha subido correctamente',
                                'success'
                                )
                                setTimeout(function(){
                                window.location.href = 'parametrizacion';
                                },2000);
                            </script>";
                    }else{
                        echo "Ocurrio algo";
                    }
                }else{
                    echo "Error";
                }
            }else{
                echo "<script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El tamaño o nombre de la foto es muy grande',
                        footer: 'Tamaño max: 20MB - Caracteres max: 30'
                        })
                    </script>";
            }
        }
    }
    public static function ctrSubirPromociones(){
        if(isset($_POST['subir'])){
            /*---------------------------
            Codicionales para las fotos
            -----------------------------*/
            $nombreFoto = $_FILES['photo']['name'];
            $archivoFoto = $_FILES['photo']['tmp_name'];
            $tipoFoto = $_FILES['photo']['type'];
            $tamanoPhoto = $_FILES['photo']['size'];
            /*---------------------------
            Variables del formulario
            -----------------------------*/
            $titulo = $_POST['title'];
            $puntos = $_POST['points'];
            $fechaInicial = $_POST['dateStart'];
            $fechaFinal = $_POST['dateEnd'];
            $estado = 1;
            $descripcion = $_POST['description'];
            if(strlen($nombreFoto) <= 30 && $tamanoPhoto <= 2000000){
                if($tipoFoto == "image/jpg" || $tipoFoto == "image/jpeg" || $tipoFoto == "image/png"){
                    $ruta = "./vistas/imgPromociones";
                    $ruta = $ruta."/".$nombreFoto;
                    move_uploaded_file($archivoFoto, $ruta);
                    $table = "PROMOCIONES";
                    $item1 = "FOTO";
                    $item2 = "TITULO";
                    $item3 = "DESCRIPCION";
                    $item4 = "FECHA_INICIAL";
                    $item5 = "FECHA_FINAL";
                    $item6 = "ESTADO";
                    $item7 = "PUNTOS";
                    $item8 = "FECHA_CREACION";
                    $respuesta = ModeloPuntos::mdlSubirPromociones($nombreFoto, $titulo, 
                    $puntos, $fechaInicial, $fechaFinal, $estado, $descripcion, $table,
                    $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8);
                    if($respuesta == true){
                        echo "<script>
                                Swal.fire(
                                'Buen Trabajo',
                                'Tu publicacion se ha subido correctamente',
                                'success'
                                )
                                setTimeout(function(){
                                window.location.href = 'publicaciones';
                                },2000);
                            </script>";
                    }else{
                        echo "Ocurrio algo";
                    }
                }else{
                    echo "Error";
                }
            }else{
                echo "<script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El tamaño o nombre de la foto es muy grande',
                        footer: 'Tamaño max: 20MB - Caracteres max: 30'
                        })
                    </script>";
            }
        }
    }
    public static function ctrMostrarPromocionales(){
        $table = "PROMO_PRODUCT";
        $item1 = "ESTADO";
        $item2 = "FECHA_INICIAL";
        $item3 = "FECHA_FINAL";
        $response = ModeloPuntos::mdlMostrarPromocionalesClientes($table, $item1, $item2, $item3);
        return $response;
    }
    public static function ctrMostrarPromociones($ced){
        $table = "PROMOCIONES";
        $item1 = "ESTADO";
        $item2 = "FECHA_INICIAL";
        $item3 = "FECHA_FINAL";
        $response = ModeloPuntos::mdlMostrarPromocionesClientes($table, $item1, $item2, $item3, $ced);
        return $response;
    }
    public static function ctrMostrarCodigoBarras($cedula){
        $table = "GANA_SIGA.SIGT_OBLIG_PAGOS_GENERICOS";
        $item1 = "FEC_CARGA";
        $item2 = "CAMPO_ADICIONAL_TRES";
        $item3 = $cedula;
        $response = ModeloPuntos::mdlConsultarUltimoCod($table, $item1, $item2, $item3);
        return $response;
    }
}

?>