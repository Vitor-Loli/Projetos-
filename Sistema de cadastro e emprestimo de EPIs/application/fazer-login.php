<?php

    require_once 'class/BancoDeDados.php';

    $usuario = isset($_POST['txtUser'])? $_POST['txtUser'] : '';
    $senha = isset($_POST['txtPassword'])? $_POST['txtPassword'] : '';

    if($usuario == '' || $senha == ''){
        print "<script> 
            window.location = '../index.html?stt= Dados em branco, por favor verifique!'
        </script>";
    }   

    $dataBase = new BancoDeDados;
    $sql = 'SELECT COUNT(id_usuario) AS total, id_usuario, nome FROM usuarios WHERE usuario = ? AND senha = ?';
    $parametros = [$usuario, $senha];
    $dados = $dataBase->selecionarRegistro($sql, $parametros);

    if($dados['total'] > 0){
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['idUser'] = $dados['id_usuario'];
        $_SESSION['nomeUser'] = $dados['nome'];
        header('LOCATION: ../inicio.php');
    } else{
        print "<script> 
            window.location = '../index.php?stt= Usuario ou senha incorretos!'
        </script>";
    }

?>