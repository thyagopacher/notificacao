
$(function () {

    var progress = $(".progress");
    var progressbar = $("#progressbar");
    var sronly = $("#sronly");

    $("#fempresa").submit(function () {
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
