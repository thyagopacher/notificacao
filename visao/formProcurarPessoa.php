<form method="post" id="fProcurarpessoa">
    <div class="form-group col-md-6">
        <label>Nome</label>
        <input type="text" class="form-control" name="nome">
    </div>
    <div class="form-group col-md-6">
        <label>
            <i class="fa fa-envelope-o"></i>
            E-mail
        </label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group col-md-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="">--Selecione--</option>
            <option value="a">Ativo</option>
            <option value="i">Inativo</option>
        </select>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <i class="fa fa-calendar"></i>
                Dt. Inicio
            </label>
            <input type="date" class="form-control" name="data1" title="Digite data de inicio onde foi feito o cadastro">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>
                <i class="fa fa-calendar"></i>
                Dt. Fim
            </label>
            <input type="date" class="form-control" name="data2" title="Digite data de fim onde foi feito o cadastro">
        </div>
    </div>
    <div class="col-md-12">
        <button type="button" id="btPesquisarPessoa" class="btn btn-default"><i class="fa fa-search"></i> Procurar</button>
    </div>
</form>
<br>
<div class="row col-md-12" id="listagemPessoa" style="display: none">
    <table id="tpessoa" class="table table-hover">
        <thead>
            <tr>
                <th>Dt. Cadastro</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Opções</th>
            </tr>
        </thead>
    </table>
</div>