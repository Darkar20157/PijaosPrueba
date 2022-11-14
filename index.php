<?php
	// Controladores
	require_once "controladores/plantilla.controlador.php";
	require_once "controladores/usuarios.controlador.php";
	require_once "controladores/puntos.controlador.php";
	require_once "controladores/publicaciones.controlador.php";
	require_once "controladores/verificarpuntos.controlador.php";
	require_once "controladores/validarcuentas.controlador.php";
	require_once "controladores/producto.controlador.php";
	// Modelos
	require_once "modelos/conexion.php";
	require_once "modelos/usuarios.modelo.php";
	require_once "modelos/puntos.modelo.php";
	require_once "modelos/publicaciones.modelo.php";
	require_once "modelos/verificarpuntos.modelo.php";
	require_once "modelos/validarcuentas.modelo.php";
	require_once "modelos/producto.modelo.php";


	$plantilla = new ControladorPlantilla();
	$plantilla->ctrPlantilla();

?>