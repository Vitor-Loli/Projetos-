<?php

                    $nome  = isset($_POST['txt_nome'])         ? $_POST['txt_nome']        : '';
                    $cpf   = isset($_POST['txt_cpf'])          ? $_POST['txt_cpf']         : '';

                    if($nome == '' || $cpf == ''){
                        echo "<script>
                            alert('Existem campos vazios. Verifique!');
                            window.location = '../inicio.php?tela=colab';
                        </script>";
                        exit;
                    }

                    require_once 'class/BancoDeDados.php';

                    $dataBase = new BancoDeDados;
                    $sql = ' SELECT * FROM colaboradores WHERE nome = ? AND cpf = ?';
                    $parametros = [$nome, $cpf];
                    $dados = $dataBase->selecionarRegistro($sql, $parametros);

                    if(empty($dados)){
                        echo "<script>
                            alert('Colaborador não encontrado!');
                            window.location = '../inicio.php?tela=colab'
                        </script>";
                    }else {

                        print "<script>
                            window.location = '../inicio.php?tela=buscar&id={$dados['id_colaborador']}&nome={$dados['nome']}&cpf={$dados['cpf']}&funcao={$dados['funcao']}&turno={$dados['turno']}&data_ad={$dados['data_ad']}'
                            </script>";
                    }

                ?>