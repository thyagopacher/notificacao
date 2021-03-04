<?php

session_start();
if (!isset($_SESSION["codpessoa"]) || $_SESSION["codpessoa"] == NULL || $_SESSION["codpessoa"] == "") {
    die(json_encode(array('mensagem' => 'Sua sessão caiu, por favor logue novamente!!!', 'situacao' => false)));
}

include "../model/Conexao.php";
include "../model/Pessoa.php";
$conexao = new Conexao();
$pessoa = new Pessoa($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $pessoa->$key = $value;
}

$resExcluir = $pessoa->excluir();
if ($resExcluir != FALSE) {
    die(json_encode(array('pessoa' => 'Informações excluidas com sucesso !!!', 'situacao' => true)));
} else {
    die(json_encode(array('pessoa' => 'Erro ao excluir - causado por:' . mysqli_error($conexao->conexao), 'situacao' => error)));
}
