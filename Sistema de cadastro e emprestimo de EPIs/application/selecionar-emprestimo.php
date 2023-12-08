<?php

    $id = isset($_POST['id']) ? $_POST['id'] : '';
        if ($id == '') {
            echo 'ID não encontrado';
            exit;
        }

        // Consulta no Banco
        require_once 'class/BancoDeDados.php';
        $banco =  new BancoDeDados;
        $sql = 'SELECT * FROM emprestimos WHERE id_emprestimo = ?';
        $params = [$id];
        $dados = $banco->selecionarRegistro($sql, $params);
        echo json_encode($dados);