<?php 
include "../conexao.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emaillogin = $_POST['email']; 
    $senha = $_POST['senha']; 
    $tipo_usuario = $_POST['tipo_usu'] ?? '';

    if ($tipo_usuario === 'cliente') {
        // Verifica se o usuário é um cliente
        $stmt = $con->prepare("SELECT * FROM usu_cliente WHERE email = ?");
        $stmt->bind_param("s", $emaillogin); 
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {
                // Armazena o ID do cliente na sessão
                $_SESSION['user_id'] = $usuario['id_cliente']; 
                $_SESSION['tipo_usuario'] = 'cliente'; 
                // Redireciona para a página do cliente
                header("Location: ../Cliente/homeDg.php?id=" . $_SESSION['user_id']);
                exit();
            } else {
                echo "Senha incorreta."; 
                echo "Senha inserida: " . $senha . "<br>";
                echo "Senha armazenada (hash): " . $usuario['senha'] . "<br>";
            }
        } else {
            echo "Usuário não encontrado."; 
        }
    } elseif ($tipo_usuario === 'estabelecimento') {
        // Verifica se o usuário é um estabelecimento
        $stmt = $con->prepare("SELECT * FROM usu_estabelecimento WHERE email = ?");
        $stmt->bind_param("s", $emaillogin);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $estab = $resultado->fetch_assoc();

        if ($estab) {
            if (password_verify($senha, $estab['senha'])) {
                // Armazena o ID do estabelecimento na sessão
                $_SESSION['user_id'] = $estab['id_estabelecimento']; 
                $_SESSION['tipo_usuario'] = 'estabelecimento';
                // Redireciona para a página do estabelecimento com ID na URL
                header("Location: ../Estabelecimento/Dashboard/dashboard.php?id=" . $_SESSION['user_id']);
                exit();
            } else {
                echo "Senha incorreta."; 
                echo "Senha inserida: " . $senha . "<br>";
                echo "Senha armazenada (hash): " . $estab['senha'] . "<br>";
            }
        } else {
            echo "Estabelecimento não encontrado."; // Mensagem de erro
        }
    } else {
        echo "Tipo de usuário inválido."; // Mensagem de erro
    }
}
?>
