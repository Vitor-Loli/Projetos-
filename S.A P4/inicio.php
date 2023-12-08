<?php
  // Controle de Sessão
  session_start();
  if (! isset($_SESSION['logado'])) {
    header('LOCATION: login.php');
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cabeçalho.css">
    <link rel="stylesheet" href="assets/css/rodape.css">

    <title>Início - EPI's Control</title>

</head>
<body>

    <header>

        <div id='Logo'><a href="inicio.php?tela=inicio"><img src="assets/imagens/logo.png"></a></div>

        <nav id='Nav'> 

            <ul id='List'>

                <li><a href="inicio.php?tela=colab">Colaboradores</a></li>
                <li><a href="inicio.php?tela=epi">EPI's</a></li>
                <li><a href="inicio.php?tela=emp">Empréstimo</a></li>
                <li><a href="inicio.php?tela=user">Usuarios</a></li>
                <li><a href="inicio.php?tela=buscar">Buscar</a></li>
                <li><a href="application/fazer-logout.php" id='sair'>Sair</a></li>

                

            </ul>

        </nav>

    </header>

    <main>



        <?php

            

            $tela = isset($_GET['tela'])? $_GET['tela']: "";

           

            switch ($tela) {  
                case 'colab':
                    include 'cadColaboradores.php';
                break;
                
                case 'epi':
                    include 'cadEPI.php';
                break;

                case 'emp':
                    include 'cadEmprestimos.php';
                break;

                case 'user':
                    include 'cadUser.php';
                break;

                case 'buscar':
                    include 'buscar.php';
                break;
                
                default:

                    include 'bem-vindo.html';
                    
                    break;
            }
        ?>

        <div>

           

        </div>
    </main>

    <footer>

        <div>

            <p id="a">Desenvolvimento de sistemas - 4ª fase</p>

        </div>

    </footer>
    
</body>
</html>