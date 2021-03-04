var urlSite = 'http://54.201.44.119/';
var hoje = new Date();
var table;
var menus = [];
menus[0] = {'link': 'home.html', 'icone': 'fa-envelope', 'nome': 'Mensagem'};
menus[1] = {'link': 'pessoa.html', 'icone': 'fa-user', 'nome': 'Meu Perfil'};
menus[2] = {'link': 'contato.html', 'icone': 'fa-commenting-o', 'nome': 'Contato'};

function datatablePadrao(id, dados, colunas, colunasVisiveis) {
    if(table != undefined && table != null){
        table.destroy();
    }
    table = $('#' + id).DataTable({
        paging: false,
        searching: false,
        data: dados,
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

function converteStatus(status){
    if(status == "i"){
        return "Inativo";
    }else{
        return "Ativo";
    }
}

function abrirMensagem(){
    location.href="home.html";
}

function montaMenu(){
    var html = "";
    $.each(menus, function(i, item){
        html += '<li>';
        html += `<a href="${item.link}"><i class="fa ${item.icone}"></i> <span>${item.nome}</span></a>`;
        html += '</li>';
    });

    $("#menuNavegacao").html('<li class="header">MENU NAVEGAÇÃO</li>' + html);
}

$(function(){
    montaMenu();
    $('.sidebar-menu').tree();
    $(".anoAtual").html(hoje.getFullYear());
    $(".nomeUsuario").html(localStorage.getItem('nome'));
    $(".dtCadastroUsuario").html(converteDataBrasil(localStorage.getItem('dtcadastro')));
    if(localStorage.getItem('imagem') != undefined && localStorage.getItem('imagem') != null
        && localStorage.getItem('imagem') != ''){
        $(".imgUsuario").prop('src', 'http://54.201.44.119/arquivos/' + localStorage.getItem('imagem'));
    }
    
    $("#btSair").click(function(){
        localStorage.clear();
        location.href="index.html";
    });
})