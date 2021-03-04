<?php

session_start();
if (!isset($_SESSION["codpessoa"]) || $_SESSION["codpessoa"] == NULL || $_SESSION["codpessoa"] == "") {
    die(json_encode(array('mensagem' => 'Sua sessão caiu, por favor logue novamente!!!', 'situacao' => false)));
}

include "../model/Conexao.php";
include "../model/Mensagem.php";
$conexao = new Conexao();
$mensagem = new Mensagem($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $mensagem->$key = $value;
}

$resExcluir = $mensagem->excluir();
if ($resExcluir != FALSE) {
    die(json_encode(array('mensagem' => 'Informações excluidas com sucesso !!!', 'situacao' => true)));
} else {
    die(json_encode(array('mensagem' => 'Erro ao excluir - causado por:' . mysqli_error($conexao->conexao), 'situacao' => error)));
}
