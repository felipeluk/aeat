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
}

