<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estiloCadCliente.css">
    <script src="https://kit.fontawesome.com/7489919d60.js" crossorigin="anonymous"></script>
</head>
<body>
<script>
        function formatCPF(cpfField) {
            let cpf = cpfField.value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

            // Aplica a máscara de CPF na exibição
            if (cpf.length > 9) {
                cpfField.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
            } else if (cpf.length > 6) {
                cpfField.value = cpf.replace(/(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
            } else if (cpf.length > 3) {
                cpfField.value = cpf.replace(/(\d{3})(\d{1,3})/, "$1.$2");
            } else {
                cpfField.value = cpf;
            }
        }
        

        function mascaraTelefone(input) {
  let value = input.value.replace(/\D/g, ''); // Remove tudo o que não for número

  if (value.length <= 2) {
    // Quando tiver apenas o código de área
    value = value.replace(/(\d{2})/, '($1)');
  } else if (value.length <= 7) {
    // Quando tiver o código de área + 5 primeiros dígitos
    value = value.replace(/(\d{2})(\d{5})/, '($1)$2-');
  } else {
    // Quando tiver o código de área + 5 primeiros dígitos + 4 últimos
    value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1)$2-$3');
  }

  input.value = value;
}

        </script>
<?php
require_once '../conexao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($con->connect_error) {
        die("Conexão falhou: " . $con->connect_error);
    }

    $nomecliente = $_POST['nome_cliente'];
    $emailcliente = $_POST['email_cliente'];
    $_SESSION['email_cliente'] = $emailcliente;
    $_SESSION['nome_cliente'] = $nomecliente;

    $senhacliente = $_POST['senha_cliente'];
    $verifsenha = $_POST['verif_senha'];
    $cepcliente = $_POST['cep_cliente'];
    $nomeusuario = $_POST['nome_usuario'];
    $telefonecliente = $_POST['telefone_cliente'];
    $cpf = $_POST['cpf'];
    $logradouro = $_POST['logradouro']; 
    $_SESSION['logradourocliente'] = $logradouro;
    $bairro = $_POST['bairro']; 
    $cidade = $_POST['cidade']; 
    $uf = $_POST['uf'];

    $_SESSION['logradourocliente'] = $logradouro;

    // Verificar se as senhas coincidem
    if ($senhacliente === $verifsenha) {
        // Inserção na tabela localidade
        $stmt1 = $con->prepare("INSERT INTO localidade (cep, logradouro, bairro, cidade, uf) VALUES (?, ?, ?, ?, ?)");
        $stmt1->bind_param('sssss', $cepcliente, $logradouro, $bairro, $cidade, $uf);

        if ($stmt1->execute()) {
            // Capturar o ID da localidade inserida
            $id_localidade = $stmt1->insert_id;
            $_SESSION['id_localidadecliente'] = $id_localidade;

            // Criptografar a senha do cliente
            $senhaClienteCodificada = password_hash($senhacliente, PASSWORD_DEFAULT);

            // Inserir os dados do cliente
            $stmt2 = $con->prepare("INSERT INTO usu_cliente (nome_cliente, email, senha, nome_usu, id_localidade, cpf) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param('sssssi', $nomecliente, $emailcliente, $senhaClienteCodificada, $nomeusuario, $id_localidade, $cpf);

            if ($stmt2->execute()) {
                // Capturar o ID do cliente inserido e redirecionar
                $id_cliente = $stmt2->insert_id;
                $_SESSION['id_cliente'] = $id_cliente;
                header('Location: homeDg.php');
                exit();
            } else {
                echo "Erro ao inserir cliente: " . $con->error;
            }
        } else {
            echo "Erro ao inserir localidade: " . $con->error;
        }

        // Fechar as declarações
        $stmt1->close();
        $stmt2->close();
    } else {
        echo "Senhas não coincidem!";
    }

    // Fechar a conexão
    $con->close();
}

?>

    <main>
        <section class="section_esquerda">
            <div class="div_section_esquerda">
                <a href="../LandingPage/cadastro.php"><img id="close_img" src="../Estabelecimento/img/close.png" alt=""></a>
                <div class="container_texto_section">
                    <h1 class="titulo_section_esquerda">Estamos quase lá!</h1>
                    <p class="p_section_esquerda">Estamos felizes de ter você aqui. Por favor, preencha seus dados abaixo para garantir sua reserva e aproveitar o que o Dica Gourmet oferece de melhor: uma plataforma intuitiva e eficiente para reservas em uma variedade de restaurantes.</p>
                </div>
            </div>
            <img id="img_wave" src="../dgCadastroEstab/img/Vector (1) 1.png" alt="" srcset="">
        </section>

        <section class="section_form_cadastro">
           
            <form action="" id="formulario" method="post">
                <h2 class="titulo_form">Dados do Cliente</h2>
                <div class="colunas_form">
                        <div class="coluna_form">
                            <label for="">Nome Completo</label>
                            <div class="input_container">
                                <i class="fa-solid fa-store"></i>
                                <input type="text" name="nome_cliente" required>
                            </div>
                            <label for="">E-mail</label>
                            <div class="input_container">
                            <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email_cliente" required oninput="preencherEmail(this)">
                            </div>
                            <label for="">Senha</label>
                            <div class="input_container">
                            <i class="fa-solid fa-lock"></i>
                              <input type="password" name="senha_cliente" id="senha" required>
                            </div>
                            <label for="">CEP</label>
                            <div class="input_container">
                            <i class="fa-solid fa-location-dot"></i>
                                <input type="number" name="cep_cliente" id="cepcliente" class="number">
                                
                            </div>
                            <span id="msgerro"></span>
                        </div>
                        <div class="coluna_form">
                            <label for="">Nome de Usuário</label>
                            <div class="input_container">
                            <i class="fa-solid fa-user"></i>
                                <input type="text" name="nome_usuario" >
                            </div>
                            <label for="">Telefone</label>
                            <div class="input_container">
                            <i class="fa-solid fa-phone"></i>
                                <input type="text" name="telefone_cliente" class="number" oninput="mascaraTelefone(this)" required>
                            </div>
                            <label for="">Verificação de Senha</label>
                            <div class="input_container">
                            <i class="fa-solid fa-lock"></i>
                                <input type="password" name="verif_senha" id="verifsenha" required>
                            </div>
                            <label for="">CPF</label>
                            <div class="input_container">
                            <i class="fa-solid fa-file"></i>
                                <input type="text" name="cpf" oninput="formatCPF(this)" required>
                            </div>
                        </div>
                </div>
                <input type="text" id="cidade" name="cidade" hidden>
                    <input type="text" id="bairro" name="bairro"hidden>
                    <input type="text" id="logradouro" name="logradouro"hidden>
                    <input type="text" id="uf" name="uf" hidden>
                <input id="btn_enviar" onclick="redireciona()" type="submit" value="Enviar">
            </form>
        </section>
    </main>
   <script src="API.js"></script>
</body>
</html>