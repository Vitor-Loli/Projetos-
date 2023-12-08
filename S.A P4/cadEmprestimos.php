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
    <title>Cadastro de Emprestimos - EPI's System</title>

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
        <div id='esq' class='esqEmp'>

            <form action="application/fazer-emprestimo.php" method="POST">

                <div class=''>
                    <label for="txt_id">ID:</label>
                    <input type="text" name="txt_id" id="txt_id" value="NOVO" readonly required><br>
                </div>

                <div class=''>
                    <label for="txt_epis">EPI:</label>
                    <select name="txt_epis" id="txt_epis" required><br>

                        <option value="" >Selecione uma opção...</option>
                        <?php

                            require_once 'application/class/BancoDeDados.php';

                            $db = new BancoDeDados;
                            $sql = 'SELECT * FROM epis';
                            $dt = $db->selecionarRegistros($sql);


                            foreach ($dt as $linha) {
                                        
                                if($linha['quantidade'] < 1)
                                        {

                                    echo "<option disabled value='{$linha['id_epi']}'>{$linha['descricao']}</option>";

                                } else {
                                            
                                    echo "<option value='{$linha['id_epi']}'>{$linha['descricao']}</option>";

                                }

                            }


                        ?>

                    </select>
                </div>

                <div class=''>
                    <label for="txt_ca">CA EPI:</label>
                    <input type="text" name="txt_ca" id="txt_ca" required maxlength="5" placeholder="EX: 48067"><br>
                </div>

                <div class=''>
                    <label for="txt_colab">COLABORADOR:</label>
                    <select name="txt_colab" id="txt_colab" required>

                    <option value="">Selecione uma opção...</option>
                        <?php

                            require_once 'application/class/BancoDeDados.php';

                            $db = new BancoDeDados;
                            $sql = 'SELECT * FROM colaboradores';
                            $dt = $db->selecionarRegistros($sql);

                            foreach ($dt as $linha) {
                                
                                echo "<option value='{$linha['id_colaborador']}'>{$linha['nome']}</option>";

                            }


                        ?>

                    </select>

                </div>


                <div class=''>
                    <label for="txt_data">DATA:</label>
                    <input type="date" name="txt_date" id="txt_date" required><br>
                </div>

                <div class=''>
                    <input type="submit" name="btn_submit" id="btn_submit2">
                </div>




            </form>

        </div>

        <div id='dir'>

            <Table class="table" id='tableEmp'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>EPI</th>
                        <th>Usuario</th>
                        <th>Colaborador</th>
                        <th>Retirada</th>
                        <th>Devolução</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                      
                        require_once 'application/class/BancoDeDados.php';

                      
                        $db = new BancoDeDados;

                        $sql = 'SELECT emprestimos.*, colaboradores.nome AS nomeColab, epis.descricao, usuarios.nome AS nomeUser FROM emprestimos
                        INNER JOIN colaboradores ON emprestimos.fk_colaborador = colaboradores.id_colaborador
                        INNER JOIN epis ON emprestimos.fk_epi = epis.id_epi
                        INNER JOIN usuarios ON emprestimos.fk_usuario = usuarios.id_usuario';

                        $dt = $db->selecionarRegistros($sql);

                        foreach ($dt as $linha) {

                            if($linha['situacao'] == 'ABERTO'){

                                echo "<tr>
                                <td>{$linha['id_emprestimo']}</td>
                                <td>{$linha['descricao']}</td>
                                <td>{$linha['nomeUser']}</td>
                                <td>{$linha['nomeColab']}</td>
                                <td>{$linha['data_retirada']}</td>
                                <td>{$linha['data_devolucao']}</td>
                                <td>{$linha['situacao']}</td>
                                <td class='tdd'>
                                    <button class='btn_alterar' onclick='alterar({$linha['id_emprestimo']})'><a></a></button>
                                    <button class='btn_excluir' onclick='excluir({$linha['id_emprestimo']})'><a></a></button>
                                    <button class='btn_finalizar' onclick='finalizar({$linha['id_emprestimo']})'><a></a></button>

                                </td>
                            </tr>";

                            } else {

                                
                                echo "<tr>
                                <td>{$linha['id_emprestimo']}</td>
                                <td>{$linha['descricao']}</td>
                                <td>{$linha['nomeUser']}</td>
                                <td>{$linha['nomeColab']}</td>
                                <td>{$linha['data_retirada']}</td>
                                <td>{$linha['data_devolucao']}</td>
                                <td>{$linha['situacao']}</td>
                                <td class='tdd'>
                                    <button class='btn_excluir' onclick='excluir({$linha['id_emprestimo']})'><a></a></button>
                                </td>
                            </tr>";


                            }


                        }
                    ?>
                    
                </tfoot>
            </Table>

            

        </div>
    </main>
</body>

    <script>

        function insertEPI(id, descricao){

        }

        function alterar(id_emp){
            $.ajax({
                method: 'post',
                url: 'application/selecionar-emprestimo.php',
                dataType: 'json',
                data: {
                    id: id_emp
                },
                success: function(retorno) {
                    $('#txt_id').val(retorno['id_emprestimo']);
                    $('#txt_epis').val(retorno['fk_epi']);
                    $('#txt_ca').val(retorno['ca']);
                    $('#txt_colab').val(retorno['fk_colaborador']);
                    $('#txt_date').val(retorno['data_retirada']);
                    

                    
                }
            });
        }

        function excluir(id_emp){
            var opcao = confirm('Deseja excluir o emprestimo?')

            if(opcao){
                window.location = "application/excluir-emprestimo.php?id=" + id_emp
            }
        }

        function finalizar(id_emp){

            var opcao = confirm('Deseja finalizar o emprestimo?');

            if(opcao){

                window.location = 'application/finalizar-emprestimo.php?id=' + id_emp

            }

        }


    </script>


</html>