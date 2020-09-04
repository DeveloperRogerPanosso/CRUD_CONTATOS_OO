<?php
		//define autoload
		require_once "autoload.php";

		use \classes\contato\Contato;

		$deleteContato = new Contato();
		$deleteContato->deleteContato();
?>