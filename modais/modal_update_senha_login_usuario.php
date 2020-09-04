<div class="modal fade" id="ModalUpdateSenhaLoginUsuario" role="dialog">
	<div class="modal-dialog shadow-sm modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header bg-light">
				<h5 class="modal-title text text-dark bd-lead">Atualizar Senha(Login)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="areaConteudoLoginCadastroUsuario">
					<div class="alert alert-info fade show alert-dismissible text-center shadow-sm" role="alert">
						<span class="text text-dark bd-lead text-center textInfo">
							Informe seu Usuário para redefinição de Senha !!
						</span>
					</div>
				</div>
				<div class="areaFormCadastroUsuarioLogin">
					<form name="adicionar" role="adicionar" method="POST" action="update_senha_login_usuario.php">
						<div class="form-row">
							<div class="col-sm-12 order-1">
								<div class="form-group">
									<label class="text text-dark bd-lead form-label" for="usuario">Usuário</label>
									<input type="text" name="usuario" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" Usuário.. " id="usuario" required/>
									<small class="form-text text-muted">Exemplo: usuario@hotmail.com. <strong>OBS: Cinco ou mais Caracteres.</strong></small>
								</div>
							</div>
							<div class="col-sm-12 order-2">
								<div class="form-group">
									<label class="text text-dark bd-lead form-label" for="senha">Nova Senha</label>
									<input type="password" name="senha" class="form-control form-control-md borderInput" autocomplete="off" placeholder=" Senha.. " id="senha" required/>
									<small class="form-text text-muted">Defina uma Senha. <strong>OBS: Cinco ou mais Caracteres.</strong></small>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer bg-light">
					<button type="submit" class="btn btn-success btn-md shadow-sm">Atualizar</button>
					<button type="button" class="btn btn-primary btn-md shadow-sm" data-dismiss="modal">Fechar</button>
				</div>
			</form>
		</div>
	</div>
</div>