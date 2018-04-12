<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once("db/conectar.php");
	require_once("models/clientes_model.php");
	require_once("models/contactos_model.php");
	require_once("controllers/clientes_controller.php");
	
	new Controller();
?>