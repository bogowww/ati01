<?php
    require_once "../../conf/Conexao.php";

    // var_dump($_POST);
    //     echo"<br>";
    // var_dump($_GET);
    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    switch($acao){
        case 'excluir': excluir(); break;
        case 'salvar': {
            $codigohobbie = isset($_POST['codigohobbie']) ? $_POST['codigohobbie'] : 0;
            if ($codigohobbie == 0)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){    
        $codigohobbie = isset($_GET['codigohobbie']) ? $_GET['codigohobbie']:0;
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE FROM hobbie WHERE codigohobbie = :codigohobbie");
        $stmt->bindParam('codigohobbie', $codigohobbie, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE hobbie SET descricao = '".$dados['descricao']."' WHERE codigohobbie = '".$dados['codigohobbie']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO hobbie (codigohobbie, descricao) VALUES ('".$dados['codigohobbie']."','".$dados['descricao']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $codigohobbie = isset($_POST['codigohobbie']) ? $_POST['codigohobbie']: 0;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao']: '';


        $dados = array(
            'codigohobbie' => $codigohobbie,
            'descricao' => $descricao
        );

        return $dados;

    }

    function findById($codigohobbie){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM hobbie WHERE codigohobbie = $codigohobbie;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>