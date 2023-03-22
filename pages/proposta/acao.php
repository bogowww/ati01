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
            $codigoproposta = isset($_POST['codigoproposta']) ? $_POST['codigoproposta'] : 0;
            if ($codigoproposta == 0)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){    
        $codigoproposta = isset($_GET['codigoproposta']) ? $_GET['codigoproposta']:0;
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE FROM proposta WHERE codigoproposta = :codigoproposta");
        $stmt->bindParam('codigoproposta', $codigoproposta, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE proposta SET nome = '".$dados['nome']."', email = '".$dados['email']."', obs = '".$dados['obs']."', salario = '".$dados['salario']."' WHERE codigoproposta = '".$dados['codigoproposta']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO proposta (codigoproposta, nome, email,obs,salario) VALUES ('".$dados['codigoproposta']."','".$dados['nome']."','".$dados['email']."','".$dados['obs']."','".$dados['salario']."')";
        
        $conexao = $conexao->query($sql);

        $loc = isset($_POST['loc']) ? $_POST['loc'] : 'painel';

        if($loc == 'painel'){
            header("location:index.php");
        }else{
            header("location: ../../index.php?aviso=sucesso");
        }
        
    }

    function formToArray(){
        $codigoproposta = isset($_POST['codigoproposta']) ? $_POST['codigoproposta']: 0;
        $nome = isset($_POST['nome']) ? $_POST['nome']: '';
        $email = isset($_POST['email']) ? $_POST['email']: '';
        $obs = isset($_POST['obs']) ? $_POST['obs']: '';
        $salario = isset($_POST['salario']) ? $_POST['salario']: '';


        $dados = array(
            'codigoproposta' => $codigoproposta,
            'nome' => $nome,
            'email' => $email,
            'obs' => $obs,
            'salario' => $salario
        );

        return $dados;

    }

    function findById($codigoproposta){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM proposta WHERE codigoproposta = $codigoproposta;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>