<?php

class JsonDAO {	

	static function getObjectContent($ano) {
		
		$sessionName = 'json_' . $ano;
		
		if (!isset($_SESSION[$sessionName]) || empty($_SESSION[$sessionName])) {		
			$URL_ANUARIO = ($_SERVER ['HTTP_HOST'] == "aeat.labageis.com") ? 'http://' . $_SERVER ['HTTP_HOST'] . '/json/aeat_' : 'http://' . $_SERVER ['HTTP_HOST'] . '/aeat/json/aeat_';
			
			if (! is_null($ano))
				$url = $URL_ANUARIO . $ano . '.php';
			else
				$url = $URL_ANUARIO . '2002.php';
			
			$opts = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Content-type: application/json',
					'content' => null
				)
			);							
			
			$context = stream_context_create($opts);
			$result = file_get_contents($url, false, $context);
			
			$_SESSION[$sessionName] = json_decode($result);			
		}			
		
		return $_SESSION[$sessionName];
	}
}
?>