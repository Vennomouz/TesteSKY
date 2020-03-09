<?php
    require_once 'conexao.php';
    $conn = new Conexao();
    $conn = $conn->get_conn();

    $sql = $conn->prepare("SELECT * FROM despesas");
    $sql->execute();
    $result = $sql->fetchAll();
    
    header("Content-type: application/json");
    echo json_encode($result);
    