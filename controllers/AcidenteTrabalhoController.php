<?php
// incluindo classes da camada Model
require_once 'models/AcidenteTrabalhoModel.php';

class AcidenteTrabalhoController {

	public function homeAction() {
		$o_view = new View('views/home.phtml');
		
		// Imprimindo c�digo HTML
		$o_view->showContents();
	}

	public function listarAcidentesTrabalhoAction() {
		
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
		
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$ano = ( !isset($_REQUEST['ano']) || $_REQUEST['ano'] == "" ) ? null : strtoupper($_REQUEST['ano']);
	
		// definindo qual o arquivo HTML que ser� usado para
		// mostrar a lista de contatos
		$o_view = new View('views/listarAcidentesTrabalho.phtml');
	
		// Passando os dados do contato para a View
		$o_view->setParams(array(
				'listaAcidentesTrabalho' => $acidenteTrabalhoModel->_list($ano, $uf)
		));
		
		// Imprimindo c�digo HTML
		$o_view->showContents();
	}
}
      