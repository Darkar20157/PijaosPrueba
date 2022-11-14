<?php
class Conex{
public static function conexion(){
		$conex = oci_connect("GANAPOINTS", "4dmin123*", '10.0.102.185/xe', "AL32UTF8");
		return $conex;
	}
}
?>