<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Mensagem{
    
    public $codmensagem;
    public $assunto;
    public $texto;
    public $dtcadastro;
    public $paraquem;
    public $codfuncionario;
    private $conexao;
    
    public function __construct($conn) {
        $this->conexao = $conn;
    }
    
    public function __destruct() {
        unset($this->conexao);
    }    
    
    public function salvar(){
        if(isset($this->codmensagem) && $this->codmensagem != NULL && $this->codmensagem != ""){
            return $this->atualizar();
        }else{
            return $this->inserir();
        }
    }
    
    public function inserir(){    
        if(!isset($this->codfuncionario) || $this->codfuncionario == NULL || $this->codfuncionario == ""){
            $this->codfuncionario = $_SESSION["codpessoa"];
        }
        return $this->conexao->inserir("mensagem", $this);
    }
    
    public function atualizar(){      
        return $this->conexao->atualizar("mensagem", $this);
    }  
    
    public function excluir(){
        return $this->conexao->excluir("mensagem", $this);
    }
    
    public function procurarCodigo(){
        return $this->conexao->procurarCodigo("mensagem", $this);
    }
    
    public function procurar($post){
        $and = "";

        if(isset($post["paraquem"]) && $post["paraquem"] != NULL && $post["paraquem"] != ""){
            $and .= " and mensagem.paraquem = '". $post["paraquem"]. "'";
        }
        if(isset($post["data1"]) && $post["data1"] != NULL && $post["data1"] != ""){
            $and .= " and mensagem.dtcadastro >= '". $post["data1"]. " 00:00:00'";
        }
        if(isset($post["data2"]) && $post["data2"] != NULL && $post["data2"] != ""){
            $and .= " and mensagem.dtcadastro <= '". $post["data2"]. " 23:59:59'";
        }
        if(isset($post["assunto"]) && $post["assunto"] != NULL && $post["assunto"] != ""){
            $and .= " and mensagem.assunto like '%". $post["assunto"]. "%'";
        }
        if(isset($post["texto"]) && $post["texto"] != NULL && $post["texto"] != ""){
            $and .= " and mensagem.texto like '%". $post["texto"]. "%'";
        }
        
        $sql = "select mensagem.*, pessoa.nome as nome_paraquem 
        from mensagem
        inner join pessoa on pessoa.codpessoa = mensagem.paraquem
        where 1 = 1 $and";
        if(isset($post["limit"]) && $post["limit"] != NULL && $post["limit"] != ""){
            $sql .= " limit {$post["limit"]}";
        }        
        return $this->conexao->retornaArray($sql);
    } 
  
}