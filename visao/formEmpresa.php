<?php
$inputHidden = '';
$sql = "select * from empresa";
$empresap = $conexao->comandoArray($sql);

if (isset($empresap["codempresa"]) && $empresap["codempresa"] != NULL && $empresap["codempresa"] != "") {
    $inputHidden = '<input type="hidden" name="codempresa" value="' . $empresap["codempresa"] . '">';
}
?>
<form action="/control/SalvarEmpresa.php" method="post" id="fempresa">
    <?= $inputHidden ?>
    <div class="form-group col-md-6">
        <label>Nome</label>
        <input type="text" class="form-control" name="razao" id="razao" required minlength="3" maxlength="50" value="<?= $empresap["razao"] ?>">
    </div>
    <div class="form-group col-md-6">
        <label>E-mail</label>
        <input type="email" class="form-control" name="email" id="email" required minlength="3" maxlength="150" value="<?= $empresap["email"] ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Telefone</label>
        <input type="text" class="form-control telefone" name="telefone" id="telefone" minlength="3" maxlength="20" value="<?= $empresap["telefone"] ?>">
    </div>    
    <div class="form-group col-md-6">
        <label>Celular</label>
        <input type="text" class="form-control celular" name="celular" id="celular" minlength="3" maxlength="20" value="<?= $empresap["celular"] ?>">
    </div>    
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Salvar</button>
        <button type="button" id="btNovoEmpresa" class="btn btn-primary">Novo</button>
    </div>
</form>