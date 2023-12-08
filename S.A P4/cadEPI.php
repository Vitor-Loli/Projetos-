<?php

  if (! isset($_SESSION['logado'])) {
    header('LOCATION: index.html');
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Colaboradores - EPI's System</title>


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
        <div id='esq'>

            <form action="application/inserir-epi.php" method="POST" enctype="multipart/form-data" >

                <div class='ipt'>
                    <label for="txt_id">ID:</label>
                    <input type="text" name="txt_id" id="txt_id" value="NOVO" readonly><br>
                </div>


                <div class='ipt'>
                    <label for="txt_desc">DESCRICÃO:</label>
                    <input type="text" name="txt_descricao" id="txt_desc" required placeholder="EX: Capacete Azul"><br>
                </div>


                <div class='ipt'>
                    <label for="txt_qtd">QUANTIDADE:</label>
                    <input type="text" name="txt_qtd" id="txt_qtd" required placeholder="EX: 123"><br>
                </div>


                <div class='ipt'>
                    <label for="txt_cpf">IMAGEM:</label>
                    <input type="file" name='fileImagem' id="fileImagem" accept="image/*" onchange="alterarImagem(this)">
                </div>

                <div class='ipt'>
                    <input type="text" name='nomefoto' id="nomefoto" hidden>
                </div>

                <div id='img_colab_view'>
                    <img src="assets/imagens/erro.jpg" id="img_foto_colab">
                </div>

                <div class='ipt'>
                    <input type="submit" name="btn_submit" id="btn_submit">
                </div>




            </form>

        </div>

        <div id='dir'>

            

            <Table class="table" id='tableEPI'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descricao</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once 'application/class/BancoDeDados.php';
                        $dataBase = new BancoDeDados;

                        $sql = "SELECT * FROM epis";
                        $parametros = [];
                        $dados = $dataBase->selecionarRegistros($sql, $parametros);

                        foreach($dados as $linha){
                            print "
                                <tr>
                                    <td>{$linha['id_epi']}</td>
                                    <td>{$linha['descricao']}</td>
                                    <td>{$linha['quantidade']}</td>
                                    <td class='tdd'>
                                        <button class='btn_alterar' onclick='alterar({$linha['id_epi']})'><a></a></button>
                                        <button class='btn_excluir' onclick='excluir({$linha['id_epi']}, \"{$linha['imagem']}\")'><a></a></button>
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
    function excluir(id, imagem){
        var opcao = confirm('Deseja realmente excluir?');

        if(opcao){
            window.location = 'application/excluir-EPI.php?id=' + id + '&img=' + imagem
        }
    }

    function alterar(idEPI){
        $.ajax({
                method: 'post',
                url: 'application/selecionar-epi.php',
                dataType: 'json',
                data: {
                    id: idEPI
                },
                success: function(retorno) {
                    // Imprimir os dados do retorno no formulário do modal
                    $('#txt_id').val(retorno['id_epi']);
                    $('#txt_desc').val(retorno['descricao']);
                    $('#txt_qtd').val(retorno['quantidade']);
                    $('#nomefoto').val(retorno['imagem']);
                    $('#img_foto_colab').prop('src', 'application/upload/' + retorno['imagem']);
                   
                }
            });
    }

    function alterarImagem(obj) {

        var img = document.getElementById('img_foto_colab');
        var reader = new FileReader();
        reader.onload = () => {
        img.src =  reader.result
        };
        reader.readAsDataURL(obj.files[0]);
  }
</script>
</html>