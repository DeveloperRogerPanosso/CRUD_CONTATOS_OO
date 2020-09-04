<?php
		//define autoload realizando registro de instancia da classe
		require_once "autoload.php";

		use \classes\usuario\Usuario;

		$loginUsuario = new Usuario();
		$loginUsuario->setUsuario(filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS));
		$loginUsuario->setSenha(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS));
		echo "<pre>";
		print_r($loginUsuario);
		//define metodo executando validação de login de usuario
		$loginUsuario->validarLoginUsuario();
?>