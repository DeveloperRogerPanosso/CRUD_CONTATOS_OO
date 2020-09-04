<?php
		//define autoload realizando registro de instancia da classe e verificando
		//se arquivo com classe é existente
		require_once "autoload.php";

		use \classes\usuario\Usuario;

		$updateSenhaLoginUsuario = new Usuario();
		$updateSenhaLoginUsuario->setUsuario(filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS));
		$updateSenhaLoginUsuario->setSenha(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS));
		echo "<pre>";
		print_r($updateSenhaLoginUsuario);
		//executa metodo obtendo conexão com DB e realizando atualização de senha
		//de acordo com usuario informado
		$updateSenhaLoginUsuario->updateSenhaLoginUsuario();
?>