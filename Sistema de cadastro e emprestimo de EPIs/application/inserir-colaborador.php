<?php

    require_once 'class/BancoDeDados.php';
    

     $id    = isset($_POST['txt_id'])           ? $_POST['txt_id']          : '';
     $nome  = isset($_POST['txt_nome'])         ? $_POST['txt_nome']        : '';
     $cpf   = isset($_POST['txt_cpf'])          ? $_POST['txt_cpf']         : '';
     $turno   = isset($_POST['txt_turno'])          ? $_POST['txt_turno']         : '';
     $funcao   = isset($_POST['txt_funcao'])          ? $_POST['txt_funcao']         : '';
     $ad  = isset($_POST['txt_admissao'])          ? $_POST['txt_admissao']         : '';
     $imagem = isset($_POST['nomefoto'])          ? $_POST['nomefoto']         : '';

    if ($id == '' || $nome == '' || $cpf == '') {
        echo "<script>
            window.location = '../inicio.php?tela=colab&stt= Existem campos vazios! Por favor verifique!';
        </script>";
        exit;
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
        $sql = "INSERT INTO colaboradores (nome, cpf, imagem, funcao, turno, data_ad) VALUES (?, ?, ?, ?, ?, ?)";
        $parametros = [$nome, $cpf, $nome_imagem, $funcao, $turno, $ad];
        $mensagem = 'Colaborador cadastrado com sucesso!';
    } else{    
        $sql = "UPDATE colaboradores SET nome = ?, cpf = ?, imagem = ?, funcao = ?, turno = ?, data_ad = ? WHERE id_colaborador = ?";
        $parametros = [$nome, $cpf, $nome_imagem, $funcao, $turno, $ad,$id];
        $mensagem = 'Colaborador alterado com sucesso!';
    }

    
    
    $dataBase->executarComando($sql, $parametros);

    print "<script>
        window.location = '../inicio.php?tela=colab&stt= {$mensagem}'
    </script>"

?>