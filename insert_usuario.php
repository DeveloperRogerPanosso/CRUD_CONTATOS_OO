<?php
		//define autoload realizando registro de instancia da classe
		require_once "autoload.php";

		use \classes\usuario\Usuario;

		$insertUsuario = new Usuario();
		$insertUsuario->setUsuario(filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS));
		$insertUsuario->setSenha(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS));
		echo "<pre>";
		print_r($insertUsuario);
		//executa metodo inserindo cadastro de usuario no DB
		$insertUsuario->insertUsuario();
?>