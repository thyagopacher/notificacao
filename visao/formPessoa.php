<?php
    $inputHidden = '';
    if(isset($_GET["codpessoa"]) && $_GET["codpessoa"] != NULL && $_GET["codpessoa"] != ""){
        $sql = "select * from pessoa where codpessoa = ". $_GET["codpessoa"];
        $pessoap = $conexao->comandoArray($sql);
        $inputHidden = '<input type="hidden" name="codpessoa" value="'.$_GET["codpessoa"].'">';
        $inputSenha = 'Só digite senha caso queira trocar';
    }else{
        $inputSenha = 'Por digite senha';
    }
?>
<form action="/control/SalvarPessoa.php" method="post" id="fpessoa">
    <?=$inputHidden?>
    <div class="form-group col-md-6">
        <label>
            Imagem
            <?php
                if(isset($pessoap["imagem"]) && $pessoap["imagem"] != NULL && $pessoap["imagem"] != ""){
                    echo ' - <a href="../arquivos/',$pessoap["imagem"],'" target="_blank" title="clique para abrir">Link imagem</a>';
                }
            ?>
        </label>
        <input type="file" class="form-control" name="imagem" id="imagem" accept="image/*">
    </div>    
    <div class="form-group col-md-6">
        <label>Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" required minlength="3" maxlength="50" placeholder="Por favor digite nome" value="<?=$pessoap["nome"]?>">
    </div>
    <div class="form-group col-md-6">
        <label>
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            E-mail
        </label>
        <input type="email" class="form-control" name="email" id="email" required minlength="5" maxlength="150" placeholder="Por favor digite e-mail" value="<?=$pessoap["email"]?>">
    </div>
    <div class="form-group col-md-6">
        <label>Senha</label>
        <input type="password" class="form-control" name="senha" id="senha" readonly="true" onfocus="$(this).removeAttr('readonly');" placeholder="<?=$inputSenha?>" value="">
    </div>

    <div class="form-group col-md-6">
        <label>Status</label>
        <select name="status" id="status" class="form-control" title="define aqui se a pessoa está ativa no sistema">
            <option value="">--Selecione--</option>
            <option value="a" <?php if($pessoap["status"] == "a"){echo "selected";}?>>Ativo</option>
            <option value="i" <?php if($pessoap["status"] == "i"){echo "selected";}?>>Inativo</option>
        </select>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Salvar</button>
        <button type="button" id="btNovoPessoa" class="btn btn-primary">Novo</button>
    </div>
</form>