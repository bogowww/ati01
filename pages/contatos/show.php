<?php 
    require_once "../../conf/Conexao.php";
?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <br>
    <center>
        <div class="panel panel-default">
            <div class="panel-heading"><b>Detalhes contato</b></div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="card" style="width: 18rem;">
                            <?php
                                $codigocontatos = isset($_GET['codigocontatos']) ? $_GET['codigocontatos']:0;

                                $conexao = Conexao::getInstance();
                                $consulta=$conexao->query("SELECT *, cidade.codigocidade as codigocidade, cidade.nome as cidadenome FROM contatos LEFT JOIN cidade ON contatos.codigocidade = cidade.codigocidade WHERE contatos.codigocontatos = $codigocontatos;");
                                
                                while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                    echo "<div class='card-body'>";
                                    echo "<div class='card-header'><b>Código:</b> ".$linha["codigocidade"]."</div>";
                                    echo "<h5 class='card-title'><b>Nome:</b> ".$linha["nome"]." ".$linha["sobrenome"]."</h5>";
                                    echo "<p class='card-text'><b>Email:</b> ".$linha["email"]."</p>";
                                    echo "<p class='card-text'><b>Telefone:</b> ".$linha["telefone"]."</p>";
                                    echo "<p class='card-text'><b>Data Nascimento:</b> ".$linha["datanasc"]."</p>";
                                    echo "<p class='card-text'><b>Cidade:</b> ".$linha["cidadenome"]."({$linha["codigocidade"]}) - ".$linha["estado"]."</p>";
                                    echo "<p class='card-text'><b>Observações:</b> ".$linha["obs"]."</p>";
                                    echo 
                                    "<a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&codigocidade=".$linha['codigocidade']."'.>Excluir</a>"."&nbsp;&nbsp;".
                                    "<a class='btn btn-warning' href='index.php?acao=editar&codigocidade=".$linha['codigocidade']."'.>Editar</a>"."&nbsp;&nbsp;".
                                    "<a class='btn btn-primary' href='index.php'.>Voltar</a>";
                                }
                            ?> 
                        </div>
                    </div>
            </div>
        </div>
    </center>