<?php

class IndexController {

	public function indexAction() {
		header('Location: index.php?controle=AcidenteTrabalho&acao=home&uf=BA');
	}
}
