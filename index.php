<?php
	//define sessão de login de usuario
	session_start();
	if(isset($_SESSION["login_usuario"]) AND !empty($_SESSION["login_usuario"])) {
		//echo $_SESSION["login_usuario"];
	}else {
		header("Location: login.php");
		exit;
	}
 ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Adicionar Contatos</title>
		<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/bootstrap-reboot.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap4.5/css/style.css"/>
	</head>
<body>
	<article>
		<header>
			<div class="container justify-content-center">
				<div class="row justify-content-center p-4">
					<div class="col-sm-12 order-1 text-center">
						<div class="h1 page-header text-dark">Adicionar Contatos</div>
					</div>
				</div>
			</div>
		</header>
		<section>
		<div class="areaConteudo">
			<a class="link-striped mr-2" title="Visualizar Contatos" href="select_contatos.php">Contatos</a>
			<a class="link-striped" title="Informações de Usuário" data-toggle="modal" data-target="#ModalInformacoesLoginUsuario" href="#">Informações de Usuário</a>
			<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
				<span class="text text-dark bd-lead text-center textInfo">
					Preencha os campos abaixo adicionando novos contatos !!
				</span>
			</div>
		</div>
		<div class="areaFormAdicionar">
			<form name="adicionar" role="adicionar" method="POST" action="insert_contatos.php">
				<div class="form-row">
					<div class="col-sm-12 order-1">
						<div class="form-group">
							<label class="text text-dark bd-lead form-label" for="nome">Nome</label>
							<input type="text" name="nome" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" Nome.. " id="nome" required/>
							<small class="form-text text-muted">Informe o nome Completo.</small>
						</div>
					</div>
					<div class="col-sm-12 order-2">
						<div class="form-group">
							<label class="text text-dark bd-lead form-label" for="email">E-Mail</label>
							<input type="email" name="email" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" E-Mail.. " id="email" required/>
							<small class="form-text text-muted">Informe o endereço de E-Mail.</small>
						</div>
					</div>
					<div class="col-sm-12 order-3">
						<div class="form-group">
							<label class="text text-dark bd-lead form-label" for="telefone">Telefone</label>
							<input type="tel" name="telefone" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" Telefone.. " id="telefone" required/>
							<small class="form-text text-muted">Informe o numero de Telefone.</small>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-sm-6 order-1">
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-md shadow-sm">Adicionar</button>
							<button type="reset" class="btn btn-danger btn-md shadow-sm">Resetar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		</section>
	</article>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>
	<?php require_once "modais/modal_informacoes_login_usuario.php"; ?>
</body>
</html>