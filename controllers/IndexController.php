<?php

class IndexController {

	public function indexAction() {
		// TODO: definir pagina inicial.
		header('Location: index.php?controle=AcidenteTrabalho&acao=home');
	}
}
