<?php

  if (! isset($_SESSION['logado'])) {
    header('LOCATION: index.php');
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
                <h1>ALERTA!</h1>
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
        <div id='esq' class='esqLarge'>

            <form action="application/inserir-colaborador.php" method="POST" enctype="multipart/form-data" id="form-colabs">

                <div class='ipt' id="ipt2">
                    <label for="txt_id">ID:</label>
                    <input type="text" name="txt_id" id="txt_id" value="NOVO" readonly><br>
                </div>


                <div class='ipt'>
                    <label for="txt_nome">NOME:</label>
                    <input type="text" name="txt_nome" id="txt_nome" required placeholder="EX: João Garcia"><br>
                </div>


                <div class='ipt'>
                    <label for="txt_cpf">CPF:</label>
                    <input type="text" name="txt_cpf" id="txt_cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="EX: 123.456.789-00" maxLength='14' required><br>
                </div>

                <div class='ipt'>
                    <label for="txt_cpf">FUNÇÃO:</label>
                    <input type="text" name="txt_funcao" id="txt_funcao" required placeholder="EX: Chefe de Máquina"><br>
                </div>

                <div class='ipt'>
                    <label for="txt_cpf">TURNO:</label>
                    <input type="text" name="txt_turno" id="txt_turno" required placeholder="EX: Matutino"><br>
                </div>

                <div class='ipt'>
                    <label for="txt_cpf">Data AD.:</label>
                    <input type="date" name="txt_admissao" id="txt_admissao" required><br>
                </div>

                <div class='ipt'>
                    <label for="txt_cpf">FOTO:</label>
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

                <Table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>FUNÇÃO</th>
                            <th>TURNO</th>
                            <th>DATA AD.</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once 'application/class/BancoDeDados.php';
                            $dataBase = new BancoDeDados;

                            $sql = "SELECT * FROM colaboradores";
                            $parametros = [];
                            $dados = $dataBase->selecionarRegistros($sql, $parametros);

                            foreach($dados as $linha){
                                print "
                                    <tr>
                                        <td>{$linha['id_colaborador']}</td>
                                        <td>{$linha['nome']}</td>
                                        <td>{$linha['cpf']}</td>
                                        <td>{$linha['funcao']}</td>
                                        <td>{$linha['turno']}</td>
                                        <td>{$linha['data_ad']}</td>
                                        <td class='tdd'>

                                            <button class='btn_alterar' onclick='alterar({$linha['id_colaborador']})'><a></a></button>
                                            <button class='btn_excluir' onclick='excluir({$linha['id_colaborador']}, \"{$linha['imagem']}\")'><a></a></button>
                                            
                                        </td>
                                    </tr>
                                ";
                            }
                
                
                        ?>
                    </tbody>  
                    </tfoot>
                </Table>

        </div>
    </main>
</body>
<script>

        function excluir(id, imagem){
            var opcao = confirm('Deseja excluir o colaborador?')

            if(opcao){
                window.location = "application/excluir-colaborador.php?id=" + id + "&img=" + imagem
            }
        }

    function alterar(idColaborador){
        $.ajax({
                method: 'post',
                url: 'application/selecionar-colaborador.php',
                dataType: 'json',
                data: {
                    id: idColaborador
                },
                success: function(retorno) {
                    $('#txt_id').val(retorno['id_colaborador']);
                    $('#txt_nome').val(retorno['nome']);
                    $('#txt_cpf').val(retorno['cpf']);
                    $('#txt_funcao').val(retorno['funcao']);
                    $('#txt_turno').val(retorno['turno']);
                    $('#txt_admissao').val(retorno['data_ad']);
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