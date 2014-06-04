<?php

class MunicipioModel {
	
	// propriedades da classe objeto
	private $codigo;
	private $nome;
	private $uf;
	
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
	
	// Ações
	public function _list($ano = null) {
		
		//Recupera a lista baseada no ano
		$result = JsonDAO::getObjectContent($ano);
		
		$anuarios = $result->acidentes_de_trabalho;
		
		$municipios = array();
		foreach ($anuarios as $anuario) {
			// $municipios[$anuario->municipio->uf] = $anuario->municipio;
			
			$municipio = new MunicipioModel();
			$municipio->setCodigo($anuario->municipio->cod_ibge);
			$municipio->setNome($anuario->municipio->nome);
			$municipio->setUf($anuario->municipio->uf);
			
			$municipios[] = $municipio;
		}
		
		asort($municipios);
		
		return $municipios;
	}
	
	public function _listTodosEstados($ano = null) {
	
		//Recupera a lista baseada no ano
		$result = JsonDAO::getObjectContent($ano);	
	
		$estados = array();
		foreach ($result->acidentes_de_trabalho as $anuario) {			
			$estados[$anuario->municipio->uf] = $anuario->municipio->uf;	
		}
	
		asort($estados);
	
		return $estados;
	}
	
	public function _listCidadesPorEstado($ano = null, $estado = null) {
	
		//Recupera a lista baseada no ano
		$result = JsonDAO::getObjectContent($ano);
		
		$municipios = array();
		foreach ($result->acidentes_de_trabalho as $anuario) {
			
			if (!is_null($estado) && $anuario->municipio->uf == $estado) {					
				$municipio = new MunicipioModel();
				$municipio->setCodigo($anuario->municipio->cod_ibge);
				$municipio->setNome($anuario->municipio->nome);
				$municipio->setUf($anuario->municipio->uf);
					
				$municipios[] = $municipio;	
				
				unset($municipio);
			}	
		}
	
		asort($municipios);
	
		return $municipios;
	}
	
	public function _listHistoricoAcidentesPorCidades($ano = null, $estado = null, $cidade = null) {
	
		//Recupera a lista baseada no ano
		$result = JsonDAO::getObjectContent($ano);

	
		$estados = array();
	
		$totalQuantidadeAcidenteDoenca = 0;
		$totalQuantidadeAcidenteTipico = 0;
		$totalQuantidadeAcidenteTrajeto = 0;
		$totalQuantidadeAcidenteOutros = 0;
		$totalQuantidadeObitos = 0;
	
		foreach ($result->acidentes_de_trabalho as $anuario) {
				
			if ($anuario->municipio->uf == $estado && $anuario->municipio->nome == $cidade) {
				$estado = $acidenteTrabalho->municipio->uf;
				$totalQuantidadeAcidenteDoenca += $acidenteTrabalho->quantidade->acidentes_com_cat->doenca;
				$totalQuantidadeAcidenteTipico += $acidenteTrabalho->quantidade->acidentes_com_cat->tipicos;
				$totalQuantidadeAcidenteTrajeto += $acidenteTrabalho->quantidade->acidentes_com_cat->trajeto;
				$totalQuantidadeAcidenteOutros += $acidenteTrabalho->quantidade->acidentes_sem_cat;
				$totalQuantidadeObitos += $acidenteTrabalho->quantidade->obitos;
	
			}
			$estados[] = $anuario->municipio->nome;
		}
	
		asort($estados);
	
		return $estados;
	}
}

