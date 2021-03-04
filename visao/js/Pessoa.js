var colunasTablePessoa = [
    {
        data: 'dtcadastro',
        render: function (data, type, row) {
            return converteDataBrasil(data);
        }
    },
    {data: 'nome'},
    {
        data: 'status',
        render: function (data, type, row) {
            return converteStatus(data);
        }
    },
    {
        data: 'codpessoa',
        render: function (data, type, row) {
            var btEditar = '<a href="?codpessoa=' + data + '"><i class="fa fa-pencil"></i></a> ';
            var btExcluir = '<a href="javascript: excluirPessoa(' + data + ')"><i class="fa fa-times"></i></a>';
            return btEditar + btExcluir;
        }
    },
];

function excluirPessoa(codigo) {
    swal({
        title: "Você está certo disso?",
        text: "Após excluido, as informações não poderão ser recuperadas!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/control/ExcluirPessoa.php",
                type: "POST",
                data: {codpessoa: codigo},
                dataType: 'json',
                success: function (data) {
                    if (data.situacao) {
                        swal({
                            title: "Excluido",
                            text: "Informações excluidas com sucesso !",
                            icon: "success"
                        });
                        procurarPessoa();
                    }else{
                        swal({
                            title: "Erro",
                            text: data.mensagem,
                            icon: "error"
                        });                        
                    }
                }, error: function (errorThrown) {
                    swal("Erro", "Erro causado por:" + errorThrown, "error");
                }
            });
        }
    });
}

function procurarPessoa() {
    $.ajax({
        url: "/control/ProcurarPessoa.php",
        type: "POST",
        data: $("#fProcurarpessoa").serialize(),
        dataType: 'json',
        success: function (data) {
            $("#listagemPessoa").show();
            datatablePadrao('tpessoa', data, colunasTablePessoa, [0, 1, 2]);
        }, error: function (errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function novaPessoa(){
    $("#fpessoa input, #fpessoa select").val('');
}

$(function () {

    $("#btNovoPessoa").click(function () {
        novaPessoa();
    });

    $("#btPesquisarPessoa").click(function () {
        procurarPessoa();
    });

    var progress = $(".progress");
    var progressbar = $("#progressbar");
    var sronly = $("#sronly");

    $("#fpessoa").submit(function () {
        progress.css("visibility", "visible");
    }).ajaxForm({
        beforeSend: function () {
            progress.show();
            var percentVal = '0%';
            progressbar.width(percentVal);
            sronly.html(percentVal + ' Completo');
        },
        uploadProgress: function (percentComplete) {
            var percentVal = percentComplete + '%';
            progressbar.width(percentVal);
            sronly.html(percentVal + ' Completo');
        },
        success: function () {
            var percentVal = '100%';
            progressbar.width(percentVal);
            sronly.html(percentVal + ' Completo');
        },
        complete: function (xhr) {
            var data = JSON.parse(xhr.responseText);
            if (data.situacao) {
                novaPessoa();
                window.history.pushState("", "Painel Administrativo | Pessoa", "/pessoa");
                swal({
                    title: "Cadastro",
                    text: "Cadastro realizado com sucesso",
                    icon: "success"
                });
            } else {
                swal({
                    title: "Erro",
                    text: data.mensagem,
                    icon: "error"
                });
            }
        }
    });
});
