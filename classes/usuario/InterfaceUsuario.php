<?php
		//define namespace para interface seguindo nomenclatura de seu diretorio(pastas)
		//facilitando processo de carregamento automatico(autoload)
		namespace classes\usuario;

		interface ProcedimentosUsuario {
			public function setUsuario(string $usuario);
			public function getUsuario() : string;
			public function setSenha(string $senha);
			public function getSenha() : string;
			public function insertUsuario();
			public function validarLoginUsuario();
			public function deleteSessionLoginUsuario();
			public function updateSenhaLoginUsuario();
		}
?>