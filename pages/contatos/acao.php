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
            $codigocontatos = isset($_POST['codigocontatos']) ? $_POST['codigocontatos'] : 0;
            if ($codigocontatos == 0)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){    
        $codigocontatos = isset($_GET['codigocontatos']) ? $_GET['codigocontatos']:0;
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE FROM contatos WHERE codigocontatos = :codigocontatos");
        $stmt->bindParam('codigocontatos', $codigocontatos, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE contatos SET nome = '".$dados['nome']."', sobrenome = '".$dados['sobrenome']."', email = '".$dados['email']."', obs = '".$dados['obs']."', telefone = '".$dados['telefone']."', datanasc = '".$dados['datanasc']."', codigocidade = '".$dados['codigocidade']."', vivo = '".$dados['vivo']."' WHERE codigocontatos = '".$dados['codigocontatos']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO `contatos` (`codigocontatos`, `nome`, `sobrenome`, `email`, `obs`, `telefone`, `datanasc`, `codigocidade`, `vivo`) VALUES ('".$dados['codigocontatos']."', '".$dados['nome']."', '".$dados['sobrenome']."', '".$dados['email']."', '".$dados['obs']."', '".$dados['telefone']."', '".$dados['datanasc']."', '".$dados['codigocidade']."', '".$dados['vivo']."');";
        

        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $codigocontatos = isset($_POST['codigocontatos']) ? $_POST['codigocontatos']: 0;
        $nome = isset($_POST['nome']) ? $_POST['nome']: '';
        $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome']: '';
        $email = isset($_POST['email']) ? $_POST['email']: 0;
        $telefone = isset($_POST['telefone']) ? $_POST['telefone']: '';
        $obs = isset($_POST['obs']) ? $_POST['obs']: '';
        $datanasc = isset($_POST['datanasc']) ? $_POST['datanasc']: 0;
        $vivo = isset($_POST['vivo']) ? $_POST['vivo']: '';
        $codigocidade = isset($_POST['codigocidade']) ? $_POST['codigocidade']: '';


        $dados = array(
            'codigocontatos' => $codigocontatos,
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'email' => $email,
            'telefone' => $telefone,
            'obs' => $obs,
            'datanasc' => $datanasc,
            'vivo' => $vivo,
            'codigocidade' => $codigocidade,
        );

        return $dados;

    }

    function findById($codigocontatos){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM contatos WHERE $codigocontatos = $codigocontatos;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>