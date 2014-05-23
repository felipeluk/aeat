<?php

class IndexController {

	public function indexAction() {
		// TODO: definir pagina inicial.
		header('Location: ?controle=Municipio&acao=listarMunicipios');
	}
}
