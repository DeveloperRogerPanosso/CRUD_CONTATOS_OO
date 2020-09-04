<?php
		//define namespace para classe de acordo com nomenclatura de seu diretorio(pastas)
		//facilitando processo de carregamento automatico(autoload)
		namespace classes\usuario;

		//inicia sessão
		session_start();

		require_once "InterfaceUsuario.php";

		class Usuario implements ProcedimentosUsuario {
			private string $usuario;
			private string $senha;

			public function setUsuario(string $usuario) {
				if(isset($usuario) AND !empty($usuario) AND is_string($usuario)) {
					if(strlen($usuario) >= 8) {
						echo "Usuário Valido !!";
						$this->usuario = addslashes(htmlspecialchars(filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS))) ?? null;
						return true;
					}else {
						echo error_get_last();
						$_SESSION["usuario_invalido"] = "
						<div class='alert alert-danger fade show alert-dismissible alertDanger shadow-sm text-center' role='alert'>
							<span class='text text-light bd-lead text-center'>
								<a class='close' href='#' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
								O Endereço de Usuário deve comter cinco ou mais caracteres !!
							</span>
						</div>";
						header("Location: login.php");
						return false;
						exit;
					}
				}
			}
			public function getUsuario() : string {
				return $this->usuario ?? "Usuário não informado !!";
			}

			public function setSenha(string $senha) {
				if(isset($senha) AND !empty($senha) AND is_string($senha)) {
					if(strlen($senha) >= 5) {
						echo "Senha valida !!";
						$this->senha = addslashes(htmlspecialchars(md5(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS)))) ?? null;
						return true;
					}else {
						echo error_get_last();
						$_SESSION["senha_invalida"] = "
						<div class='alert alert-danger fade show alert-dismissible alertDanger shadow-sm text-center' role='alert'>
							<span class='text text-light bd-lead text-center'>
								<a class='close' href='#' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
								A Senha deve comter cinco ou mais caracteres !!
							</span>
						</div>";
						header("Location: login.php");
						return false;
						exit;
					}
				}
			}
			public function getSenha() : string {
				return $this->senha ?? "Senha não informada !!";
			}

			//define metodo auxiliar privado auxiliando na propriedade intern $usuario
			private function usuarioExists() {
				require "include/connect_mysql.php";
				$query = "SELECT * FROM login_usuario WHERE usuario = :usuario";
				$query = $connect->prepare($query);
				$usuario = $this->usuario;
				$query->bindValue(":usuario", $usuario);
				$query->execute();

				//testa se consulta obteve valor de retorno igual a zero para assim ser
				//adicionado usuario unico
				if($query->rowCount() === 0) {
					echo "Usuário a ser adicionado !!";
					return true;
				}else {
					$_SESSION["usuario_existente"] = "
					<div class='alert alert-danger fade show alert-dismissible alertDanger shadow-sm text-center' role='alert'>
						<span class='text text-light bd-lead text-center'>
							<a class='close' href='#' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
							Endereço de Usuário já existente. Redefina Por Favor !!
						</span>
					</div>";
					header("Location: login.php");
					return false;
				}
			}

			//define metodo inserindo cadastro de usuario
			public function insertUsuario() {
				require "include/connect_mysql.php";
				if($this->usuarioExists() === true) {
					$query = "INSERT INTO login_usuario (usuario,senha) VALUES (:usuario, :senha)";
					$query = $connect->prepare($query);
					$usuario = $this->usuario;
					$senha = $this->senha;
					$query->bindValue(":usuario", $usuario);
					$query->bindValue(":senha", $senha);
					$query->execute();

					if(isset($query) AND is_object($query) AND $query == true) {
						echo "Consulta realizada com suscesso !!";
					}else {
						echo "Erro: " . $connect->errorInfo();
						exit;
					}

					if($query->rowCount() > 0) {
						$_SESSION["cadastro_usuario"] = "
						<div class='alert alert-success fade show alert-dismissible alertSuccess shadow-sm text-center' role='alert'>
							<span class='text text-light bd-lead text-center'>
								<a class='close' href='#' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
								Usuário Cadastrado com Suscesso !!
							</span>
						</div>";
						header("Location: login.php");
						return true;
						exit;
					}else {
						echo "<span class='text text-danger bd-lead'>Não há cadastro de usuarios !!</span>";
						return false;
						exit;
					}
				}
			}

			//define metodo validando login de usuario
			public function validarLoginUsuario() {
				require "include/connect_mysql.php";
				$query = "SELECT * FROM login_usuario WHERE usuario = :usuario AND senha = :senha";
				$query = $connect->prepare($query);
				$usuario = $this->usuario;
				$senha = $this->senha;
				$query->bindValue(":usuario", $usuario);
				$query->bindValue(":senha", $senha);
				$query->execute();

				if(isset($query) AND is_object($query) AND $query == true) {
					echo "Consulta realizada com suscesso !!";
				}else {
					echo "Erro: " . $connect->errorInfo();
					exit;
				}

				//testa se consulta obteve valor de retorno maior que 0 e seleciona dados de usuario
				//de acordo com usuario e senha informado em login através do metodo de seleção unico
				//fetch();
				if($query->rowCount() > 0) {
					$informacoesUsuario = $query->fetch();
					//print_r($informacoesUsuario)

					//grava endereco de usuario na sessão de login 
					$_SESSION["login_usuario"] = $informacoesUsuario["usuario"];
					header("Location: index.php");
					return true;
					exit;
				}else {
					$_SESSION["login_invalido"] = "
					<div class='alert alert-danger fade show alert-dismissible alertDanger shadow-sm text-center' role='alert'>
						<span class='text text-light bd-lead text-center'>
							<a class='close' href='#' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
							Usuário ou Senha Incorretos !!
						</span>
					</div>";
					header("Location: login.php");
					return false;
					exit;
				}
			}

			//define metodo para exclusão de sessão de login de usuario
			public function deleteSessionLoginUsuario() {
				if(isset($_SESSION["login_usuario"]) AND !empty($_SESSION["login_usuario"])) {
					session_destroy();
					unset($_SESSION["login_usuario"]);
					header("Location: login.php");
					return true;
					exit;
				}else {
					return false;
					exit;
				}
			}

			//define metodo para atualização de senha de login de usuario
			public function updateSenhaLoginUsuario() {
				require "include/connect_mysql.php";
				$query = "UPDATE login_usuario SET senha = :senha WHERE usuario = :usuario";
				$query = $connect->prepare($query);
				$usuario = $this->usuario;
				$senha = $this->senha;
				$query->bindValue(":senha", $senha);
				$query->bindValue(":usuario", $usuario);
				$query->execute();

				if(isset($query) AND is_object($query) AND $query == true) {
					echo "Consulta realizada com suscesso !!";
				}else {
					echo "Erro: " . $connect->errorInfo();
					exit;
				}

				//testa se consulta obteve valor de retorno maior que 0 e define sessão 
				//de atualização de senha de login de usuario
				if($query->rowCount() > 0) {
					$_SESSION["update_senha_login_usuario"] = "
					<div class='alert alert-success fade show alert-dismissible alertSuccess shadow-sm text-center' role='alert'>
						<span class='text text-light bd-lead text-center'>
							<a class='close' href='#' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
							Senha Atualizada com suscesso. Em Usuário: $usuario !!
						</span>
					</div>";
					header("Location: login.php");
					return true;
					exit;
				}else {
					echo "<span class='text text-danger bd-lead'>Não há dados de usuarios para atualização de senha !!</span>";
					return false;
					exit;
				}
			}
		}
?>