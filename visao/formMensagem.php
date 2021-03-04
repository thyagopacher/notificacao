<?php
    $inputHidden = '';
    if(isset($_GET["codmensagem"]) && $_GET["codmensagem"] != NULL && $_GET["codmensagem"] != ""){
        $sql = "select * from mensagem where codmensagem = ". $_GET["codmensagem"];
        $mensagemp = $conexao->comandoArray($sql);
        $inputHidden = '<input type="hidden" name="codmensagem" value="'.$_GET["codmensagem"].'">';
    }
?>
<form action="/control/SalvarMensagem.php" method="post" id="fmensagem">
    <?=$inputHidden?>
    <div class="form-group col-md-6">
        <label>Assunto</label>
        <input type="text" class="form-control" name="assunto" id="assunto" required minlength="3" maxlength="50" value="<?=$mensagemp["assunto"]?>">
    </div>
    <div class="form-group col-md-6">
        <label>Para quem</label>
        <select name="paraquem" id="paraquem" class="form-control" required>
        <?php
        $respessoa = $conexao->comando("select codpessoa, nome from pessoa where status = 'a' order by nome");
        $qtdpessoa = $conexao->qtdResultado($respessoa);
        if($qtdpessoa > 0){
            echo '<option value="">--Selecione--</option>';
            while($pessoap = $conexao->resultadoArray($respessoa)){
                if(isset($mensagemp["paraquem"]) && $mensagemp["paraquem"] != NULL && $mensagemp["paraquem"] != ""){
                    echo '<option selected value="',$pessoap["codpessoa"],'">',$pessoap["nome"],'</option>';
                }else{
                    echo '<option value="',$pessoap["codpessoa"],'">',$pessoap["nome"],'</option>';
                }
            }
        }else{
            echo '<option value="">--Nada encontrado--</option>';
        }
        ?>
        </select>
    </div>
    <div class="form-group col-md-12">
        <label>
            Texto
        </label>
        <textarea name="texto" class="form-control" required spellcheck="true"><?=$mensagemp["texto"]?></textarea>
    </div>
    
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Salvar</button>
        <button type="button" id="btNovoMensagem" class="btn btn-primary">Novo</button>
    </div>
</form>