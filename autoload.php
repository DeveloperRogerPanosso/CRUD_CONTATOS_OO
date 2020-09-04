<?php
		//define autoload realizando registro de instancia da classe e verificando
		//se arquivo com implementação da classe é existente no diretorio
		spl_autoload_register(function($classe) {
			//echo "Classe Instanciada: " . $classe . "<br>\n";
			$diretorioBase = __DIR__."/".str_replace("\\", "/", $classe).".php";
			//echo "Diretorio Base com classe: " . $diretorioBase . "<br>\n";

			if(isset($diretorioBase) AND file_exists($diretorioBase)) {
				require_once $diretorioBase;
				//echo "Arquivo com implementação da classe exisntente no diretorio";
				return true;
			}else {
				echo "Arquivo com implementação da classe inexistente no diretorio";
				return false;
			}
		});
?>