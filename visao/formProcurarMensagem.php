<form method="post" id="fProcurarmensagem">
    <input type="hidden" name="limit" id="limit" value="">
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
        <button type="button" id="btPesquisarMensagem" class="btn btn-default"><i class="fa fa-search"></i> Procurar</button>
    </div>
</form>
<br>
<div class="row col-md-12" id="listagemMensagem" style="display: none">
    <table id="tmensagem" class="table table-hover">
        <thead>
            <tr>
                <th>Dt. Cadastro</th>
                <th>Assunto</th>
                <th>Para quem</th>
                <th>Opções</th>
            </tr>
        </thead>
    </table>
</div>