<?php
    require_once "../../conf/Conexao.php";

    include 'acao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $dados = array();
    if ($acao == 'editar'){
        $codigocontato = isset($_GET['codigocontato']) ? $_GET['codigocontato'] : 0;
        $codigohobbie = isset($_GET['codigohobbie']) ? $_GET['codigohobbie'] : 0;
        $dados = findById($codigocontato,$codigohobbie);
        var_dump($dados);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Hobbies</title>
        <link rel="stylesheet" href="estilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
        <a href="../../index.php">Voltar</a>
        <center><h1>Hobbies e Contatos</h1></center>
        
        <div class='row'>
            <div class='col-12 '>
                <form action="acao.php" method="post">
                    <div class='row'>
                        <div class='col-6'>
                            <label for="descricao">Contato:</label>
                            <select class="form-select" name="codigocontato" id="codigocontato">
                                    <?php
                                        $conexao = Conexao::getInstance();
                                        $consulta=$conexao->query("SELECT*FROM contatos;");
                                        while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                            if ($linha['codigocontato'] == $dados['codigocontato']) {
                                                echo "<option value='".$linha['codigocontato']."' selected>".$linha['nome']."</option>";
                                            }else{
                                                echo "<option value='".$linha['codigocontato']."'>".$linha['nome']."</option>";
                                            }
                                        }

                                    ?>
                            </select>
                        </div>
                    
                        <div class='col-6'>
                            <label for="descricao">Hobbies:</label>
        
                            <select class="form-select" name="codigohobbie" id="codigohobbie">
                                <?php
                                    $conexao = Conexao::getInstance();
                                    $consulta=$conexao->query("SELECT*FROM hobbies;");
                                    while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                        if ($linha['codigohobbie'] == $dados['codigohobbie']) {
                                            echo "<option value='".$linha['codigohobbie']."' selected>".$linha['descricao']."</option>";
                                        }else{
                                            echo "<option value='".$linha['codigohobbie']."'>".$linha['descricao']."</option>";
                                        }
                                    }

                                ?>
                            </select>
                        </div>
                    </div>  
                        <br>
                    <div class='row'>
                        <div class='col-12'>
                            <center><button type='submit' name='acao' class="btn btn-success" id='acao' value='salvar'>Salvar</button></center>
                        </div>
                    </div>       
                </form>
            </div>
        </div> 
        <div class='row'>
            <?php

            ?>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Contato</th>
                            <th>Hobbie</th>
                            <th>Detalhes</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                                $conexao = Conexao::getInstance();
                                $consulta=$conexao->query("SELECT *FROM contato_hobbie;");
                                while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                    echo "
                                        <td>{$linha['codigocontato']}</td>
                                        <td>{$linha['codigohobbie']}</td>
                                        <td><a class='btn btn-info' href='show.php?codigocontato={$linha['codigocontato']}&codigohobbie={$linha['codigohobbie']}'>Detalhes</a></td>
                                        <td><a class='btn btn-warning' href='index.php?acao=editar&codigocontato={$linha['codigocontato']}&codigohobbie={$linha['codigohobbie']}'>Editar</a></td>
                                        <td><a class='btn btn-danger' onClick = 'return excluir();' href='acao.php?acao=excluir&codigocontato={$linha['codigocontato']}&codigohobbie={$linha['codigohobbie']}'>Excluir</a></td>
                                        </tr>\n
                                    ";
                                
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>