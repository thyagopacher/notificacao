<?php

include "../model/Conexao.php";
include "../model/Pessoa.php";
$conexao = new Conexao();
$pessoa = new Pessoa($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $pessoa->$key = $value;
}

$resultado = $pessoa->procurar($_POST);
die(json_encode($resultado));
