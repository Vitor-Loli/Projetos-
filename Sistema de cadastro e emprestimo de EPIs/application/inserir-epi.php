<?php

    require_once 'class/BancoDeDados.php';

    $id = isset($_POST['txt_id'])? $_POST['txt_id'] : '';
    $descricao = isset($_POST['txt_descricao'])? $_POST['txt_descricao'] : '';
    $quantidade = isset($_POST['txt_qtd'])? $_POST['txt_qtd'] : '';
    $imagem = isset($_POST['nomefoto'])          ? $_POST['nomefoto']         : '';

    if($id == "" || $descricao == "" || $quantidade == ""){
        echo "<script>
            window.location = '../inicio.php?tela=epi&stt= Campos vazios! Por favor verifique!';
        </script>";
    }

    if ($_FILES['fileImagem']['size'] > 0) {
        $nome_imagem = uniqid() . '.jpg';
        $destino = 'upload/' . $nome_imagem;
        move_uploaded_file($_FILES['fileImagem']['tmp_name'], $destino);
    } else{
        $nome_imagem = $imagem;
    }


    $dataBase = new BancoDeDados;

    if($id == "NOVO"){

        $sql = "INSERT INTO epis (descricao, quantidade, imagem) VALUES (?,?,?)";
        $parametros = [$descricao, $quantidade, $nome_imagem];
        $mensagem = 'EPI cadastrado com sucesso!';

    }else{
            $sql = "UPDATE epis SET descricao = ?, quantidade = ?, imagem = ? WHERE id_epi = ?";
            $parametros = [$descricao, $quantidade, $nome_imagem, $id];      
        
        $mensagem = 'EPI alterado com sucesso!';
    }

    
    $dataBase->executarComando($sql, $parametros);

    echo "<script>
            window.location = '../inicio.php?tela=epi&stt= {$mensagem}';
        </script>";

?>