<div class="modal fade" id="ModalInformacoesLoginUsuario" role="dialog">
	<div class="modal-dialog shadow-sm modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header bg-light">
				<h5 class="modal-title text text-dark bd-lead">Informações de Usuário</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 order-1 text-center">
							<span class="text text-dark bd-lead FontUsuario"><strong><?=$_SESSION["login_usuario"];?></strong></span>
						</div>
						<div class="col-sm-6 order-1 text-center">
							<a class="link-striped" title="Encerrar Sessão" href="delete_session.php">Encerrar Sessão</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer bg-light">
				<button type="button" class="btn btn-primary btn-md shadow-sm" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>