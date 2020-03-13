<?php
    require_once 'conexao.php';
    $conn = new Conexao();
    $conn = $conn->get_conn();
    $id = $_GET['id'];

    $sql = $conn->prepare("DELETE FROM despesas WHERE id=:id");
    $sql->bindParam(':id', $id);

    if(!$sql->execute()){
        http_response_code(400);
        header("Content-type: application/json");
        echo (json_encode(['success' => false, 'message' => "Erro ao deletar!" ]));
        return;
    }

    header("Content-type: application/json");
    echo (json_encode(['success' => true, 'message' => "Despesa deletada com sucesso!" ]));

    