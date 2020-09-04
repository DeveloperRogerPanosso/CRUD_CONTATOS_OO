<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Login | Contatos</title>
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
						<div class="h1 page-header text-dark">Login</div>
					</div>
				</div>
			</div>
		</header>
		<section>
		<div class="areaConteudoLogin">
			<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
				<span class="text text-dark bd-lead text-center textInfo">
					Informe seu Usuário e Senha para realizar o Login !!
				</span>
			</div>
			<?php session_start(); require "sessions.php"; ?>
		</div>
		<div class="areaFormLogin">
			<form name="adicionar" role="adicionar" method="POST" action="validar_login.php">
				<div class="form-row">
					<div class="col-sm-12 order-1">
						<div class="form-group">
							<label class="text text-dark bd-lead form-label" for="usuario">Usuário</label>
							<input type="text" name="usuario" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" Usuário.. " id="usuario" required/>
							<small class="form-text text-muted">Informe seu Usuário.</small>
						</div>
					</div>
					<div class="col-sm-12 order-2">
						<div class="form-group">
							<label class="text text-dark bd-lead form-label" for="senha">Senha</label>
							<input type="password" name="senha" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" Senha.. " id="senha" required/>
							<small class="form-text text-muted">Informe sua Senha.</small>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-sm-12 order-1">
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-md shadow-sm btn-block" onclick="alertSessionLogin()">Logar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="areaCadastroUsuario">
			
				<a class="link-striped mr-2" title="Cadastrar Usuário" href="#" data-toggle="modal" data-target="#ModalCadastroUsuarioLogin">Cadastrar Usuário</a>
				<a class="link-striped" title="Atualizar Senha" data-toggle="modal" data-target="#ModalUpdateSenhaLoginUsuario" href="#">Esqueci Minha Senha ?</a>
		</div>
		</section>
		<footer>
			<div class="areaFooterLogin">
				<span>CRUD de Contatos</span>
				<span>Developed By Roger Panosso</span>
			</div>
		</footer>
	</article>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>

	<?php 
		require_once "modais/modal_cadastro_usuario_login.php";
		require_once "modais/modal_update_senha_login_usuario.php";
	?>
</body>
</html>