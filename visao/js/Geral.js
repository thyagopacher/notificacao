var table;

function datatablePadrao(id, dados, colunas, colunasVisiveis) {
    if (table != undefined && table != null) {
        table.destroy();
    }
    table = $('#' + id).DataTable({
        data: dados,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-clone" aria-hidden="true"></i> Copiar',
                exportOptions: {
                    columns: colunasVisiveis
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                exportOptions: {
                    columns: colunasVisiveis
                }
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> CSV',
                exportOptions: {
                    columns: colunasVisiveis
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                exportOptions: {
                    columns: colunasVisiveis
                }
            }
        ],
        columns: colunas,
        "language": {
            "lengthMenu": "Mostrando _MENU_ por pág.",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "pág _PAGE_ de _PAGES_ com _TOTAL_ resultados",
            "infoEmpty": "Nenhum resultado disponivel",
            "infoFiltered": "(filtrando de _MAX_ total resultados)",
            "search": 'Procurar',
            "paginate": {
                "previous": "Pág. ant.",
                "next": "Próx. pág."
            }
        },
    });
}

function converteDataBrasil(date) {
    return new Intl.DateTimeFormat('pt-BR').format(new Date(date));
}

function converteStatus(status) {
    if (status == "i") {
        return "Inativo";
    } else {
        return "Ativo";
    }
}

$(function () {
    if ($(".celular").length) {
        $(".celular").mask("(99)99999-9999");
    }
    if ($(".telefone").length) {
        $(".telefone").mask("(99)9999-9999");
    }
})