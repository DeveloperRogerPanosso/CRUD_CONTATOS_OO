<?php
		
		if(isset($_SESSION["insert_contato"]) AND !empty($_SESSION["insert_contato"])) {
			echo $_SESSION["insert_contato"];
			$_SESSION["insert_contato"] = null;
			unset($_SESSION["insert_contato"]);
		}

		if(isset($_SESSION["email_existente"]) AND !empty($_SESSION["email_existente"])) {
			echo $_SESSION["email_existente"];
			$_SESSION["email_existente"] = null;
			unset($_SESSION["email_existente"]);
		}

		if(isset($_SESSION["update_contato"]) AND !empty($_SESSION["update_contato"])) {
			echo $_SESSION["update_contato"];
			$_SESSION["update_contato"] = null;
			unset($_SESSION["update_contato"]);
		}

		if(isset($_SESSION["delete_contato"]) AND !empty($_SESSION["delete_contato"])) {
			echo $_SESSION["delete_contato"];
			$_SESSION["delete_contato"] = null;
			unset($_SESSION["delete_contato"]);
		}

		if(isset($_SESSION["login_invalido"]) AND !empty($_SESSION["login_invalido"])) {
			echo $_SESSION["login_invalido"];
			$_SESSION["login_invalido"] = null;
			unset($_SESSION["login_invalido"]);
		} 

		if(isset($_SESSION["cadastro_usuario"]) AND !empty($_SESSION["cadastro_usuario"])) {
			echo $_SESSION["cadastro_usuario"];
			$_SESSION["cadastro_usuario"] = null;
			unset($_SESSION["cadastro_usuario"]);
		}

		if(isset($_SESSION["usuario_existente"]) AND !empty($_SESSION["usuario_existente"])) {
			echo $_SESSION["usuario_existente"];
			$_SESSION["usuario_existente"] = null;
			unset($_SESSION["usuario_existente"]);
		}

		if(isset($_SESSION["usuario_invalido"]) AND !empty($_SESSION["usuario_invalido"])) {
			echo $_SESSION["usuario_invalido"];
			$_SESSION["usuario_invalido"] = null;
			unset($_SESSION["usuario_invalido"]);
		}

		if(isset($_SESSION["senha_invalida"]) AND !empty($_SESSION["senha_invalida"])) {
			echo $_SESSION["senha_invalida"];
			$_SESSION["senha_invalida"] = null;
			unset($_SESSION["senha_invalida"]);
		}

		if(isset($_SESSION["update_senha_login_usuario"]) AND !empty($_SESSION["update_senha_login_usuario"])) {
			echo $_SESSION["update_senha_login_usuario"];
			$_SESSION["update_senha_login_usuario"] = null;
			unset($_SESSION["update_senha_login_usuario"]);
		}
?>