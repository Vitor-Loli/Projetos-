<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EPI's System</title>

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel='stylesheet' href='assets/css/modal.css'>


</head>
<body>

<?php

    $stt = isset($_GET['stt'])? $_GET['stt']: '';

    if($stt != ''){

        abrirModal($stt);

    }

        
    function abrirModal($status){

        print "

        <div id='demo-modal' class='modal' '>
            <div class='content'>
                <a href='#' class='close'>&times;</a>
                <div class='head'>
                    <h1>ALERTA</h1>
                </div>
                <p>{$status}</p>
                <div class='footer'>
                    <a href='#' class='footer-btn-close'> Fechar </a>
                </div>
            </div>
        </div>
        
        <script>
            window.location.hash = 'demo-modal';
        </script>
        
        ";

    }

    ?>


    <main>
        <div class="login_div">
            <form action="application/fazer-login.php" method="POST" class="form_login">

                <h1 class="titulo_login">Login</h1>

                <div class="input_group">
                    <label for="txtUser" class="label_login">
                        Usuário:
                    </label> <br>
                    <div class="inputs">
                        <input type="text" name="txtUser" id="txtUser" placeholder="Insira seu usuário aqui!" class="input_login">
                    </div>
                
                </div>

                <div class="input_group">
                    <label for="txtPassword" class="label_login">
                        Senha:
                    </label> <br>
                    <div class="inputs">
                        <input type="password" name="txtPassword" id="txtPassword" placeholder="Insira sua senha aqui!" class="input_login">
                    </div>
                
                </div>

                <div class="botao_div">
                    <input type="submit" value="Login" class="botao_enviar">
                </div>
            


            </form>
        </div>
    </main>
    
    

</body>
</html>