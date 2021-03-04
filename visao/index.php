<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Painel Administrativo | Log in</title>
        <?php 
        include "css.php";
        ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
        
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">Painel Administrativo</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Entre na sua sessão</p>

                <form id="flogin" action="/control/Login.php" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        
        
        <?php
            include 'javascript.php'
        ?>
        <script src="/visao/js/index.js?<?=date("YmdHis")?>"></script>
    </body>
</html>
