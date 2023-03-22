<?php
    require_once "../../conf/Conexao.php";

    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    switch($acao){
        case 'excluir': excluir(); break;
        case 'salvar': {
            $codigocidade = isset($_POST['codigocidade']) ? $_POST['codigocidade'] : 0;
            if ($codigocidade == 0)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){    
        $codigocidade = isset($_GET['codigocidade']) ? $_GET['codigocidade']:0;
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE FROM cidade WHERE codigocidade = :codigocidade");
        $stmt->bindParam('codigocidade', $codigocidade, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE cidade SET nome = '".$dados['nome']."', estado = '".$dados['estado']."' WHERE codigocidade = '".$dados['codigocidade']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO cidade (codigocidade, nome, estado) VALUES ('".$dados['codigocidade']."','".$dados['nome']."','".$dados['estado']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $codigocidade = isset($_POST['codigocidade']) ? $_POST['codigocidade']: 0;
        $nome = isset($_POST['nome']) ? $_POST['nome']: '';
        $estado = isset($_POST['estado']) ? $_POST['estado']: '';


        $dados = array(
            'codigocidade' => $codigocidade,
            'nome' => $nome,
            'estado' => $estado
        );

        return $dados;

    }

    function findById($codigocidade){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM cidade WHERE codigocidade = $codigocidade;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>