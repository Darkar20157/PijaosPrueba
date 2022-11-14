<?php
class Conex{
public static function conexionServer(){
		$conex = oci_connect("server2020", "server2022*", '10.0.102.185/xe');
		return $conex;
	}
}
?>