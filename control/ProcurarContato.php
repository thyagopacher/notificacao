<?php

session_start();
if (!isset($_SESSION["codpessoa"]) || $_SESSION["codpessoa"] == NULL || $_SESSION["codpessoa"] == "") {
    die(json_encode(array('mensagem' => 'Sua sessão caiu, por favor logue novamente!!!', 'situacao' => false)));
}

include "../model/Conexao.php";
include "../model/Contato.php";
$conexao = new Conexao();
$contato = new Contato($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $contato->$key = $value;
}

$resultado = $contato->procurar($_POST);
die(json_encode($resultado));
