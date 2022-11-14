<?php
class ControladorProducto{
    public static function ctrRegistrarProducto(){
        if(isset($_POST['registrar'])){
            $serie = $_POST['serie'];
            $colilla = $_POST['colilla'];
            $idProductoArray = $_POST['producto'];
            $idProductoArray = explode(" ", $idProductoArray);
            $idProducto = $idProductoArray[0];
            $nomProducto = $idProductoArray[1];
            $cedula = $_POST['cedula'];
            //$area = $_POST['area'];
            $estado = 0;
            //RASPA
            if($idProducto == 24444){
                $valor = $_POST['valor'];
                $puntos = ($valor * 11) / 100;
                $puntos = ($puntos * 0.61) / 100;
                $puntos = $puntos / 10;
                //$puntos = ceil($puntos);

            //BALOTO
            }elseif($idProducto == 12072){
                $valor = $_POST['valor'];
                $puntos = ($valor * 6) / 100;
                $puntos = ($puntos * 0.61) / 100;
                $puntos = $puntos / 10;
                //$puntos = ceil($puntos);
            //CELSIA
            }elseif($idProducto == 6780){
                $valor = $_POST['valor'];
                $puntos = 1;
            }
            $respuesta = ModeloProducto::mdlRegistrarProducto($serie, $colilla, $idProducto, $nomProducto, 
            $cedula, $estado, $puntos, $valor);
            $respuesta = "Correcto";
            if($respuesta == "Correcto"){
                $respuesta2 = ModeloProducto::mdlInsertarPuntos($cedula, $puntos);
                if($respuesta2){
                    echo "<script>
                    Swal.fire(
                        'Correcto',
                        'Acabas de registrar tu producto',
                        'success'
                    )
                    setTimeout(function(){
                        window.location.href = 'registrarProducto'
                    }, 2000)
                    </script>";
                }else{
                    echo "<script>
                    Swal.fire(
                        'Ups',
                        'Algo sucedio intenta mas tarde',
                        'error'
                    )
                    setTimeout(function(){
                        window.location.href = 'dashboardCliente'
                    }, 2000)
                    </script>";
                }
            }else{
                echo "<script>
                Swal.fire(
                    'Ups',
                    'Algo sucedio intenta mas tarde',
                    'error'
                )
                setTimeout(function(){
                    window.location.href = 'dashboardCliente'
                }, 2000)
                </script>";
            }
        }
    }
    public static function ctrConsultarProducto(){
        $table = "GANA_SIGA.SIGT_PRODUCTOS";
        $item1 = "ACTIVO";
        $item2 = "S";
        $resultado = ModeloProducto::mdlConsultarProducto($table, $item1, $item2);
        if($resultado == "error"){
            return "error";
        }else{
            return $resultado;
        }
    }
}
?>