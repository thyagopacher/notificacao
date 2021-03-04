<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Empresa{
    
    public $codempresa;
    public $razao;
    public $email;
    public $telefone;
    public $celular;
    public $dtcadastro;
    private $conexao;
    
    public function __construct($conn) {
        $this->conexao = $conn;
    }
    
    public function __destruct() {
        unset($this->conexao);
    }    
    
    public function salvar(){
        if(isset($this->codempresa) && $this->codempresa != NULL && $this->codempresa != ""){
            return $this->atualizar();
        }else{
            return $this->inserir();
        }
    }
    
    public function inserir(){    
        return $this->conexao->inserir("empresa", $this);
    }
    
    public function atualizar(){      
        return $this->conexao->atualizar("empresa", $this);
    }  
    
    public function excluir(){
        return $this->conexao->excluir("empresa", $this);
    }
    
    public function procurarCodigo(){
        return $this->conexao->procurarCodigo("empresa", $this);
    }
    
    public function procurar($post){
        $and = "";
        if(isset($post["data1"]) && $post["data1"] != NULL && $post["data1"] != ""){
            $and .= " and empresa.dtcadastro >= '". $post["data1"]. "'";
        }
        if(isset($post["data2"]) && $post["data2"] != NULL && $post["data2"] != ""){
            $and .= " and empresa.dtcadastro <= '". $post["data2"]. "'";
        }
        if(isset($post["razao"]) && $post["razao"] != NULL && $post["razao"] != ""){
            $and .= " and empresa.razao like '%". $post["razao"]. "%'";
        }
        
        $sql = "select empresa.*
        from empresa
        where 1 = 1 $and";
        return $this->conexao->retornaArray($sql);
    } 
  
}