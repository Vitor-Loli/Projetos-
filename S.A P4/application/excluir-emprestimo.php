<?php

    $id = isset($_GET['id'])?  $_GET['id'] : '';

    if($id == ''){
        print '<script>
            window.location = "../inicio.php?tela=emp&stt= Id inexistente! Por favor verifique!"
        </script>';
    } 

    require_once 'class/BancoDeDados.php';

    $dataBase = new BancoDeDados;
    $sql = 'DELETE FROM emprestimos WHERE id_emprestimo = ?';
    $parametros = [$id];
    $dataBase->executarComando($sql, $parametros);

    print '<script>
            window.location = "../inicio.php?tela=emp&stt= Empréstimo excluido com sucesso!"
        </script>';
    
    ?> 