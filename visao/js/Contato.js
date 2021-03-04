var colunasTableContato = [
    {
        data: 'dtcadastro', 
        render: function (data, type, row) {
            return converteDataBrasil(data);
        }
    },    
    {data: 'mensagem'},
    {data: 'enviadopor'},
    {   
        data: 'email',
        render: function (data, type, row) {
            return '<a title="Clique para responder" href="mailto: '+data+'?subject=Resposta contato&body=Respondendo seu e-mail enviado"><i class="fa fa-envelope-o"></i></a> ';            
        }        
    },    
];

function procurarContato() {
    $.ajax({
        url: "/control/ProcurarContato.php",
        type: "POST",
        data: $("#fProcurarcontato").serialize(),
        dataType: 'json',
        success: function (data) {
            $("#listagemContato").show();
            datatablePadrao('tcontato', data, colunasTableContato, [0, 1, 2]);
        }, error: function (errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

$(function () {

    $("#btPesquisarContato").click(function () {
        procurarContato();
    });

});
