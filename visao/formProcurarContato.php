<form method="post" id="fProcurarcontato">
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
        <button type="button" id="btPesquisarContato" class="btn btn-default"><i class="fa fa-search"></i> Procurar</button>
    </div>
</form>
<br>
<div class="row col-md-12" id="listagemContato" style="display: none">
    <table id="tcontato" class="table table-hover">
        <thead>
            <tr>
                <th>Dt. Cadastro</th>
                <th>Texto</th>
                <th>Enviado por</th>
                <th>Opções</th>
            </tr>
        </thead>
    </table>
</div>