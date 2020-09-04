//define function de alert para session de login
function alertSessionLogin() {
	let info = confirm("OBS: Ao realizar o Login sera criada sua sessão de usuário. Certifique-se de encerra-la após a conclusão das devidas atividades !!");
	if(info == true) {
		return true;
	}else {
		window.location.href="";
		return false;
	}
}