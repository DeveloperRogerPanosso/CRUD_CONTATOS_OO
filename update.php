<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Atualizar Contatos</title>
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
						<div class="h1 page-header text-dark">Atualizar Contatos</div>
					</div>
				</div>
			</div>
		</header>
		<section>
		<div class="areaConteudo">
			<a class="link-striped" title="Visualizar Contatos" href="select_contatos.php">Contatos</a>
			<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
				<span class="text text-dark bd-lead text-center textInfo">
					Atualize os campos nescessarios para atualização do Contato !!
				</span>
			</div>
			<?php require_once "sessions.php"; ?>
		</div>
		<div class="areaFormAtualizar">
			<?php
					require_once "autoload.php";

					use \classes\contato\Contato;

					$selectContatoId = new Contato();
					$selectContatoId->getContatoId();
			?>
		</div>
		</section>
	</article>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap4.5/js/bootstrap.bundle.min.css"></script>
	<script type="text/javascript" src="bootstrap4.5/js/script.js"></script>
</body>
</html>