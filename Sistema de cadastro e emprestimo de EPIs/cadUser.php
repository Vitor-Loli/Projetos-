<?php

  if (! isset($_SESSION['logado'])) {
    header('LOCATION: index.html');
  }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuarios - EPI's System</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel='stylesheet' href='assets/css/modal.css'>
    

</head>
    <body>

        <?php

        $stt = isset($_GET['stt'])? $_GET['stt']: '';

        if($stt != ''){

            abrirModal($stt);

        }

            
        function abrirModal($status){

            print "

            <div id='demo-modal' class='modal' '>
                <div class='content'>
                    <a href='#' class='close'>&times;</a>
                    <div class='head'>
                        <h1>ALERTA</h1>
                    </div>
                    <p>{$status}</p>
                    <div class='footer'>
                        <a href='#' class='footer-btn-close'> Fechar </a>
                    </div>
                </div>
            </div>
            
            <script>
                window.location.hash = 'demo-modal';
            </script>
            
            ";

        }

        ?>

    <main>
        <div id='esq' class='esqSmall'>

            <form action="application/inserir_usuario.php" method="POST">

                <div class='ipt'>
                    <label for="txt_id">ID:</label>
                    <input type="text" name="txt_id" id="txt_id" value='NOVO' required readonly><br>
                </div>


                <div class='ipt'>
                    <label for="txt_nome">NOME:</label>
                    <input type="text" name="txt_nome" id="txt_nome" required placeholder="EX: Pedro Pedro"><br>
                </div>


                <div class='ipt'>
                    <label for="txt_usuario">USUARIO:</label>
                    <input type="text" name="txt_usuario" id="txt_usuario" required placeholder="EX: Pedrinho123"><br>
                </div>


                <div class='ipt'>
                    <label for="txt_senha">SENHA:</label>
                    <input type="text" name="txt_senha" id="txt_senha" required placeholder="Sua escolha">
                </div>

                <div class='ipt' id='btn_s_user'>
                    <input type="submit" name="btn_submit" id="btn_submit">
                </div>


            </form>

        </div>

        <div id='dir'>

        <Table class="table" id='tableUser'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Usuario</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once 'application/class/BancoDeDados.php';
                        $dataBase = new BancoDeDados;

                        $sql = "SELECT * FROM usuarios";
                        $parametros = [];
                        $dados = $dataBase->selecionarRegistros($sql, $parametros);

                        foreach($dados as $linha){
                            print "
                                <tr>
                                    <td>{$linha['id_usuario']}</td>
                                    <td>{$linha['nome']}</td>
                                    <td>{$linha['usuario']}</td>
                                    <td>{$linha['senha']}</td>
                                    <td class='tdd'>
                                        <button class='btn_alterar' onclick='alterar({$linha['id_usuario']})'><a></a></button>
                                        <button class='btn_excluir' onclick='excluir({$linha['id_usuario']})'><a></a></button>
                                    </td>
                                </tr>
                            ";
                        }
            
            
                    ?>
                    
                    
                </tfoot>
            </Table>

        </div>
    </main>
</body>

<script>
    function excluir(id){
        var opcao = confirm('Deseja realmente excluir?');

        if(opcao){
            window.location = 'application/excluir-user.php?id=' + id
        }
    }

    function alterar(idUser){
        $.ajax({
                method: 'post',
                url: 'application/selecionar-user.php',
                dataType: 'json',
                data: {
                    id: idUser
                },
                success: function(retorno) {

                    $('#txt_id').val(retorno['id_usuario']);
                    $('#txt_nome').val(retorno['nome']);
                    $('#txt_usuario').val(retorno['usuario']);
                    $('#txt_senha').val(retorno['senha']);
                   
                }
            });
    }

</script>

</html>