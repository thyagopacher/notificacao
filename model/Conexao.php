<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexao
 *
 * @author SYSTEM
 */
class Conexao {
    
    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = 'Brasil1602*';
    private $banco = 'notificacao';
    private $porta = '3306';
    public $resultado;    
    public $conexao;    
    
    public function __construct() {
        if ($this->conexao == NULL) {
            $this->conectar();
        }
    }
    
    public function __destruct() {
        if (isset($this->resultado) && $this->resultado != NULL) {
            
            unset($this->resultado);
        }
        if ($this->conexao != FALSE) {
            mysqli_close($this->conexao);
        }
        unset($this->conexao);        
    }

    public function conectar() {
        $this->conexao = mysqli_init();
        mysqli_options($this->conexao, MYSQLI_CLIENT_INTERACTIVE, 1024);
        mysqli_real_connect($this->conexao, $this->host, $this->usuario, $this->senha, $this->banco, $this->porta, NULL, MYSQLI_CLIENT_COMPRESS);
        mysqli_set_charset($this->conexao, 'utf8');
    }    

    /* 
     * retorna mysql_query 
     * @return result
     */
    public function comando($query) {
        if ($query != '') {
            $this->resultado = mysqli_query($this->conexao, $query);
            return $this->resultado;
        }
    }

    public function comandoArray($query) {
        if($query != ""){
            return mysqli_fetch_array(mysqli_query($this->conexao, $query, MYSQLI_USE_RESULT), MYSQLI_ASSOC);
        }
        return null;
    }    
    
    /*     * retorna a quantidade de resultados da consulta */
    public function qtdResultado($resultado) {
        return mysqli_num_rows($resultado);
    }    
    
    /**
     * @param string $query comando para ser pesquisado
     * @return array retorna um array do tipo da tabela que foi pesquisado
     */
    public function retornaArray($query){
        $res = $this->comando($query) or die(mysqli_error($this->conexao));
        return mysqli_fetch_all($res,MYSQLI_ASSOC);
    }
    
    public function resultadoArray($resultado = null) {
        if ($resultado != NULL) {
            $this->resultado = $resultado;
        }
        return mysqli_fetch_array($this->resultado, MYSQLI_ASSOC);
    }  
    
    /**
     * @author Thyago Henrique Pacher <thyago.pacher@gmail.com>
     * @param string $tabela 
     * @param array $objeto 
     * @return boolean true para sucesso
     */
    public function inserir($tabela, $objeto) {
        $valores = '';
        $campos = '';
        $res = $this->comando('DESC ' . $tabela);
        if ($this->qtdResultado($res) > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                if (($campoChave != 'PRI' || $campoNome == "codempresa") && isset($objeto->$campoNome) && $objeto->$campoNome != NULL && $objeto->$campoNome != '') {
                    if(is_string($objeto->$campoNome)){
                        $objeto->$campoNome = addslashes($objeto->$campoNome);
                    }
                    $campos .= "{$campoNome},";
                    $valores .= $this->montaCampos($campo['Type'], $objeto->$campoNome, $campoNome);
                }
            }
        }
        $sql = 'insert into ' . $tabela . '(' . substr($campos, 0, strlen(trim($campos)) - 1) . ') values(' . substr($valores, 0, strlen(trim($valores)) - 1) . ')';
        return mysqli_real_query($this->conexao, $sql);
    }

    public function atualizar($tabela, $objeto) {
        $setar = '';
        $where = '';
        $chavePrimaria = 0;
        $res = $this->comando('DESC ' . $tabela);
        if ($this->qtdResultado($res) > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                $objeto->$campoNome = addslashes($objeto->$campoNome);
                if ($campoChave != 'PRI' && isset($objeto->$campoNome) && $objeto->$campoNome != NULL && $objeto->$campoNome != '') {
                    $setar .= $this->montaCampos($campo['Type'], $objeto->$campoNome, $campoNome, true);
                } elseif ($campoChave === 'PRI') {
                    $chavePrimaria = $objeto->$campoNome;
                    $where .= $campoNome . ' = "' . $chavePrimaria . '"';
                }
            }
        }

        $sql = 'update ' . $tabela . ' set ' . substr($setar, 0, strlen(trim($setar)) - 1) . ' where ' . $where;
        return mysqli_real_query($this->conexao, $sql);
    }

    public function excluir($tabela, $objeto) {
        $where = '';
        $res = $this->comando('DESC ' . $tabela);
        $chavePrimaria = 0;
        if ($this->qtdResultado($res) > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                if ($campoChave === 'PRI') {
                    $chavePrimaria = $objeto->$campoNome;
                    $where .= $campoNome . '= "' . $chavePrimaria . '"';
                    break;
                }
            }
        }
        if (strstr($tabela, 'status') == FALSE && isset($_SESSION['codempresa']) && $_SESSION['codempresa'] != NULL && $_SESSION['codempresa'] != "") {
            $where .= " and {$tabela}.codempresa = {$_SESSION['codempresa']}";
        }
        $sql = 'delete from ' . $tabela . ' where ' . $where;
        return mysqli_real_query($this->conexao, $sql);
    }   

    public function montaCampos($tipo, $valor, $nome, $ehAtualizar = false) {
        if ($tipo === 'text') {
            $valorDefinido = '"' . $valor . '"';
        } elseif ($tipo === 'date' && $valor != NULL && $valor != "" && strpos($valor, '/')) {
            $valorDefinido = '"' . implode('-', array_reverse(explode('/', $valor))) . '"';
        } elseif ($tipo === 'double' && strpos($valor, ',')) {
            $valorDefinido = '"' . str_replace(',', '.', $valor) . '"';
        } elseif ($tipo == "int(11)") {
            $valorDefinido = (int) $valor;
        } else {
            $valorDefinido = '"' . $valor . '"';
        }
        if ($ehAtualizar) {
            $valorDefinido = $nome . ' = ' . $valorDefinido;
        }
        return $valorDefinido . ',';
    }    
}
