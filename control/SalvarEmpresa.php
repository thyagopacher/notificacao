<?php

session_start();
if (!isset($_SESSION["codpessoa"]) || $_SESSION["codpessoa"] == NULL || $_SESSION["codpessoa"] == "") {
    die(json_encode(array('mensagem' => 'Sua sessão caiu, por favor logue novamente!!!', 'situacao' => false)));
}

include "../model/Conexao.php";
include "../model/Empresa.php";
$conexao = new Conexao();
$empresa = new Empresa($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $empresa->$key = $value;
}
$resSalvar = $empresa->salvar();
if ($resSalvar != FALSE) {
    die(json_encode(array('mensagem' => 'Informações salvas com sucesso !!!', 'situacao' => true)));
} else {
    die(json_encode(array('mensagem' => 'Erro ao salvar - causado por:' . mysqli_error($conexao->conexao), 'situacao' => error)));
}
