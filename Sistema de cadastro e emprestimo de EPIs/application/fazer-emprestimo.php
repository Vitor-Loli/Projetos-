<?php

    $form['id']   = isset($_POST['txt_id'])           ? $_POST['txt_id']          : '';
    $form['epi']   = isset($_POST['txt_epis'])           ? $_POST['txt_epis']          : '';
    $form['colab']   = isset($_POST['txt_colab'])           ? $_POST['txt_colab']          : '';
    $form['date']   = isset($_POST['txt_date'])           ? $_POST['txt_date']          : '';
    $form['ca'] = isset($_POST['txt_ca'])           ? $_POST['txt_ca']          : '';

    if (in_array('', $form)) {
        
        echo "<script>
                window.location = '../inicio.php?tela=emp&stt= Algum campo está vazio! Verifique.';
            </script>";

    }

    session_start();

    $idUser = $_SESSION['idUser'];


    require_once 'class/BancoDeDados.php';
    $db = new BancoDeDados;

    if ($form['id'] == 'NOVO') {
        
        $sql = 'INSERT INTO emprestimos (fk_usuario, fk_colaborador, fk_epi, ca, data_retirada, situacao) VALUES (?,?,?,?,?,?)';
        $params = [

            $idUser,
            $form['colab'],
            $form['epi'],
            $form['ca'],
            $form['date'],
            'ABERTO'

        ];

        $msg = 'Emprestimo cadastrado com sucesso!';

    } else {

        $sql = 'UPDATE emprestimos SET fk_usuario = ?, fk_colaborador = ?, fk_epi = ?, ca = ?, data_retirada = ? WHERE id_emprestimo = ?';

        $params = [

            $idUser,
            $form['colab'],
            $form['epi'],
            $form['ca'],
            $form['date'],
            $form['id']

        ];

        $msg = 'Emprestimo alterado com sucesso!';
    }

     $db->executarComando($sql, $params);

     
    $sql2 = "SELECT * FROM epis WHERE id_epi=?";
    $params2 = [$form['epi']];
    $dtEpis = $db->selecionarRegistro($sql2, $params2);

    $qtdAt = $dtEpis['quantidade'] - 1;

    $sql3 = "UPDATE epis SET quantidade = ? WHERE id_epi = ?";
    $params3 = [

        $qtdAt,
        $dtEpis['id_epi']

    ];


     $db->executarComando($sql3, $params3);



    print "<script>
         window.location = '../inicio.php?tela=emp&stt= {$msg}';
    </script>";

