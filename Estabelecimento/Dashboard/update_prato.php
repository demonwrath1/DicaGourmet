<?php
session_start();
header('Content-Type: application/json');

include "../../conexao.php";

// Obtém os dados da requisição
$data = json_decode(file_get_contents("php://input"), true);
$idPrato = $data['id'] ?? null; // Consistência no nome da variável
$descricao = $data['descricao'] ?? null;
$preco = $data['preco'] ?? null;
$nome = $data['nome'] ?? null;

// Conecta ao banco de dados
$con = new mysqli($servidor, $usuario, $senha, $banco);
if ($con->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Conexão falhou: ' . $con->connect_error]);
    exit;
}

// Inicializa a parte da atualização
$fieldsToUpdate = [];
if ($descricao !== null) {
    $descricao = $con->real_escape_string($descricao);
    $fieldsToUpdate[] = "descricao_prato = '$descricao'";
}
if ($preco !== null) {
    $preco = floatval($preco); // Garantindo que o preço é um número
    $fieldsToUpdate[] = "valor_prato = '$preco'";
}
if ($nome !== null) {
    $nome = $con->real_escape_string($nome);
    $fieldsToUpdate[] = "nome_prato = '$nome'";
}

// Verifica se o ID do prato está presente
if ($idPrato === null) {
    echo json_encode(['status' => 'error', 'message' => 'ID do prato não fornecido.']);
    exit;
}

if (empty($fieldsToUpdate)) {
    echo json_encode(['status' => 'error', 'message' => 'Nenhum dado para atualizar.']);
    exit;
}

// Prepara e executa a consulta de atualização
$sql = "UPDATE cardapio SET " . implode(", ", $fieldsToUpdate) . " WHERE id_cardapio = $idPrato"; // Corrigido para usar id_cardapio
$resultado = mysqli_query($con, $sql);

if ($resultado) {
    echo json_encode(['status' => 'success', 'message' => 'Prato atualizado com sucesso!']);
} else {
    // Adicionando detalhes do erro
    echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o prato: ' . $con->error]);
}

$con->close();
?>
