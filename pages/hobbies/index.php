<?php
    require_once "../../conf/Conexao.php";

    include 'acao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $dados = array();
    if ($acao == 'editar'){
        $codigohobbie = isset($_GET['codigohobbie']) ? $_GET['codigohobbie'] : '';
        $dados = findById($codigohobbie);
        //var_dump($dados);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de hobbie</title>
        <link rel="stylesheet" href="estilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .teste{
                margin: 1vh;
            }
        </style>
    </head>
    <body>
        <a href="../../index.php">Voltar</a>
        <center><h1>Cadastro de hobbie</h1></center>
        
        <div class='row teste'>
            <div class='col-12 '>
                <form action="acao.php" method="post">
                    <div class='row'>
                        <div class='col-4'>
                            <label for="codigohobbie">Código:</label>
                        
                            <input type="text" class="form-control" id='codigohobbie' name='codigohobbie' value="<?php if ($acao == 'editar') echo $dados['codigohobbie']; else echo '0'; ?>" readonly>
                        </div>
                    
                        <div class='col-8'>
                            <label for="descricao">Descrição:</label>
                        
                            <input type="text" class="form-control" id='descricao' name='descricao' value="<?php if ($acao == 'editar') echo $dados['descricao'];?>">
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
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Detalhes</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                                $conexao = Conexao::getInstance();
                                $consulta=$conexao->query("SELECT *FROM hobbie;");
                                while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                    echo "
                                        <td>{$linha['codigohobbie']}</td>
                                        <td>{$linha['descricao']}</td>
                                        <td><a class='btn btn-info' href='show.php?codigohobbie={$linha['codigohobbie']}'>Detalhes</a></td>
                                        <td><a class='btn btn-warning' href='index.php?acao=editar&codigohobbie={$linha['codigohobbie']}'>Editar</a></td>
                                        <td><a class='btn btn-danger' onClick = 'return excluir();' href='acao.php?acao=excluir&codigohobbie={$linha['codigohobbie']}'.>Excluir</a></td>
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