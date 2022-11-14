<?php
class Conex{
  public static function conexion(){
		$conex = oci_connect("GANAPOINTS", "admin123", '10.0.102.185/xe');
		return $conex;
	}
}
