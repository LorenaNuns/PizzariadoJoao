<?php

    session_start();

    $user = "root";
    $pass = "";
    $db = "pizzaria";
    $host = "localhost";

    try {
        /* Varíavel para as ações com banco de dados
        PDO = responsável pelas conexões com o DB */
       $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
       /*Atributos para habilitar os erros do PDO*/
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        /*Seu deu erro na conexão, mostra o erro na tela e depois morre a conexão */
        print "Erro: " .$e->getMessage() . "<br/>";
        die();
    }

?>