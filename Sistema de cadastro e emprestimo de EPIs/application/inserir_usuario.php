<?php

    require_once 'class/BancoDeDados.php';

    $id = isset($_POST['txt_id'])   ?                   $_POST['txt_id'] : '';
    $nome = isset($_POST['txt_nome'])  ?           $_POST['txt_nome'] : '';
    $user = isset($_POST['txt_usuario'])  ?       $_POST['txt_usuario'] : '';
    $senha = isset($_POST['txt_senha'])          ?     $_POST['txt_senha']         : '';

    if($id == "" || $nome == "" || $user == "" || $senha == ""){
        echo "<script>

            window.location = '../inicio.php?tela=user&stt= Existem campos vazios!;

        </script>";
    }

    $dataBase = new BancoDeDados;

    if($id == "NOVO"){

        $sql = "INSERT INTO usuarios (nome, usuario, senha) VALUES (?,?,?)";
        $parametros = [$nome, $user, $senha];
        $mensagem = 'Usuario cadastrado com sucesso!';

    }else{
            $sql = "UPDATE usuarios SET nome = ?, usuario = ?, senha = ? WHERE id_usuario = ?";
            $parametros = [$nome, $user, $senha, $id];      
        
        $mensagem = 'EPI alterado com sucesso!';
    }

    
    $dataBase->executarComando($sql, $parametros);

    echo "<script>
            window.location = '../inicio.php?tela=user&stt= {$mensagem}';
        </script>";

?>