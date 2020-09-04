<?php
		//define autoload
		require_once "autoload.php";

		use \classes\contato\Contato;

		$insertContato = new Contato();
		$insertContato->setNome(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS));
		$insertContato->setEmail(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
		$insertContato->setTelefone(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS));
		echo "<pre>";
		print_r($insertContato);
		//executa metodo obtenco conexão ao DB e realizando inserção de contato
		$insertContato->insertContato();
?>