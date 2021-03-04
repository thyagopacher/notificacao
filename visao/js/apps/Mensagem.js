var colunasTableMensagem = [
    {
        data: 'dtcadastro', 
        render: function (data, type, row) {
            return converteDataBrasil(data);
        }
    },    
    {data: 'assunto'},
    {data: 'nome_paraquem'}
];

function format (d) {
    return '<table class="table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr class="active"><td>Mensagem:</td><td>'+d.texto+'</td></tr></table>';
}

function procurarMensagem(limit) {
    if(limit != undefined && limit != null && limit != ""){
        $("#limit").val(limit);
    }    
    $.ajax({
        url: urlSite + "/control/ProcurarMensagem.php",
        type: "POST",
        data: $("#fProcurarmensagem").serialize(),
        dataType: 'json',
        success: function (data) {
            $("#listagemMensagem").show();
            datatablePadrao('tmensagem', data, colunasTableMensagem, [0, 1, 2]);
            $("#tmensagem tr").click(function(){
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            });           
        }, error: function (errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

$(function () {

    procurarMensagem(5);
    $("#paraquem").val(localStorage.getItem('codpessoa'));
    $(".tituloPagina").html("Mensagem");
    $("#legendaPagina").html('Visualize as mensagens enviadas para você');

    $("#btPesquisarMensagem").click(function () {
        procurarMensagem();
    });

});
