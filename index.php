<?php
/**
* Primeiro arquivo a ser executado.
* � aqui que tudo come�a 
* 
* @package Exemplo simples com MVC
* @author DigitalDev
* @version 0.1.1
* 
* Diret�rio Pai - raiz do site
* Arquivo - index.php
*/
// configurando o PHP para mostrar os erros na tela
ini_set('display_errors', 1);

// configurando o PHP para reportar todo e qualquer erro
error_reporting(E_ALL);

require_once 'lib/Application.php';
$o_Application = new Application();
$o_Application->dispatch();
?>