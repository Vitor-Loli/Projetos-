<?php

    $descricao  = isset($_POST['txt_descricao'])         ? $_POST['txt_descricao']        : '';
                    

    if($descricao == '' ){
        echo "<script>
            alert('Existem campos vazios. Verifique!');
            window.location = '../inicio.php?tela=colab';
        </script>";
        exit;
    }

        require_once 'class/BancoDeDados.php';

        $dataBase = new BancoDeDados;
        $sql = ' SELECT * FROM epis WHERE descricao = ? ';
        $parametros = [$descricao];
        $dados = $dataBase->selecionarRegistro($sql, $parametros);

        if(empty($dados)){
            echo "<script>
                alert('EPI não encontrado!');
                window.location = '../inicio.php?tela=epi'
                </script>";
            }else {

                print "<script>
                    window.location = '../inicio.php?tela=buscar&idepi={$dados['id_epi']}&descricao={$dados['descricao']}&quantidade={$dados['quantidade']}'
                    </script>";
                }

?>