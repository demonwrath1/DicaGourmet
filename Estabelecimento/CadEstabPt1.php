<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estiloCad.css">
    <script src="https://kit.fontawesome.com/7489919d60.js" crossorigin="anonymous"></script>
</head>
<?php 
session_start();
?>
<body>

<script>
            function mascaraTelefone(input) {
  let value = input.value.replace(/\D/g, ''); // Remove tudo o que não for número
  if (value.length > 11) {
    value = value.slice(0, 11);
  }
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
function mascaraCNPJ(input) {
  let value = input.value.replace(/\D/g, ''); // Remove tudo o que não for número

  // Limita o número de caracteres para 14
  if (value.length > 14) {
    value = value.slice(0, 14);
  }

  // Adiciona a máscara conforme o tamanho do valor
  if (value.length <= 2) {
    value = value.replace(/(\d{2})/, '$1.');
  } else if (value.length <= 5) {
    value = value.replace(/(\d{2})(\d{3})/, '$1.$2.');
  } else if (value.length <= 8) {
    value = value.replace(/(\d{2})(\d{3})(\d{3})/, '$1.$2.$3/');
  } else if (value.length <= 12) {
    value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})/, '$1.$2.$3/$4-');
  } else {
    value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
  }

  input.value = value;
}

</script>

    
    <main>
        <section class="section_nav_cadastro">
            <div class="close_nav">
               <a href="../LandingPage/cadastro.php"> <img src="img/close.png" alt=""></a>
            </div>
                <div class="nav_cadastro">
                        <div class="opcao_nav margin">
                            <p>Dados do Estabelecimento</p>
                            <button class="num_opcao_nav" id="btn_selecionado"><a href="CadEstabPt1.php">1</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Informações Adicionais</p>
                            <button class="num_opcao_nav"><a href="#">2</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Personalizar Perfil</p>
                            <button class="num_opcao_nav"><a href="#">3</a></button>
                        </div>
                        <div class="opcao_nav" id="no_margim">
                            <p>Pagamento</p>
                            <button class="num_opcao_nav"><a href="#">4</a></button>
                        </div>
                </div>
            </section>
            
        <section class="section_form_cadastro">
           
            <form action="CadEstabPt1.php" method="post">
                <h2 class="titulo_form">Dados do Estabelecimento</h2>
                <div class="colunas_form">
                        <div class="coluna_form">
                            <label for="">Nome do Estabelecimento</label>
                            <div class="input_container">
                                <i class="fa-solid fa-store"></i>
                                <input class="inputtext" pattern="[A-Za-z0-9\s]*" type="text" name="nome_estab" placeholder="Apenas números, espaços e letras permitidos" required>
                            </div>
                            <label for="">E-mail</label>
                            <div class="input_container">
                            <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email_estab" required>
                            </div>
                            <label for="">Senha</label>
                            <div class="input_container">
                            <i class="fa-solid fa-lock"></i>
                              <input type="password" name="senha_estab" required>
                            </div>
                            <label for="">CEP</label>
                            <div class="input_container">
                            <i class="fa-solid fa-location-dot"></i>
                                <input type="number" id="cepestab" name="cep_estab" class="number">
                                
                            </div>
                            <span id="msgerro"></span>
                        </div>
                        <div class="coluna_form">
                            <label for="">Nome do Proprietário</label>
                            <div class="input_container">
                            <i class="fa-solid fa-user"></i>
                                <input type="text" name="nome_prop" >
                            </div>
                            <label for="">Telefone</label>
                            <div class="input_container">
                            <i class="fa-solid fa-phone"></i>
                                <input type="text" name="telefone_estab" class="number" oninput="mascaraTelefone(this)" required>
                            </div>
                            <label for="">Verificação de Senha</label>
                            <div class="input_container">
                            <i class="fa-solid fa-lock"></i>
                                <input type="password" name="verif_senha" required>
                            </div>
                            <label for="">CNPJ</label>
                            <div class="input_container">
                            <i class="fa-solid fa-file"></i>
                                <input type="text" id="cnpj" name="cnpj" class="number" oninput="mascaraCNPJ(this)" required>
                            </div>
                        </div>
                </div>
                
                    <input type="text" id="cidade" name="cidade" hidden>
                    <input type="text" id="bairro" name="bairro"hidden>
                    <input type="text" id="logradouro" name="logradouro"hidden>
                    <input type="text" id="uf" name="uf" hidden> 
                    <input id="btn_enviar" type="submit">    

               
            </form>
        </section>
    </main>
    
    <script src="API.js"></script>
    <?php 

require_once '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recupera e sanitiza os dados do formulário
    $nomeestab = mysqli_real_escape_string($con, $_POST['nome_estab']);
    $emailestab = mysqli_real_escape_string($con, $_POST['email_estab']);
    $_SESSION['email_estab'] = $emailestab;
    $_SESSION['nome'] = $nomeestab;

    $senhaestab = $_POST['senha_estab'];
    $verifsenha = $_POST['verif_senha'];
    $cepestab = mysqli_real_escape_string($con, $_POST['cep_estab']);
    $nomeprop = mysqli_real_escape_string($con, $_POST['nome_prop']);
    $telefoneestab = mysqli_real_escape_string($con, $_POST['telefone_estab']);
    $cnpj = mysqli_real_escape_string($con, $_POST['cnpj']);
    $logradouro = mysqli_real_escape_string($con, $_POST['logradouro']);
    $bairro = mysqli_real_escape_string($con, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($con, $_POST['cidade']);
    $uf = mysqli_real_escape_string($con, $_POST['uf']);

    if ($senhaestab === $verifsenha) {

        // Função para obter as coordenadas usando a API OpenCageData
        function getCoordinates($address) {
            $apiKey = 'f3bad22e9f8f4fe5a0e26fec2d966574'; // Substitua pela sua chave da API OpenCageData
            $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key=$apiKey";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'SeuAplicativo/1.0 (contato@seuemail.com)');
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Erro na requisição: ' . curl_error($ch);
                curl_close($ch);
                return null;
            }

            curl_close($ch);

            $data = json_decode($response, true);

            if (empty($data) || !isset($data['results'][0])) {
                echo 'Dados decodificados: ' . print_r($data, true);
                return null;
            }

            return [
                'latitude' => $data['results'][0]['geometry']['lat'] ?? null,
                'longitude' => $data['results'][0]['geometry']['lng'] ?? null
            ];
        }

        $coordinates = getCoordinates($logradouro);

        if ($coordinates) {
            $latitude = $coordinates['latitude'];
            $longitude = $coordinates['longitude'];
            // Você pode remover os echos abaixo ou mantê-los para depuração
            // echo "Latitude: " . $coordinates['latitude'] . "<br>";
            // echo "Longitude: " . $coordinates['longitude'] . "<br>";
        } else {
            echo "Não foi possível obter as coordenadas.";
            // Opcional: Trate o erro de forma apropriada
            exit;
        }

        // Inserção na tabela 'localidade'
        $sql1 = "INSERT INTO localidade (cep, logradouro, bairro, cidade, latitude, longitude) 
                 VALUES ('$cepestab', '$logradouro', '$bairro', '$cidade', $latitude, $longitude )";
        $resultado1 = mysqli_query($con, $sql1);

        if ($resultado1) { // Verifica o resultado da primeira execução
            $id_localidade = mysqli_insert_id($con);
            $_SESSION['id_localidade'] =  $id_localidade;
        } else {
            die("Erro ao inserir localidade: " . mysqli_error($con));
        }

       
        $senhaEstabCodificada = password_hash($senhaestab, PASSWORD_DEFAULT);

       
        $sql2 = "INSERT INTO usu_estabelecimento (nome_estabelecimento, email, senha, nome_prop, cnpj, id_localidade, telefone_estab) 
                 VALUES ('$nomeestab', '$emailestab', '$senhaEstabCodificada', '$nomeprop', '$cnpj', $id_localidade, '$telefoneestab')";
        $resultado2 = mysqli_query($con, $sql2);

        if ($resultado2) {
            $id_estabelecimento = mysqli_insert_id($con);
            $_SESSION['id_estabelecimento'] =  $id_estabelecimento;
        } else {
            die("Erro ao inserir estabelecimento: " . mysqli_error($con));
        }

       
        if($resultado1 && $resultado2) {
          echo "<script>window.location.href='CadEstabPt2.php' </script>";
            exit;
        }

    } else {
        echo "Senhas não coincidem!";
    }
}
?>
</body>
</html>