<?php
/**
 * permite requisições de outros lugares
 */
header('Access-Control-Allow-Origin: *');  
include "../model/Conexao.php";
include "../model/Mensagem.php";
$conexao = new Conexao();
$mensagem = new Mensagem($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $mensagem->$key = $value;
}

$resultado = $mensagem->procurar($_POST);
die(json_encode($resultado));
