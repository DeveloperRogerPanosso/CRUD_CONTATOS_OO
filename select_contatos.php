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
		<title>Contatos</title>
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
						<div class="h1 page-header text-dark">Contatos</div>
					</div>
				</div>
			</div>
		</header>
		<section>
		<div class="areaConteudo">
			<a class="link-striped mr-2" title="Adicionar Contatos" href="index.php">Adicionar Contatos</a>
			<a class="link-striped" title="Informações de Usuário" href="#" data-toggle="modal" data-target="#ModalInformacoesLoginUsuario">Informações de Usuário</a>
			<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
				<span class="text text-dark bd-lead text-center textInfo">
					Segue abaixo os seguintes contatos adicionados !!
				</span>
			</div>
			<?php require_once "sessions.php"; ?>
		</div>
		<div class="areaListaContatos">
			<?php
				require_once "autoload.php";

				use \classes\contato\Contato;

				$select_contatos = new Contato();
				$select_contatos->getContatosAll();
			?>
		</div>
		</section>
	</article>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>
	<?php require_once "modais/modal_informacoes_login_usuario.php"; ?>
</body>
</html>