<?php
		//define autoload realizando registro de instancia da classe
		require_once "autoload.php";

		use \classes\usuario\Usuario;

		$deleteSessionLoginUsuario = new Usuario();
		$deleteSessionLoginUsuario->deleteSessionLoginUsuario();
?>