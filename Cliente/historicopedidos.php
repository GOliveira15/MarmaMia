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
        <title>MarmaMia - Histórico de Pedidos</title>
    </head>

    <body>
        <div id="container">

            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="areaprivada_cliente.php">
                        <span></span>
                        Página Inicial
                    </a>
                </header>

                <div id="form">

                    <h1>Histórico de Pedidos</h1>

                    <?php

                        include_once('../conexao.php');

                        $id_cliente=$_SESSION['id_cliente'];

                        $query = mysqli_query($conexao,"select * from pedidos where id_cliente=$id_cliente order by created desc");

                        if (!$query) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        echo "<br><h3>Pedidos</h3>";
            
                        while($dados=mysqli_fetch_array($query)) 
                        {
                            $id_pedido=$dados['id_pedido'];
                            
                            echo "<b><br>Código do Pedido:</b> ".$dados['id_pedido'].'<br>';
                            echo "<b>Realizado em:</b> ".$dados['created'].'<br>';
                            echo "<b>Total:</b> R$".number_format($dados['total'], 2, ',', '.').'<br>';
                            echo "<b>Status:</b> ".$dados['status'].'<br><br>';

                            echo "<a href='pedidodetalhes.php?id_pedido=$id_pedido'>+ Detalhes</a><br>";

                            echo "<hr>";
                        }

                    ?>

                    <br><a href="../Cliente/escolher_fornecedor.php?cidade=">Novo Pedido</a>

                </div>

            <div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>