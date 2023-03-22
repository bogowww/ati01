<?php
    require_once "../../conf/Conexao.php";

    var_dump($_POST);
        echo"<br>";
    var_dump($_GET);
    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    switch($acao){
        case 'excluir': excluir(); break;
        case 'salvar': {
            if (findById($codigocontatos,$codigohobbie) == NULL)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){  
        $codigocontatos = isset($_GET['codigocontatos']) ? $_GET['codigocontatos']: 0;
        $codigohobbie = isset($_GET['codigohobbie']) ? $_GET['codigohobbie']: 0;

        $dados = formToArray();
        $conexao = Conexao::getInstance();
        $sql = "DELETE FROM contato_hobbie WHERE codigocontatos = '$codigocontatos' AND codigohobbie = '$codigohobbie';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function editar(){
        $codigocontatos = isset($_GET['codigocontatos']) ? $_GET['codigocontatos']: 4;
        $codigohobbie = isset($_GET['codigohobbie']) ? $_GET['codigohobbie']: 4;

        $dados = formToArray();

        $conexao = Conexao::getInstance();
        $sql = "UPDATE `contato_hobbie` SET `codigocontatos` = '".$dados['codigocontatos']."', `codigohobbie` = '".$dados['codigohobbie']."' WHERE (`codigocontatos` = '".$codigocontatos.") and (`codigohobbie` = '".$codigohobbie."');";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO contato_hobbie (codigocontatos, codigohobbie) VALUES ('".$dados['codigocontatos']."','".$dados['codigohobbie']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $codigocontatos = isset($_POST['codigocontatos']) ? $_POST['codigocontatos']: 0;
        $codigohobbie = isset($_POST['codigohobbie']) ? $_POST['codigohobbie']: 0;


        $dados = array(
            'codigocontatos' => $codigocontatos,
            'codigohobbie' => $codigohobbie
        );

        return $dados;

    }

    function findById($codigocontatos,$codigohobbie){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM contato_hobbie WHERE codigocontatos = $codigocontatos AND codigohobbie = $codigohobbie;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>