<?php
class ModeloValidarCuentas{
    static public function mdlValidarCuentas($table, $item1, $item2, $ced, $estado){
        $sql = "UPDATE $table set $item1 = $estado WHERE $item2 = $ced";
        $consult = oci_parse(Conex::conexion(), $sql);
        $result = oci_execute($consult);
        if($result){
            $rows = oci_num_rows($consult);
            if($rows > 0){
              echo "<script>
                      Swal.fire({
                        icon: 'success',
                        title: 'Felicidades',
                        text: 'Ahora haces parte de Puntos GanaGana',
                        confirmButtonText: '¡Vale!',
                        confirmButtonColor: '#3085d6'
                      }).then((result) => {
                        if(result.isConfirmed) {
                          window.location.href = 'salir';
                        }
                      })
                    </script>";
            }
        }
    }
    static public function mdlConsultCuenta($table, $item1, $ced){
      $sql = "SELECT * FROM $table WHERE $item1 = $ced";
      $consult = oci_parse(Conex::conexion(), $sql);
      $result = oci_execute($consult);
      $response = oci_fetch_assoc($consult);
      oci_free_statement($consult);
      oci_close(Conex::conexion());
      return $response;
    }
}
?>