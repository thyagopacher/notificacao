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

if (isset($_FILES["imagem"]) && $_FILES["imagem"] != NULL && $_FILES['imagem']['error'] == 0) {
    $separacao = explode('.', $_FILES["imagem"]['name']);
    $extensao = $separacao[1];
    $pessoa->imagem = 'data-'.date('Y-m-d') . time() . '.' . $extensao;
    $resUpload = move_uploaded_file($_FILES['imagem']['tmp_name'], "../arquivos/" . $pessoa->imagem);
    if($resUpload == FALSE){
        die(json_encode(array('mensagem' => 'Erro ao fazer upload da imagem !!!', 'situacao' => false)));
    }else{
        if(isset($pessoa->codpessoa) && $pessoa->codpessoa == $_SESSION["codpessoa"]){
            $_SESSION["imagem"] = $pessoa->imagem;
        }
    }
}


$resSalvar = $pessoa->salvar();
if ($resSalvar != FALSE) {
    if(isset($_POST["ehmobile"]) && $_POST["ehmobile"] != NULL && $_POST["ehmobile"] != ""){
        die(json_encode(array('mensagem' => 'Informações salvas com sucesso ! Favor aguardar a ativação do cadastro', 'situacao' => true)));
    }else{
        die(json_encode(array('mensagem' => 'Informações salvas com sucesso !!!', 'situacao' => true)));
    }
} else {
    die(json_encode(array('mensagem' => 'Erro ao salvar - causado por:' . mysqli_error($conexao->conexao), 'situacao' => false)));
}
