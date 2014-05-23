<?php

/**
* Essa fun��o garante que todas as classes 
* da pasta lib ser�o carregadas automaticamente
*/
function __autoload($st_class) {
	if (file_exists('lib/' . $st_class . '.php'))
		require_once 'lib/' . $st_class . '.php';
}

class Application {
	/**
	 * Usada pra guardar o nome da classe
	 * de controle (Controller) a ser executada
	 * 
	 * @var string
	 */
	protected $st_controller;
	
	/**
	 * Usada para guardar o nome do metodo da
	 * classe de controle (Controller) que dever� ser executado
	 * 
	 * @var string
	 */
	protected $st_action;

	/**
	 * Verifica se os par�metros de controlador (Controller) e a��o (Action) foram
	 * passados via par�metros "Post" ou "Get" e os carrega tais dados
	 * nos respectivos atributos da classe
	 */
	private function loadRoute() {
		/*
		 * Se o controller nao for passado por GET, assume-se como padr�o o controller 'IndexController';
		 */
		$this->st_controller = isset($_REQUEST['controle']) ? $_REQUEST['controle'] : 'Index';
		
		/*
		 * Se a action nao for passada por GET, assume-se como padr�o a action 'IndexAction';
		 */
		$this->st_action = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : 'index';
	}

	/**
	 *
	 * Instancia classe referente ao Controlador (Controller) e executa
	 * m�todo referente e acao (Action)
	 * 
	 * @throws Exception
	 */
	public function dispatch() {
		$this->loadRoute();
		
		// verificando se o arquivo de controle existe
		$st_controller_file = 'controllers/' . $this->st_controller . 'Controller.php';
		if (file_exists($st_controller_file))
			require_once $st_controller_file;
		else
			throw new Exception('Arquivo ' . $st_controller_file . ' nao encontrado');
			
			// verificando se a classe existe
		$st_class = $this->st_controller . 'Controller';
		if (class_exists($st_class))
			$o_class = new $st_class();
		else
			throw new Exception("Classe '$st_class' nao existe no arquivo '$st_controller_file'");
			
			// verificando se o metodo existe
		$st_method = $this->st_action . 'Action';
		if (method_exists($o_class, $st_method))
			$o_class->$st_method();
		else
			throw new Exception("Metodo '$st_method' nao existe na classe $st_class'");
	}

	/**
	 * Redireciona a chamada http para outra p�gina
	 * 
	 * @param string $st_uri        	
	 */
	static function redirect($st_uri) {
		header("Location: $st_uri");
	}
}
?>