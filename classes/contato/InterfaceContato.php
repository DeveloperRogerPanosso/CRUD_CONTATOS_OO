<?php
		//define namespace para interface seguiindo nomenclatura de suas (pastas) 
		//para facilitar processo de carregamento automatico(autoloader)
		namespace classes\contato;

		interface ProcedimentosContato {
			public function setNome(string $nome);
			public function getNome() : string;
			public function setEmail(string $email);
			public function getEmail() : string;
			public function setTelefone(string $telefone);
			public function getTelefone() : string;
			public function insertContato();
			public function getContatosAll();
			public function getContatoId();
			public function updateContato();
			public function deleteContato();
		}
?>