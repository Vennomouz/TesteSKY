<?php

    require_once 'conexao.php';

    $conn = new Conexao();
    $conn = $conn->get_conn();

    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $data = date("Y-m-d");
    $valor = floatval(str_replace(',', '.', $_POST['valor']));
    
    if($valor == 0){
        http_response_code(422);
        header("Content-type: application/json");
        echo (json_encode(['success' => false, 'message' => "Digite um valor válido" ]));
    }
    
    $sql = $conn->prepare("INSERT INTO despesas(nome, categoria, data, valor) VALUES(:nome, :categoria, :data, :valor)");
    $sql->bindParam(':nome', $nome);
    $sql->bindParam(':categoria', $categoria);
    $sql->bindParam(':data', $data);
    $sql->bindParam(':valor', $valor);

    $sql->execute();
