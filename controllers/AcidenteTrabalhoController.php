<?php
// incluindo classes da camada Model
require_once 'models/AcidenteTrabalhoModel.php';
require_once 'models/MunicipioModel.php';

class AcidenteTrabalhoController {

	public function homeAction() {
		$o_view = new View('views/home.phtml');
		
		// Imprimindo c�digo HTML
		$o_view->showContents();
	}

	public function listarAcidentesTrabalhoAction() {
		
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
		$estadoModel = new MunicipioModel();
		
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$ano = ( !isset($_REQUEST['ano']) || $_REQUEST['ano'] == "" ) ? null : strtoupper($_REQUEST['ano']);

		$view = new View('views/listarAcidentesTrabalho.phtml');
	
		// Passando os dados do contato para a View
		$view->setParams(array(
				'listaAcidentesTrabalho' => $acidenteTrabalhoModel->_list($ano, $uf),
				'listaEstados' => $estadoModel->_listTodosEstados($ano)
		));

		$view->showContents();
	}
	
	public function listarAcidentesTrabalhoPorEstadoComTotaisAction() {
		
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
		$estadoModel = new MunicipioModel();
		
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$ano = ( !isset($_REQUEST['ano']) || $_REQUEST['ano'] == "" ) ? null : strtoupper($_REQUEST['ano']);		

		$view = new View('views/listarAcidentesTrabalhoGrafico.phtml');
		
		// Passando os dados do contato para a View
		$view->setParams(array(
				'acidentesTrabalhoPorEstadoComTotais' => $acidenteTrabalhoModel->_listEstadoComTotais($ano, $uf),
				'listaEstados' => $estadoModel->_listTodosEstados($ano)
		));

		$view->showContents();
		
	}
}
      