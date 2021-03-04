<?php
/**
 * permite requisições de outros lugares
 */
header('Access-Control-Allow-Origin: *');  
session_start();
include "../model/Conexao.php";
include "../model/Pessoa.php";
$conexao = new Conexao();
$pessoa = new Pessoa($conexao);

$variables = (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET') ? $_GET : $_POST;
foreach ($variables as $key => $value) {
    $pessoa->$key = $value;
}

$pessoap = $pessoa->login($_POST);
if(isset($pessoap["codpessoa"]) && $pessoap["codpessoa"] != NULL && $pessoap["codpessoa"] != ""){
    $_SESSION["codpessoa"] = $pessoap["codpessoa"];
    $_SESSION["nome"] = $pessoap["nome"];
    $_SESSION["imagem"] = $pessoap["imagem"];
    $_SESSION["dtcadastro"] = $pessoap["dtcadastro"];
    die(json_encode(array('mensagem' => 'Logado com sucesso !!!', 'situacao' => true, 
        'nome' => $pessoap["nome"], 'codpessoa' => $pessoap["codpessoa"],
        'imagem' => $pessoap["imagem"], 'dtcadastro' => $pessoap["dtcadastro"], 'email' => $pessoa->email)));
}else{
    die(json_encode(array('mensagem' => 'Não pode realizar login, nenhum usuário encontrado', 'situacao' => false)));
}
