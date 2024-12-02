<?php
session_start();
include "../../conexao.php";

$id_estabelecimento = $_GET['id'] ?? $_SESSION['user_id'];

// Verifica se o ID foi passado corretamente
if (!$id_estabelecimento) {
    echo "ID do estabelecimento não encontrado!";
    exit();
}

// Consulta para buscar pratos
$sql = "SELECT id_cardapio as id_prato, foto_prato, nome_prato, descricao_prato, valor_prato FROM cardapio WHERE id_estabelecimento = $id_estabelecimento";

$resultado = mysqli_query($con, $sql);
$pratos = [];

if ($resultado) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $pratos[] = $row; // Adiciona cada prato ao array
    }
}

header('Content-Type: application/json');
echo json_encode($pratos); // Retorna os pratos como JSON
?>