<?php
/**
 * permite requisições de outros lugares
 */
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');  
include "../model/Conexao.php";
include "../model/Pessoa.php";
$conexao = new Conexao();
$pessoa = new Pessoa($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $pessoa->$key = $value;
}

$resultado = $pessoa->procurarCodigo();
die(json_encode($resultado));
