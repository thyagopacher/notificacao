<?php
session_start();
$temTabela = isset($_GET["tabela"]) && $_GET["tabela"] != NULL && $_GET["tabela"] != "";
if(strstr(getenv('REQUEST_URI'), '?') != FALSE){
    $separa_url = explode('?', getenv('REQUEST_URI'));
    $separa_url2 = explode('=', $separa_url[1]);
    $_GET[$separa_url2[0]] = $separa_url2[1];
}


if ($temTabela) {
    $pagina = ucfirst($_GET["tabela"]);
    $legendaPagina = '- formulário de cadastro';
} else {
    $pagina = "Home";
    $legendaPagina = '- painel administrativo';
}
include "../model/Conexao.php";
$conexao = new Conexao();
$urlImagem = "https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/img/user2-160x160.jpg";
if(isset($_SESSION["imagem"]) && $_SESSION["imagem"] != NULL && $_SESSION["imagem"] != ""){
    $urlImagem = '../arquivos/'. $_SESSION["imagem"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Painel Administrativo | <?=$pagina?></title>
        <?php
        include "css.php";
        if ($temTabela) {
            echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">';
            echo '<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">';
        }
        ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/css/skins/_all-skins.min.css" integrity="sha256-Ca26OZvYUeHTbbbRypb8mPw4GAGbl1odWPoqCYH30y4=" crossorigin="anonymous" />
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="/" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>LTE</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?=$urlImagem?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $_SESSION["nome"] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?=$urlImagem?>" class="img-circle" alt="User Image">

                                        <p>
                                            <?= $_SESSION["nome"] ?>
                                            <small>Membro desde <?= date("d/m/Y H:i", strtotime($_SESSION["dtcadastro"])); ?></small>
                                        </p>
                                    </li>

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="/pessoa?codpessoa=<?= $_SESSION["codpessoa"] ?>" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="/sair" class="btn btn-default btn-flat">Sair</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?=$urlImagem?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= $_SESSION["nome"] ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MENU NAVEGAÇÃO</li>
                        <li>
                            <a href="./pessoa">
                                <i class="fa fa-users"></i> <span>Pessoa</span>
                            </a>
                        </li>
                        <li>
                            <a href="./mensagem">
                                <i class="fa fa-envelope"></i> <span>Mensagem</span>
                            </a>
                        </li>
                        <li>
                            <a href="./empresa">
                                <i class="fa fa-building"></i> <span>Inf. Empresa</span>
                            </a>
                        </li>
                        <li>
                            <a href="./contato">
                                <i class="fa fa-commenting-o"></i> <span>Msg. Contato</span>
                            </a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?= $pagina ?>
                        <small><?= $legendaPagina ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Cadastro</a></li>
                        <li class="active"><?= $pagina ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php if ($temTabela) { ?>
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header">
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                            title="Collapse">
                                        <i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">

                                <ul class="nav nav-tabs">
                                    <?php if($pagina != "Contato"){?>
                                    <li class="active"><a data-toggle="tab" href="#home">Cadastro</a></li>
                                    <?php }?>
                                    <?php if($pagina != "Empresa"){?>
                                    <li><a data-toggle="tab" href="#menu1">Procurar</a></li>
                                    <?php }?>
                                </ul>

                                <div class="tab-content">
                                    <?php 
                                    $abaCadastroAtivo = ' in active';
                                    $abaProcurarAtivo = '';
                                    if($pagina == "Contato"){
                                        $abaProcurarAtivo = ' in active';
                                        $abaCadastroAtivo = '';
                                    }
                                    
                                    if($pagina != "Contato"){?>
                                    <div id="home" class="tab-pane fade <?=$abaCadastroAtivo?>">
                                        <?php include "form{$pagina}.php"; ?>
                                    </div>
                                    <?php }?>
                                    <?php 
                                    if($pagina != "Empresa"){?>
                                    <div id="menu1" class="tab-pane fade <?=$abaProcurarAtivo?>">
                                        <?php include "formProcurar{$pagina}.php"; ?>
                                    </div>
                                    <?php }?>
                                </div>

                            </div>
                        </div>
                        <!-- /.box -->
                        <?php
                    } else {
                        echo '<div class="alert alert-info"><strong>Informação!</strong> Utilize o menu ao lado para começar a trabalhar no painel</div>';
                    }
                    ?>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-<?= date("Y") ?> <a href="#">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <?php
        include './javascript.php';
        if ($temTabela) {
            echo '<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>';
            echo '<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>';
            echo '<script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>';
            echo '<script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>';
            echo '<script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>';
            echo '<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>';
            echo '<script type="text/javascript" charset="utf-8" src="/visao/js/', $pagina, '.js?v=', date("YmdHis"), '"></script>';
        }
        ?>
        
        <!-- SlimScroll -->
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.8/js/demo.js"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })
        </script>
    </body>
</html>
