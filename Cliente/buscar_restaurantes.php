<?php 
include "../conexao.php";
session_start(); 
ob_start();

if ($con->connect_error) {
    die("Conexão falhou: " . $con->connect_error);
}

// Obtém a categoria a partir da requisição, se disponível
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consulta para buscar nome do restaurante, endereço, imagem e ID
$sql = "
  SELECT ue.id_estabelecimento, ue.nome_estabelecimento, l.logradouro, 
       SUBSTRING_INDEX(GROUP_CONCAT(f.imgs_ambiente SEPARATOR ';'), ';', 1) AS primeira_imagem
FROM usu_estabelecimento ue
JOIN localidade l ON ue.id_localidade = l.id_localidade
LEFT JOIN foto_ambiente_estab f ON ue.id_estabelecimento = f.id_estabelecimento
WHERE ue.id_estabelecimento IN (
    SELECT id_estabelecimento 
    FROM serv_oferecido 
    WHERE tipo_comidas LIKE CONCAT('%', ?, '%')
)
GROUP BY ue.id_estabelecimento;
";

$stmt = $con->prepare($sql);
if (!$stmt) {
    echo "Erro na preparação da consulta: " . $con->error;
    exit;
}

$stmt->bind_param("s", $categoria);
$stmt->execute();
$result = $stmt->get_result();

$restaurantes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $restaurantes[] = [
            'id_estabelecimento' => $row['id_estabelecimento'],
            'nome_estabelecimento' => $row['nome_estabelecimento'],
            'logradouro' => $row['logradouro'],
            'primeira_imagem' => $row['primeira_imagem']
        ];

        // Atribuir a primeira imagem à sessão (pode ser ajustado para o primeiro restaurante, se desejado)
    
    }
} else {
    echo json_encode(["message" => "Nenhum restaurante encontrado."]);
    exit;
}

// Retorna o array de restaurantes como JSON
header('Content-Type: application/json');
echo json_encode($restaurantes);
?>