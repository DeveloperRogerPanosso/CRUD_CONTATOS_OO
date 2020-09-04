<?php
		//define autoload
		require_once "autoload.php";

		use \classes\contato\Contato;

		$updateContato = new Contato();
		$updateContato->setNome(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));
		$updateContato->setEmail(filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS));
		$updateContato->setTelefone(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS));
		echo "<pre>";
		print_r($updateContato);
		$updateContato->updateContato();
?>