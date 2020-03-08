<?php
    require_once 'classes/conexao.php';
    $conn = new Conexao();
    $conn = $conn->get_conn();

    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $data = date("Y-m-d");
    $valor = $_POST['valor'];

    $sql = $conn->prepare("INSERT INTO despesas(nome, categoria, data, valor) VALUES(:nome, :categoria, :data, :valor)");
    $sql->bindParam(':nome', $nome);
    $sql->bindParam(':categoria', $categoria);
    $sql->bindParam(':data', $data);
    $sql->bindParam(':valor', $valor);

    $sql->execute();