<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar - EPI's System</title>
    <link rel="stylesheet" href="assets/css/global.css">
</head>
<body>
    <main>
        <div class="esqLarge" id="esq">
            <form action="application/buscar-colaborador.php" method="POST" id="form-colabs">

                <h1 class='ipth1'>Colaboradores</h1>

                <div class='ipt3'>
                    <label for="txt_nome">NOME:</label>
                    <input type="text" name="txt_nome" id="txt_nome" required placeholder="EX: João Garcia"><br>
                </div>


                <div class='ipt3'>
                    <label for="txt_cpf">CPF:</label>
                    <input type="text" name="txt_cpf" id="txt_cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="EX: 123.456.789-00" maxLength='14' required><br>
                </div>

                <div class='ipt3' id='btn_buscar'>
                    <input type="submit" value="Buscar" name="btn_submit" id="btn_submit">
                </div>

            </form>

            <form action="application/buscar-epi.php" method="POST" id="form-colabs">

                <h1 class='ipth1' >EPIs</h1>

                <div class='ipt3' id=''>
                    <label for="txt_desc">DESCRICÃO:</label>
                    <input type="text" name="txt_descricao" id="txt_desc" required placeholder="EX: Capacete Azul"><br>
                </div>

                <div class='ipt3' id='btn_buscar'>
                    <input type="submit" value="Buscar" name="btn_submit" id="btn_submit">
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

                            $id    = isset($_GET['id'])           ? $_GET['id']          : '';
                            $nome  = isset($_GET['nome'])         ? $_GET['nome']        : '';
                            $cpf   = isset($_GET['cpf'])          ? $_GET['cpf']         : '';
                            $turno   = isset($_GET['turno'])          ? $_GET['turno']         : '';
                            $funcao   = isset($_GET['funcao'])          ? $_GET['funcao']         : '';
                            $data_ad  = isset($_GET['data_ad'])          ? $_GET['data_ad']         : '';
                
                        
                            print "
                                <tr>
                                    <td>$id</td>
                                    <td>$nome</td>
                                    <td>$cpf</td>
                                    <td>$funcao</td>
                                    <td>$turno</td>
                                    <td>$data_ad</td>
                                    <td class='tdd'>

                                        <button class='btn_alterar' onclick='alterar($id)'><a></a></button>
                                        <button class='btn_excluir' onclick='excluir($id)'><a></a></button>
                                        
                                    </td>
                                </tr>
                            ";
                        


                    ?>
                </tbody>  
                </tfoot>
            </Table>


            <Table class="table" id='table2epi'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DESCRICAO</th>
                        <th>QUANTIDADE</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                            $idepi    = isset($_GET['idepi'])           ? $_GET['idepi']          : '';
                            $descricao  = isset($_GET['descricao'])         ? $_GET['descricao']        : '';
                            $quantidade   = isset($_GET['quantidade'])          ? $_GET['quantidade']         : '';
                
                        
                            print "
                                <tr>
                                    <td>$idepi</td>
                                    <td>$descricao</td>
                                    <td>$quantidade</td>
                                    <td class='tdd'>

                                        <button class='btn_alterar' onclick='alterarEPI($id)'><a></a></button>
                                        <button class='btn_excluir' onclick='excluirEPI($id)'><a></a></button>
                                        
                                    </td>
                                </tr>
                            ";
                        


                    ?>
                </tbody>  
                </tfoot>
            </Table>

            </div>
                    
    </main>
</body>
<script>

    function excluir(id){
        var opcao = confirm('Deseja realmente excluir?');

        if(opcao){
            window.location = 'application/excluir-colaborador.php?id=' + id
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


    function excluirEPI(id){
        var opcao = confirm('Deseja realmente excluir?');

        if(opcao){
            window.location = 'application/excluir-EPI.php?id=' + id
        }
    }

    function alterarEPI(idEPI){
        $.ajax({
                method: 'post',
                url: 'application/selecionar-epi.php',
                dataType: 'json',
                data: {
                    id: idEPI
                },
                success: function(retorno) {
                    
                    $('#txt_id').val(retorno['id_epi']);
                    $('#txt_desc').val(retorno['descricao']);
                    $('#txt_qtd').val(retorno['quantidade']);
                    $('#nomefoto').val(retorno['imagem']);
                    $('#img_foto_colab').prop('src', 'application/upload/' + retorno['imagem']);
                   
                }
            });
    }
</script>
</html>