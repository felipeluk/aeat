<?php

class AcidenteTrabalhoModel {
	
	// propriedades da classe objeto
	private $ano;
	private $codigo;
	private $nome;
	private $uf;
	private $quantidadeAcidenteDoenca;
	private $quantidadeAcidenteTipico;
	private $quantidadeAcidenteTrajeto;
	private $quantidadeAcidenteOutros;
	private $quantidadeObito;
	
	// setters e getters
	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function setUf($uf) {
		$this->uf = $uf;
	}

	public function getUf() {
		return $this->uf;
	}
	
	public function getAno() {
		return $this->ano;
	}
	
	public function setAno($ano) {
		$this->ano = $ano;
		return $this;
	}

	public function getQuantidadeAcidenteDoenca() {
		return $this->quantidadeAcidenteDoenca;
	}

	public function setQuantidadeAcidenteDoenca($quantidadeAcidenteDoenca) {
		$this->quantidadeAcidenteDoenca = $quantidadeAcidenteDoenca;
		return $this;
	}

	public function getQuantidadeAcidenteTipico() {
		return $this->quantidadeAcidenteTipico;
	}

	public function setQuantidadeAcidenteTipico($quantidadeAcidenteTipico) {
		$this->quantidadeAcidenteTipico = $quantidadeAcidenteTipico;
		return $this;
	}

	public function getQuantidadeAcidenteTrajeto() {
		return $this->quantidadeAcidenteTrajeto;
	}

	public function setQuantidadeAcidenteTrajeto($quantidadeAcidenteTrajeto) {
		$this->quantidadeAcidenteTrajeto = $quantidadeAcidenteTrajeto;
		return $this;
	}

	public function getQuantidadeAcidenteOutros() {
		return $this->quantidadeAcidenteOutros;
	}

	public function setQuantidadeAcidenteOutros($quantidadeAcidenteOutros) {
		$this->quantidadeAcidenteOutros = $quantidadeAcidenteOutros;
		return $this;
	}

	public function getQuantidadeObito() {
		return $this->quantidadeObito;
	}

	public function setQuantidadeObito($quantidadeObito) {
		$this->quantidadeObito = $quantidadeObito;
		return $this;
	}

	public function _list($ano = null, $uf = null) {
		
		//Recupera a lista baseada no ano
		$result = JsonDAO::getObjectContent($ano);	
	
		$acidentesTrabalho = array();
		foreach ($result->acidentes_de_trabalho as $acidenteTrabalho) {
			
			if (is_null($uf) || ($acidenteTrabalho->municipio->uf == $uf) ) {
				$acidenteTrabalhoModel = new AcidenteTrabalhoModel();
				
				$acidenteTrabalhoModel->setCodigo($acidenteTrabalho->municipio->cod_ibge);
				$acidenteTrabalhoModel->setNome($acidenteTrabalho->municipio->nome);
				$acidenteTrabalhoModel->setUf($acidenteTrabalho->municipio->uf);
				
				$acidenteTrabalhoModel->setQuantidadeAcidenteDoenca($acidenteTrabalho->quantidade->acidentes_com_cat->doenca);
				$acidenteTrabalhoModel->setQuantidadeAcidenteTipico($acidenteTrabalho->quantidade->acidentes_com_cat->tipicos);
				$acidenteTrabalhoModel->setQuantidadeAcidenteTrajeto($acidenteTrabalho->quantidade->acidentes_com_cat->trajeto);
				$acidenteTrabalhoModel->setQuantidadeAcidenteOutros($acidenteTrabalho->quantidade->acidentes_sem_cat);
				$acidenteTrabalhoModel->setQuantidadeObito($acidenteTrabalho->quantidade->obitos);			
				
				$acidentesTrabalho[] = $acidenteTrabalhoModel;
			}
		}	
		
		return $acidentesTrabalho;
	}
	
	public function _listEstadoComTotais($ano = null, $uf = null) {
	
		//Recupera a lista baseada no ano
		$result = JsonDAO::getObjectContent($ano);
	
		$acidentesTrabalho = array();
		
		$totalQuantidadeAcidenteDoenca = 0;
		$totalQuantidadeAcidenteTipico = 0;
		$totalQuantidadeAcidenteTrajeto = 0;
		$totalQuantidadeAcidenteOutros = 0;
		$totalQuantidadeObitos = 0;
		
		foreach ($result->acidentes_de_trabalho as $acidenteTrabalho) {
				
			if (!is_null($uf) && ($acidenteTrabalho->municipio->uf == $uf) ) {
						
				$estado = $acidenteTrabalho->municipio->uf;
				$totalQuantidadeAcidenteDoenca += $acidenteTrabalho->quantidade->acidentes_com_cat->doenca;
				$totalQuantidadeAcidenteTipico += $acidenteTrabalho->quantidade->acidentes_com_cat->tipicos;
				$totalQuantidadeAcidenteTrajeto += $acidenteTrabalho->quantidade->acidentes_com_cat->trajeto;
				$totalQuantidadeAcidenteOutros += $acidenteTrabalho->quantidade->acidentes_sem_cat;
				$totalQuantidadeObitos += $acidenteTrabalho->quantidade->obitos;		
			}
		}
		
		$acidenteTrabalho = new AcidenteTrabalhoModel();
		
		$acidenteTrabalho->setUf($estado);		
		$acidenteTrabalho->setQuantidadeAcidenteDoenca($totalQuantidadeAcidenteDoenca);
		$acidenteTrabalho->setQuantidadeAcidenteTipico($totalQuantidadeAcidenteTipico);
		$acidenteTrabalho->setQuantidadeAcidenteTrajeto($totalQuantidadeAcidenteTrajeto);
		$acidenteTrabalho->setQuantidadeAcidenteOutros($totalQuantidadeAcidenteOutros);
		$acidenteTrabalho->setQuantidadeObito($totalQuantidadeObitos);
	
		return $acidenteTrabalho;
	}
	
	public function _listEstadoComTotaisPorAno($uf = null) {
		
		$estados = array();
		
		for($ano = 2002; $ano <= 2009; $ano++){
				
			//Recupera a lista baseada no ano
			$result = JsonDAO::getObjectContent($ano);
				
			$resultAcidenteTrabalho = array();
			$estado = "";
			$totalQuantidadeAcidenteDoenca = 0;
			$totalQuantidadeAcidenteTipico = 0;
			$totalQuantidadeAcidenteTrajeto = 0;
			$totalQuantidadeAcidenteOutros = 0;
			$totalQuantidadeObitos = 0;
				
			foreach ($result->acidentes_de_trabalho as $acidenteTrabalho) {

				if ( (!is_null($uf) && ($acidenteTrabalho->municipio->uf == $uf)) ) {
	
					$estado = $acidenteTrabalho->municipio->uf;
					$totalQuantidadeAcidenteDoenca += $acidenteTrabalho->quantidade->acidentes_com_cat->doenca;
					$totalQuantidadeAcidenteTipico += $acidenteTrabalho->quantidade->acidentes_com_cat->tipicos;
					$totalQuantidadeAcidenteTrajeto += $acidenteTrabalho->quantidade->acidentes_com_cat->trajeto;
					$totalQuantidadeAcidenteOutros += $acidenteTrabalho->quantidade->acidentes_sem_cat;
					$totalQuantidadeObitos += $acidenteTrabalho->quantidade->obitos;
				}
			}
				
			$resultAcidenteTrabalho = new AcidenteTrabalhoModel();
				
			$resultAcidenteTrabalho->setUf($estado);			
			$resultAcidenteTrabalho->setAno($ano);
			$resultAcidenteTrabalho->setQuantidadeAcidenteDoenca($totalQuantidadeAcidenteDoenca);
			$resultAcidenteTrabalho->setQuantidadeAcidenteTipico($totalQuantidadeAcidenteTipico);
			$resultAcidenteTrabalho->setQuantidadeAcidenteTrajeto($totalQuantidadeAcidenteTrajeto);
			$resultAcidenteTrabalho->setQuantidadeAcidenteOutros($totalQuantidadeAcidenteOutros);
			$resultAcidenteTrabalho->setQuantidadeObito($totalQuantidadeObitos);
				
			$estados[] = $resultAcidenteTrabalho;
				
			unset($resultAcidenteTrabalho);
		}
	
		return $estados;
	}
	
	public function _listCidadesComTotais($uf = null, $cidade = null) {	
		
		$cidades = array();
		
		for($ano = 2002; $ano <= 2009; $ano++){
			
			//Recupera a lista baseada no ano
			$result = JsonDAO::getObjectContent($ano);
			
			$resultAcidenteTrabalho = array();
			$estado = "";
			$totalQuantidadeAcidenteDoenca = 0;
			$totalQuantidadeAcidenteTipico = 0;
			$totalQuantidadeAcidenteTrajeto = 0;
			$totalQuantidadeAcidenteOutros = 0;
			$totalQuantidadeObitos = 0;			
			
			foreach ($result->acidentes_de_trabalho as $acidenteTrabalho) {
				
				//print $cidade ." = " . $acidenteTrabalho->municipio->nome . "<br />";
				if ( (!is_null($cidade) && ($acidenteTrabalho->municipio->nome == $cidade)) ) {
		
					$estado = $acidenteTrabalho->municipio->uf;				
					$totalQuantidadeAcidenteDoenca += $acidenteTrabalho->quantidade->acidentes_com_cat->doenca;
					$totalQuantidadeAcidenteTipico += $acidenteTrabalho->quantidade->acidentes_com_cat->tipicos;
					$totalQuantidadeAcidenteTrajeto += $acidenteTrabalho->quantidade->acidentes_com_cat->trajeto;
					$totalQuantidadeAcidenteOutros += $acidenteTrabalho->quantidade->acidentes_sem_cat;
					$totalQuantidadeObitos += $acidenteTrabalho->quantidade->obitos;
				}
			}			
			
			$resultAcidenteTrabalho = new AcidenteTrabalhoModel();
			
			$resultAcidenteTrabalho->setUf($estado);
			$resultAcidenteTrabalho->setNome($cidade);
			$resultAcidenteTrabalho->setAno($ano);
			$resultAcidenteTrabalho->setQuantidadeAcidenteDoenca($totalQuantidadeAcidenteDoenca);
			$resultAcidenteTrabalho->setQuantidadeAcidenteTipico($totalQuantidadeAcidenteTipico);
			$resultAcidenteTrabalho->setQuantidadeAcidenteTrajeto($totalQuantidadeAcidenteTrajeto);
			$resultAcidenteTrabalho->setQuantidadeAcidenteOutros($totalQuantidadeAcidenteOutros);
			$resultAcidenteTrabalho->setQuantidadeObito($totalQuantidadeObitos);
			
			$cidades[] = $resultAcidenteTrabalho;
			
			unset($resultAcidenteTrabalho);			
		}		
	
		return $cidades;
	}
		
	
}

