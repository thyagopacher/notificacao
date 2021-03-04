<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Contato{
    
    public $codcontato;
    public $codpessoa;
    public $mensagem;
    public $dtcadastro;
    private $conexao;
    
    public function __construct($conn) {
        $this->conexao = $conn;
    }
    
    public function __destruct() {
        unset($this->conexao);
    }    
    
    public function salvar(){
        if(isset($this->codcontato) && $this->codcontato != NULL && $this->codcontato != ""){
            return $this->atualizar();
        }else{
            return $this->inserir();
        }
    }
    
    public function inserir(){    
        return $this->conexao->inserir("contato", $this);
    }
    
    public function atualizar(){      
        return $this->conexao->atualizar("contato", $this);
    }  
    
    public function excluir(){
        return $this->conexao->excluir("contato", $this);
    }
    
    public function procurarCodigo(){
        return $this->conexao->procurarCodigo("contato", $this);
    }
    
    public function procurar($post){
        $and = "";

        if(isset($post["codpessoa"]) && $post["codpessoa"] != NULL && $post["codpessoa"] != ""){
            $and .= " and contato.codpessoa = '". $post["codpessoa"]. "'";
        }
        if(isset($post["data1"]) && $post["data1"] != NULL && $post["data1"] != ""){
            $and .= " and contato.dtcadastro >= '". $post["data1"]. "'";
        }
        if(isset($post["data2"]) && $post["data2"] != NULL && $post["data2"] != ""){
            $and .= " and contato.dtcadastro <= '". $post["data2"]. "'";
        }
        
        $sql = "select contato.*, pessoa.nome as enviadopor, pessoa.email 
        from contato
        inner join pessoa on pessoa.codpessoa = contato.codpessoa
        where 1 = 1 $and";
        return $this->conexao->retornaArray($sql);
    } 
  
}