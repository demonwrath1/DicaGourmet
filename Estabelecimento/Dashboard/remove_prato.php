<?php
session_start();
header('Content-Type: application/json');

include "../../conexao.php";

// Obtém os dados da requisição
$data = json_decode(file_get_contents("php://input"), true);
$idPrato = $data['id'] ?? null;

// Conecta ao banco de dados
$con = new mysqli($servidor, $usuario, $senha, $banco);
if ($con->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Conexão falhou: ' . $con->connect_error]);
    exit;
}

// Verifica se o ID do prato está presente
if ($idPrato === null) {
    echo json_encode(['status' => 'error', 'message' => 'ID do prato não fornecido.']);
    exit;
}

// Prepara e executa a consulta de remoção
$sql = "DELETE FROM cardapio WHERE id_cardapio = $idPrato";
$resultado = mysqli_query($con, $sql);

if ($resultado) {
    echo json_encode(['status' => 'success', 'message' => 'Prato removido com sucesso!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao remover o prato: ' . $con->error]);
}

$con->close();
?>