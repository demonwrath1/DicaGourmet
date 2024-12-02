<?php
include '../conexao.php';
session_start();  // Certificar que a sessão foi iniciada

// Definir o cabeçalho de resposta como JSON
header('Content-Type: application/json');

// Verificar se o arquivo foi enviado
if (isset($_FILES['foto_perfil'])) {
    $foto_perfil = $_FILES['foto_perfil'];

    // Verificar o tamanho da imagem
    if ($foto_perfil['size'] > 8388608) { // Limite de 8MB
        echo json_encode(['success' => false, 'message' => 'Tamanho muito grande.']);
        exit;
    }

    // Caminho para salvar a foto
    $pasta = '../Estabelecimento/fotos_perfil/';
    $nome_foto = $foto_perfil['name'];
    $novo_nome_foto = uniqid();
    $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));

    // Verificar a extensão da foto
    if (!in_array($extensao, ['jpg', 'jpeg', 'png'])) {
        echo json_encode(['success' => false, 'message' => 'Tipo de arquivo não suportado']);
        exit;
    }

    // Gerar o caminho completo da imagem
    $path = $pasta . $novo_nome_foto . '.' . $extensao;

    // Mover o arquivo para o diretório
    if (move_uploaded_file($foto_perfil["tmp_name"], $path)) {
        // Atualizar a foto no banco de dados
        $id_cliente = $_SESSION['id_cliente'];
        $path = $con->real_escape_string($path);  // Evitar SQL Injection
        $sql = "UPDATE usu_cliente SET foto_perfil = '$path' WHERE id_cliente = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param('i', $id_cliente);

        if ($stmt->execute()) {
            // Retorna o caminho da nova foto em formato JSON
            echo json_encode(['success' => true, 'path' => $path]);
        } else {
            // Erro ao atualizar no banco
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a foto no banco de dados']);
        }
    } else {
        // Erro ao mover o arquivo para o diretório
        echo json_encode(['success' => false, 'message' => 'Erro ao fazer o upload da foto.']);
    }
} else {
    // Nenhum arquivo enviado
    echo json_encode(['success' => false, 'message' => 'Nenhuma foto foi enviada.']);
}
?>
