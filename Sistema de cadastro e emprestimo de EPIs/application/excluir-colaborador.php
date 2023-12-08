<?php

    $id = isset($_GET['id'])? $_GET['id']: '';
    $img = isset($_GET['img'])? $_GET['img']: '';

    if($id == ''){
        echo "<script>
            window.location = '../inicio.php?tela=colab&stt= Id inexistente! Por favor verifique!';
        </script>";
    }

    require_once 'class/BancoDeDados.php';

    $dataBase = new BancoDeDados;

    $sql = "SELECT COUNT(id_emprestimo) AS total FROM  emprestimos WHERE fk_colaborador = ?";
    $parametros = [$id];
    $dt = $dataBase->selecionarRegistro($sql, $parametros);

    if ($img != "") {
        $caminho = "upload/$img";
        if (file_exists($caminho)) {
            unlink($caminho);
        }
    }


    if($dt['total'] > 0){

        echo "<script>
            window.location = '../inicio.php?tela=colab&stt= Não é possivel excluir, esse Colaborador ainda está associado a algum emprestimo! Exclua o emprestimo, independente se está aberto ou fechado.';
        </script>";

    }else {

        $sql = 'DELETE FROM colaboradores WHERE id_colaborador = ?';
        $dataBase->executarComando($sql, $parametros);

        echo "<script>
             window.location = '../inicio.php?tela=colab&stt= Colaborador excluido com sucesso!';
        </script>";
    }

?>
