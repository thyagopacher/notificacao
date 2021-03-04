var colunasTableMensagem = [
    {
        data: 'dtcadastro', 
        render: function (data, type, row) {
            return converteDataBrasil(data);
        }
    },    
    {data: 'assunto'},
    {data: 'nome_paraquem'},
    {   
        data: 'codmensagem',
        render: function (data, type, row) {
            var btEditar  = '<a href="?codmensagem='+data+'"><i class="fa fa-pencil"></i></a> '; 
            var btExcluir = '<a href="javascript: excluirMensagem(' + data + ')"><i class="fa fa-times"></i></a>';
            return btEditar + btExcluir;            
        }        
    },
];


function excluirMensagem(codigo) {
    swal({
        title: "Você está certo disso?",
        text: "Após excluido, as informações não poderão ser recuperadas!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/control/ExcluirMensagem.php",
                type: "POST",
                data: {codmensagem: codigo},
                dataType: 'json',
                success: function (data) {
                    if (data.situacao) {
                        swal({
                            title: "Excluido",
                            text: "Informações excluidas com sucesso !",
                            icon: "success"
                        });
                        procurarMensagem();
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


function procurarMensagem(limit) {
    if(limit != undefined && limit != null && limit != ""){
        $("#limit").val(limit);
    }
    $.ajax({
        url: "/control/ProcurarMensagem.php",
        type: "POST",
        data: $("#fProcurarmensagem").serialize(),
        dataType: 'json',
        success: function (data) {
            $("#listagemMensagem").show();
            datatablePadrao('tmensagem', data, colunasTableMensagem, [0, 1, 2]);
        }, error: function (errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function novaMensagem(){
    $("#fmensagem input, #fmensagem textarea, #fmensagem select").val("");
}

$(function () {
    procurarMensagem(5);
    $("#btNovoMensagem").click(function(){
        novaMensagem();
    });    
    
    $("#btPesquisarMensagem").click(function () {
        procurarMensagem();
    });

    var progress = $(".progress");
    var progressbar = $("#progressbar");
    var sronly = $("#sronly");

    $("#fmensagem").submit(function () {
        progress.css("visibility", "visible");
    }).ajaxForm({
        beforeSend: function () {
            progress.show();
            var percentVal = '0%';
            progressbar.width(percentVal);
            sronly.html(percentVal + ' Completo');
        },
        uploadProgress: function (event, position, total, percentComplete) {
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
                novaMensagem();
                window.history.pushState("", "Painel Administrativo | Mensagem", "/mensagem");
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
