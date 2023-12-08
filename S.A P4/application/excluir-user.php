<?php

    $id = isset($_GET['id'])? $_GET['id']: '';

    if($id == ''){
        echo "<script>
            window.location = '../inicio.php?tela=user&stt= Id inexistente! Por favor verifique!';
        </script>";
    }

    require_once 'class/BancoDeDados.php';

    $dataBase = new BancoDeDados;

    $sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
    $parametros = [$id];
    $dataBase->executarComando($sql, $parametros);

    echo "<script>
            window.location = '../inicio.php?tela=user&stt= Usuario excluido com sucesso!';
        </script>";

?>