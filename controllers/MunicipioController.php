<?php
// incluindo classes da camada Model
require_once 'models/MunicipioModel.php';

class MunicipioController {

	public function listarMunicipiosAction() {
		
		$municipioModel = new MunicipioModel();

		// definindo qual o arquivo HTML que ser� usado para
		// mostrar a lista de contatos
		$o_view = new View('views/listarMunicipios.phtml');
		
		// Passando os dados do contato para a View
		$o_view->setParams(array(
			'v_municipios' => $municipioModel->_list()
		));
		
		// Imprimindo c�digo HTML
		$o_view->showContents();
	}
}
?>