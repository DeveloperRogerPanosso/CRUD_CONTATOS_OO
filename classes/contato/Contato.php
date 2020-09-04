<?php
		//define namespace para classe seguiindo nomenclatura de suas (pastas) 
		//para facilitar processo de carregamento automatico(autoloader)
		namespace classes\contato;

		require_once "InterfaceContato.php";

		class Contato implements ProcedimentosContato {
			private string $nome;
			private string $email;
			private string $telefone;

			public function setNome(string $nome) {
				if(isset($nome) AND !empty($nome) AND is_string($nome)) {
					if(strlen($nome) >= 3 AND str_word_count($nome) > 1) {
						echo "Nome completo valido !!" . " - ";
						$this->nome = addslashes(htmlspecialchars(ucwords(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS)))) ?? null;
						return true;
					}else {
						echo error_get_last();
						echo "<script>window.alert('Nome informado invalido !!')</script>";
						header("Location:index.php");
						return false;
						exit;
					}
				}
			}
			public function getNome() : string {
				return $this->nome ?? "Nome não informado !!";
			}

			public function setEmail(string $email) {
				if(isset($email) AND !empty($email) AND is_string($email)) {
					if(strlen($email) >= 8) {
						echo "E-Mail valido !!" . " - ";
						$this->email = addslashes(htmlspecialchars(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL))) ?? null;
						return true;
					}else {
						echo error_get_last();
						echo "<script>window.alert('E-Mail informado Invalido !!')</script>";
						header("Location: index.php");
						return false;
						exit;
					}
				}
			}
			public function getEmail() : string {
				return $this->email ?? "E-Mail não informado !!";
			}

			public function setTelefone(string $telefone) {
				if(isset($telefone) AND !empty($telefone) AND is_string($telefone)) {
					if(strlen($telefone) > 15) {
						echo error_get_last();
						echo "<script>window.alert('Telefone informado invalido !!')</script>";
						header("Location: index.php");
						return false;
						exit;
					}else {
						echo "Telefone valido !!" . " - ";
						$this->telefone = addslashes(htmlspecialchars(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS))) ?? null;
						return true;
					}
				}
			}
			public function getTelefone() : string {
				return $this->telefone ?? "Telefone não informado !!";
			}

			//define metodo auxiliar privado auxiliando na propriedade interna $email
			private function emailExists() {
				require "include/connect_mysql.php";
				$query = "SELECT * FROM contatos WHERE email = :email";
				$query = $connect->prepare($query);
				$email = $this->email;
				$query->bindValue(":email", $email);
				$query->execute();

				if(isset($query) AND is_object($query) AND $query == true) {
					echo "Consulta realizada com suscesso !!" . "<br>\n";
				}else {
					echo "Erro: " . $connect->errorInfo();
					exit;
				}

				//testa se consulta obteve retorno de 0 registros para assim então adicionar
				//email unico
				if($query->rowCount() === 0) {
					echo "E-Mail a ser adicionado !!";
					return true;
				}else {
					//define sessão de email ja existente
					session_start();
					$_SESSION["email_existente"] = "
					<div class='alert alert-danger fade show alert-dismissible text-center alertDanger shadow-sm' role='alert'>
						<span class='text text-light bd-lead text-center'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Endereço de E-Mail informado já existente. Redefina Por Favor !!
						</span>
					</div>";
					header("Location: select_contatos.php");
					return false;
					exit;
				}
			}

			//define metodo para inserção de contato
			public function insertContato() {
				require "include/connect_mysql.php";
				if($this->emailExists() == true) {
					$query = "INSERT INTO contatos (nome,email,telefone) VALUES (:nome, :email, :telefone)";
					$query = $connect->prepare($query);
					$nome = $this->nome;
					$email = $this->email;
					$telefone = $this->telefone;
					$query->bindValue(":nome", $nome);
					$query->bindValue(":email", $email);
					$query->bindValue(":telefone", $telefone);
					$query->execute();

					if(isset($query) AND is_object($query) AND $query == true) {
						echo "Consulta realizada com suscesso !!" . "<br>\n";
					}else {
						echo "Erro: " . $connect->errorInfo;
					}

					//testa se quantidade de registros na table de contatos é maior que 0
					//e define sessão de cadastro de contato
					if($query->rowCount() > 0) {
						session_start();
						$_SESSION["insert_contato"] = "
						<div class='alert alert-success fade show alert-dismissible text-center alertSuccess shadow-sm' role='alert'>
							<span class='text text-light bd-lead text-center'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'><span aria-hidden='true'>&times;</span></a>
								Contato adicionado com suscesso. Id do Registro: {$connect->LastInsertId()}
							</span>
						</div>";
						header("Location: select_contatos.php");
						return true;
						exit;
					}else {
						echo "<span class='text text-danger text-center bd-lead'>Não há dados de contato adicionados !!</span>";
						return false;
						exit;
					}
				}
			}

			//define metodo para seleção de dados de contatos
			public function getContatosAll() {
			?>
				<form name="ordenacao" method="GET">
					<div class="form-row">
						<div class="col-sm-3 order-1">
							<div class="form-group">
								<label class="text text-dark bd-lead form-label" for="Ordenar">Ordenar</label>
								<?php
									//estabelece conexão com MySQL
									require "include/connect_mysql.php";

									$ordenacao = addslashes(filter_input(INPUT_GET, "ordenacao", FILTER_SANITIZE_SPECIAL_CHARS));

									if(isset($ordenacao) AND !empty($ordenacao) AND is_string($ordenacao)) {
										//define query consulta select selecionando dados de contato de acordo com ordenacao selecionado
										$query = "SELECT * FROM contatos ORDER BY {$ordenacao} ASC";
									}else {
										$ordenacao = null;
										$query = "SELECT * FROM contatos ORDER BY id ASC";
									}
								?>
								<select name="ordenacao" class="form-control form-control-md borderInput" autocomplete="off" id="ordenacao" onchange="this.form.submit()">
									<option class="text text-dark bd-lead" value="id" <?=($ordenacao == "id")?"selected=selected":"";?>>Ordenar por Id</option>
									<option class="text text-dark bd-lead" value="nome" <?=($ordenacao == "nome")?"selected=selected":"";?>>Ordenar por Nome</option>
									<option class="text text-dark bd-lead" value="email" <?=($ordenacao == "email")?"selected=selected":""?>>Ordenar por E-Mail</option>
									<option class="text text-dark bd-lead" value="telefone" <?=($ordenacao == "telefone")?"selected=selected":"";?>>Ordenar por Telefone</option>
								</select>
							</div>
						</div>
					</div>
				</form>
				<strong>Total de Contatos: </strong>
				<?php
					//executa query 
					$query = $connect->query($query);
					$total_contatos = $query->rowCount();

					if(isset($total_contatos) AND $total_contatos > 0) {
						echo "<span class='text text-light bd-lead badge badge-primary badge-pill'>".$total_contatos."</span>";
					}else {
						echo "<span class='text text-light bd-lead badge badge-danger badge-pill'>".$total_contatos."</span>";
					}
				?>
				<div class="p-1"></div>
				<div class="table-responsive-sm">
					<table class="table table-striped table-hover table-condensed table-md">
						<caption class="text text-dark bd-lead font-italic">List Of Contacts</caption>
						<thead class="thead-dark text-center">
							<tr>
								<th scope="col" class="text text-light">#</th>
								<th scope="col" class="text text-light">Nome</th>
								<th scope="col" class="text text-light">E-Mail</th>
								<th scope="col" class="text text-light">Telefone</th>
								<th scope="col" class="text text-light"></th>
								<th scope="col" class="text text-light"></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(isset($query) AND is_object($query) AND $query == TRUE) {
									//echo "Consulta realizada com suscesso !!";
								}else {
									echo "Erro: " . $connect->errorInfo();
									exit;
								}

								//testa se consulta obteve retorno maior que 0 e seleciona dados de 
								//contatos
								if($query->rowCount() > 0) {
									$dadosContato = $query->fetchAll();
									//print_r($dadosContato);
									foreach ($dadosContato as $value) {
							?>
									<tr>
										<td class="text text-dark bd-lead text-center"><?=$value["id"];?></td>
										<td class="text text-dark bd-lead text-center"><?=$value["nome"];?></td>
										<td class="text text-dark bd-lead text-center"><?=$value["email"];?></td>
										<td class="text text-dark bd-lead text-center"><?=$value["telefone"];?></td>
										<td class="text text-dark bd-lead text-center">
											<a class='link-striped text-success' title="Atualizar" href="update.php?Id=<?=$value['id'];?>">Atualizar</a>
										</td>
										<td class="text text-dark bd-lead text-center">
											<a class='link-striped text-danger' title="Deletar" href="delete.php?Id=<?=$value['id'];?>">Deletar</a>
										</td>
									</tr>
							<?php
									}
								}else {
									echo "<span class='text text-danger bd-lead'>Não há dados de contatos !!</span>";
									return false;
								}
							?>
						</tbody>
					</table>
				</div>
			<?php
			}
			//define metodo para seleção de dados de contato especifico de acordo com id selecionado
			public function getContatoId() {
				require "include/connect_mysql.php";
				$id_contato = addslashes(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_SPECIAL_CHARS));
				if(isset($id_contato) AND !empty($id_contato) AND is_string($id_contato)) {
					//echo "Id recebido para seleção de contato !!" . "<br>\n";
					$query = "SELECT * FROM contatos WHERE id = :id_contato";
					$query = $connect->prepare($query);
					$query->bindValue(":id_contato", $id_contato);
					$query->execute();

					if(isset($query) AND is_object($query) AND $query == TRUE) {
						//echo "Consulta realizada com suscesso !!" . "<br>\n";
					}else {
						echo "Erro: " . $connect->errorInfo();
						exit;
					}

					//testa se consulta obteve valor de retorno maior que 0 e seleciona dados
					//de contato de acordo com id selecionado para atualização
					if($query->rowCount() > 0) {
						$informacoesContato = $query->fetch();
						//print_r($informacoesContato);
			?>
					<form name="update" role="update" method="POST" action="update_contato.php">
						<div class="form-row">
							<div class="col-sm-12 order-1">
								<div class="form-group">
									<label class="text text-dark bd-lead form-label" for="nome">Nome</label>
									<input type="hidden" name="id_contato" value="<?=$informacoesContato["id"];?>"/>
									<input type="text" name="nome" class="form-control form-control-md borderInput" autocomplete="off" value="<?=$informacoesContato["nome"];?>"/>
								</div>
							</div>
							<div class="col-sm-12 order-2">
								<div class="form-group">
									<label class="text text-dark bd-lead form-label" for="email">E-Mail</label>
									<input type="email" name="email" class="form-control form-control-md borderInput" autocomplete="off" value="<?=$informacoesContato["email"];?>"/>
								</div>
							</div>
							<div class="col-sm-12 order-3">
								<div class="form-group">
									<label class="text text-dark bd-lead form-label" for="telefone">Telefone</label>
									<input type="tel" name="telefone" class="form-control form-control-md borderInput" autocomplete="off" value="<?=$informacoesContato["telefone"];?>"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-6 order-1">
								<div class="form-group">
									<button type="submit" class="btn btn-success btn-md shadow-sm">Atualizar</button>
								</div>
							</div>
						</div>
					</form>
			<?php
					}else {
						echo "<span class='text text-danger bd-lead'>Não há dados relacionados !!</span>";
						return false;
					}
				}else {
					echo "<span class='text text-danger bd-lead'>Id não exisntete !!</span>";
					return false;
				}
			}

			//define metodo para atualização de contatos
			public function updateContato() {
				$id_contato = addslashes(filter_input(INPUT_POST, "id_contato", FILTER_SANITIZE_SPECIAL_CHARS));
				if(isset($id_contato) AND !empty($id_contato) AND is_string($id_contato)) {
					echo "Id recebido para atualização de contato !!" . "<br>\n";
					echo "Id para atualização: " . $id_contato . "<br>\n";
					require "include/connect_mysql.php";
					if($this->emailExists() === true) {
					$query = "UPDATE contatos SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id_contato";
					$query = $connect->prepare($query);
					$nome = $this->nome;
					$email = $this->email;
					$telefone = $this->telefone;
					$query->bindValue(":nome", $nome);
					$query->bindValue(":email", $email);
					$query->bindValue(":telefone", $telefone);
					$query->bindValue(":id_contato", $id_contato);
					$query->execute();

					if(isset($query) AND is_object($query) AND $query == true) {
						echo "Consulta realizada com suscesso !!" . "<br>\n";
					}else {
						echo "Erro: " . $connect->errorInfo();
						exit;
					}

					//testa se quantidade de registros na table de contatos é maior que 0
					//e define sessão de atualização de contato
					if($query->rowCount() > 0) {
						session_start();
						$_SESSION["update_contato"] = "
						<div class='alert alert-success fade show alert-dismissible alertSuccess text-center shadow-sm' role='alert'>
							<span class='text text-light bd-lead text-center'>
								<a href='#' class='close' data-dismiss='alert' aria-label='Fechar'><span aria-hidden='true'>&times;</span></a>
								Contato atualizado com suscesso. Em Id: $id_contato
							</span>
						</div>";
						header("Location: select_contatos.php");
						return true;
						exit;
					}else {
						echo "<span class='text text-danger bd-lead'>Não há dados para atualização de contatos !!</span>";
						header("Location: select_contatos.php");
						return false;
					}
				}
				}else {
					echo "<span class='text text-danger bd-lead'>Id não recebido para atualização de contato !!</span>";
					return false;
				}
			}

			//define metodo para exclusão de dados de acordo com id selecionado
			public function deleteContato() {
				require "include/connect_mysql.php";
				$id_contato = addslashes(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_SPECIAL_CHARS));
				if(isset($id_contato) AND !empty($id_contato) AND is_string($id_contato)) {
					echo "Id recebido para exclusão de contato !!" . "<br>\n";
					echo "Id para exclusão: " . $id_contato;
					$query = "DELETE FROM contatos WHERE id = :id_contato";
					$query = $connect->prepare($query);
					$query->bindValue(":id_contato", $id_contato);
					$query->execute();

					if(isset($query) AND is_object($query) AND $query == TRUE) {
						echo "Consulta realizada com suscesso !!" . "<br>\n";
					}else {
						echo "Erro: " . $connect->errorInfo();
						exit;
					}

					//testa se quantidade de registros na table de contato é maior que 0
					//e define sessão de exclusão de contato
					if($query->rowCount() > 0) {
						session_start();
						$_SESSION["delete_contato"] = "
						<div class='alert alert-danger fade show alert-dismissible text-center alertDanger shadow-sm' role='alert'>
							<span class='text text-light bd-lead text-center'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Contato Excluido com suscesso. Id: $id_contato
							</span>
						</div>";
						header("Location: select_contatos.php");
						return true;
						exit;
					}else {
						echo "<span class='text text-danger bd-lead'>Não há dados de contato para exclusão !!</span>";
						header("Location: select_contatos.php");
						return false;
						exit;
					}
				}else {
					echo "<span class='text text-danger bd-lead'>Id não existente para exclusão de contato !!</span>";
					header("Location: select_contatos.php");
					return false;
				}
			}
		}
?>