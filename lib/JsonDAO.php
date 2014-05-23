<?php

class JsonDAO {

	const URL_ANUARIO = 'http://aeat.labageis.com/json/aeat_';

	static function getObjectContent($ano) {
		if (! is_null($ano))
			$url = self::URL_ANUARIO . $ano . '.php';
		else
			$url = self::URL_ANUARIO . '2002.php';
		
		$opts = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type: application/json',
				'content' => null
			)
		);
		
		$context = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);
		return json_decode($result);
	}
}
?>