<?php

    require_once 'conexao.php';

    $conn = new Conexao();
    $conn = $conn->get_conn();

    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $valor = floatval(str_replace(',', '.', $_POST['valor']));
    
    if($valor == 0){
        http_response_code(422);
        header("Content-type: application/json");
        echo (json_encode(['success' => false, 'message' => "Digite um valor válido" ]));
    }
    
    $sql = $conn->prepare("INSERT INTO despesas(nome, categoria, valor) VALUES(:nome, :categoria, :valor)");
    $sql->bindParam(':nome', $nome);
    $sql->bindParam(':categoria', $categoria);
    $sql->bindParam(':valor', $valor);

    $sql->execute();
