<?php

    $id = isset($_GET['id'])  ? $_GET['id']  : '';
    $epi = isset($_GET['id2'])  ? $_GET['id2']  : '';

    if($id == '') {
        
        echo "<script>
        window.location = '../inicio.php?tela=emp&stt= Id inexistente! Por favor verifique!';
        </script>";

    } 

    require_once 'class/BancoDeDados.php';

    $db = new BancoDeDados;

    $datadev = date("Y/m/d");

    $sql = 'UPDATE emprestimos SET data_devolucao=?, situacao=? WHERE id_emprestimo=?';
    $params = [

        $datadev,
        'FECHADO',
        $id

    ];

    $db->executarComando($sql, $params);

    $sql = 'SELECT emprestimos.*, epis.id_epi, epis.quantidade FROM emprestimos INNER JOIN epis ON emprestimos.fk_epi = epis.id_epi WHERE id_emprestimo = ?';
    $params = [$id];
    $epiData = $db->selecionarRegistro($sql, $params);
    $qtd = $epiData['quantidade'] + 1;
    $epiID = $epiData['id_epi'];

    $sql = 'UPDATE epis SET quantidade=? WHERE id_epi=?';
    $params = [

        $qtd,
        $epiID

    ];

    $db->executarComando($sql,$params);

    echo "<script>
    window.location = '../inicio.php?tela=emp&stt= Empréstimo finalizado com sucesso!';
    </script>";