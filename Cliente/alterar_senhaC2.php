<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:entrar_cliente.php");
        die();
    }
?>
<!doctype html>
<html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/styleform.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Alterar Senha</title>
    </head>

    <body>
        <div id="form">
            
            <h1>Alterar Senha</h1>

            <?php
                include_once('../conexao.php');

                // recuperando 
                $id_cliente=$_SESSION['id_cliente'];
                $novasenhacrip=$_GET['novasenhacrip'];

                // criando a linha do  UPDATE
                $sqlupdate = "update clientes set id_cliente='$id_cliente', senha='$novasenhacrip' where id_cliente=$id_cliente";
            
                // executando instrução SQL
                $resultado = @mysqli_query($conexao, $sqlupdate);
                if (!$resultado) 
                {
                    die ('<b>Query Inválida:<b>' . @mysqli_error($conexao));  
                } 
                else {
                    session_start();
                    unset($_SESSION['id_cliente']); //destruindo a sessao
                    header("location:../Cliente/entrar_cliente.php");
                } 

                mysqli_close($conexao);
            ?>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>