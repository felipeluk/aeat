<?php

session_start("json");

// incluindo classes da camada Model
require_once 'models/AcidenteTrabalhoModel.php';
require_once 'models/MunicipioModel.php';

class AcidenteTrabalhoController {

	public function homeAction() {
		
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
		$estadoModel = new MunicipioModel();
		
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$ano = ( !isset($_REQUEST['ano']) || $_REQUEST['ano'] == "" ) ? null : strtoupper($_REQUEST['ano']);
		$cidade = ( !isset($_REQUEST['cidade']) || $_REQUEST['cidade'] == "" ) ? $estadoModel->_getPrimeiraCidade($ano, $uf) : strtoupper($_REQUEST['cidade']);	
				
		$view = new View('views/home.phtml');
		
		// Passando os dados do contato para a View
		$view->setParams(array(
				'acidentesTrabalhoPorEstadoComTotaisPorAno' => $acidenteTrabalhoModel->_listEstadoComTotaisPorAno($uf),
				'acidentesTrabalhoPorCidadeComTotais' => $acidenteTrabalhoModel->_listCidadesComTotais($uf, $cidade),
				'listaEstados' => $estadoModel->_listTodosEstados($ano),
				'listaCidades' => $estadoModel->_listCidadesPorEstado($ano, $uf)
		));
		
		$view->showContents();
	}
	
	public function projetoAction() {
		$o_view = new View('views/projeto.phtml');
		$o_view->showContents();
	}
	
	public function conceitosAction() {
		$o_view = new View('views/conceitos.phtml');
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
				//'acidentesTrabalhoPorEstadoComTotaisPorAno' => $acidenteTrabalhoModel->_listEstadoComTotaisPorAno($uf),
				'listaEstados' => $estadoModel->_listTodosEstados($ano),
				'listaCidades' => $estadoModel->_listCidadesPorEstado($ano, $uf)
		));

		$view->showContents();
		
	}
	
	public function ajaxListarAcidentesTrabalhoPorEstadoComTotaisAction() {
	
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();		
	
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$ano = ( !isset($_REQUEST['ano']) || $_REQUEST['ano'] == "" ) ? null : strtoupper($_REQUEST['ano']);
	
		$view = new View('views/ajaxEvolucaoEstado.phtml');
	
		// Passando os dados do contato para a View
		$view->setParams(array(	
				'acidentesTrabalhoPorEstadoComTotaisPorAno' => $acidenteTrabalhoModel->_listEstadoComTotaisPorAno($uf)			
		));
	
		$view->showContents();	
	}
	
	public function ajaxListarAcidentesTrabalhoPorCidadeComTotaisAction() {
		
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
	
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$cidade = ( !isset($_REQUEST['cidade']) || $_REQUEST['cidade'] == "" ) ? null : strtoupper($_REQUEST['cidade']);

		$view = new View('views/ajaxEvolucaoCidade.phtml');
	
		// Passando os dados do contato para a View
		$view->setParams(array(
				'acidentesTrabalhoPorCidadeComTotais' => $acidenteTrabalhoModel->_listCidadesComTotais($uf, $cidade)				
		));
	
		$view->showContents();
	}
	
	public function listarAcidentesTrabalhoPorCidadeAction() {
		$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
		$estadoModel = new MunicipioModel();
		
		$uf = ( !isset($_REQUEST['uf']) || $_REQUEST['uf'] == "") ? null : strtoupper($_REQUEST['uf']);
		$cidade = ( !isset($_REQUEST['cidade']) || $_REQUEST['cidade'] == "" ) ? null : strtoupper($_REQUEST['cidade']);
		$ano = ( !isset($_REQUEST['ano']) || $_REQUEST['ano'] == "" ) ? null : strtoupper($_REQUEST['ano']);
		
		$view = new View('views/listarAcidentesTrabalhoPorCidade.phtml');
		
		// Passando os dados do contato para a View
		$view->setParams(array(
				'acidentesTrabalhoPorCidadeComTotais' => $acidenteTrabalhoModel->_listCidadesComTotais($uf, $cidade),
				'listaEstados' => $estadoModel->_listTodosEstados($ano),
				'listaCidades' => $estadoModel->_listCidadesPorEstado($ano, $uf)
		));
		
		$view->showContents();
	}
}
      