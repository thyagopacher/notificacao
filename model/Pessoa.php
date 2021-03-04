<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Pessoa{
    
    public $codpessoa;
    public $nome;
    public $dtcadastro;
    public $email;
    public $senha;
    public $status;
    public $imagem;
    private $conexao;
    
    public function __construct($conn) {
        $this->conexao = $conn;
    }
    
    public function __destruct() {
        unset($this->conexao);
    }    
    
    public function salvar(){
        if(isset($this->codpessoa) && $this->codpessoa != NULL && $this->codpessoa != ""){
            return $this->atualizar();
        }else{
            return $this->inserir();
        }
    }
    
    public function inserir(){       
        if(isset($this->senha) && $this->senha != NULL && $this->senha != ""){
            $this->senha = md5($this->senha);
        }
        return $this->conexao->inserir("pessoa", $this);
    }
    
    public function atualizar(){      
        return $this->conexao->atualizar("pessoa", $this);
    }  
    
    public function excluir(){
        return $this->conexao->excluir("pessoa", $this);
    }
    
    public function procurarCodigo(){
        return $this->conexao->comandoArray("select * from pessoa where codpessoa = ". $this->codpessoa);
    }
    
    public function login(){
        $sql = "select codpessoa, nome, imagem, dtcadastro from pessoa where email = '{$this->email}' and senha = '".md5($this->senha)."'";
        return $this->conexao->comandoArray($sql);
    }
    
    public function procurar($post){
        $and = "";

        if(isset($post["data1"]) && $post["data1"] != NULL && $post["data1"] != ""){
            $and .= " and pessoa.dtcadastro >= '". $post["data1"]. " 00:00:00'";
        }
        if(isset($post["data2"]) && $post["data2"] != NULL && $post["data2"] != ""){
            $and .= " and pessoa.dtcadastro <= '". $post["data2"]. " 23:59:59'";
        }
        if(isset($post["status"]) && $post["status"] != NULL && $post["status"] != ""){
            $and .= " and pessoa.status = '". $post["status"]. "'";
        }
        if(isset($post["nome"]) && $post["nome"] != NULL && $post["nome"] != ""){
            $and .= " and pessoa.nome like '%". $post["nome"]. "%'";
        }
        if(isset($post["email"]) && $post["email"] != NULL && $post["email"] != ""){
            $and .= " and pessoa.email like '%". $post["email"]. "%'";
        }
        
        $sql = "select * from pessoa where 1 = 1 $and";
        return $this->conexao->retornaArray($sql);
    } 
  
}