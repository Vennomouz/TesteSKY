<?php
    require_once 'classes/conexao.php';
    $conn = new Conexao();
    $conn = $conn->get_conn();

    $nome = $_POST['nome'];
    $idade = $_POST['idade'];

    $sql = $conn->prepare("INSERT INTO teste(nome, idade) VALUES(:nome, :idade)");
    $sql->bindParam(':nome', $nome);
    $sql->bindParam(':idade', $idade);

    $sql->execute();