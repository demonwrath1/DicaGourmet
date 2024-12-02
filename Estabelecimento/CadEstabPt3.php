<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estiloCad.css">
    <script src="https://kit.fontawesome.com/7489919d60.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
    session_start();

    ?>
    <main>
        <input type="file" name="" id="">
        <section class="section_nav_cadastro">
            <div class="close_nav">
               <a href="../LandingPage/cadastro.php"> <img src="img/close.png" alt=""></a>
            </div>
                <div class="nav_cadastro">
                        <div class="opcao_nav margin">
                            <p>Dados do Estabelecimento</p>
                            <button class="num_opcao_nav"><a href="CadEstabPt1.php">1</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Informações Adicionais</p>
                            <button class="num_opcao_nav"><a href="CadEstabPt2.php">2</a></button>
                        </div>
                        <div class="opcao_nav margin">
                            <p>Personalizar Perfil</p>
                            <button class="num_opcao_nav" id="btn_selecionado"><a href="CadEstabPt3.php">3</a></button>
                        </div>
                        <div class="opcao_nav" id="no_margim">
                            <p>Pagamento</p>
                            <button class="num_opcao_nav"><a href="#">4</a></button>
                        </div>
                </div>
            </section>

        <section class="section_form_cadastro">
           
            <form enctype="multipart/form-data" id="form_especial" action="CadEstabPt3.php" method="post">
                <h2 class="titulo_form">Personalizar Perfil</h2>
                <div class="colunas_form">
                        <div class="coluna_form">
                        
                                            <div class="div_input_file">
                        <label for="foto_perfil">
                            <img id="circulo_perfil" src="img/Ellipse 24.png" alt="Foto de Perfil">
                        </label>
                        <input id="foto_perfil" id="img" type="file" name="foto_perfil" accept="image/*">
                        <label for="foto_perfil">
                            <p>Adicione uma foto de perfil</p>
                        </label>
                    </div>
                            <div class="container_caixa_texto">
                                <label for="">Sobre o Estabelecimento</label>
                                <textarea name="sobreoestabelecimento" id="caixa_texto"></textarea>
                            </div>
                            <div class="container_caixa_texto">
                                <label for="">Regras e Jurisdição</label>
                                <textarea name="regrasejuris" id="caixa_texto"></textarea>
                            </div>

                            
                        </div>
                                <div class="coluna_form">
                                    <h1 id="titulo_imgs">Fotos do ambiente</h1>
                                    <div class="global_fotos_ambiente">
                                        <div class="container_fotos_ambiente">

                                            <div class="foto_ambiente1">
                                                <label for="foto_ambiente1">
                                                    <img class="foto_ambiente" src="img/image 3.png" alt="Foto Ambiente 1">
                                                </label>
                                                <input type="file" name="foto_ambiente1" id="foto_ambiente1" accept="image/*">
                                            </div>

                                            <div class="foto_ambiente2">
                                                <label for="foto_ambiente2">
                                                    <img class="foto_ambiente " src="img/image 3.png" alt="Foto Ambiente 2">
                                                </label>
                                                <input type="file" name="foto_ambiente2" id="foto_ambiente2" accept="image/*">
                                                <br>
                                            </div>
                                            <br>
                                            <div class="foto_ambiente3">
                                                <label for="foto_ambiente3">
                                                    <img class="foto_ambiente" src="img/image 3.png" alt="Foto Ambiente 3">
                                                </label>
                                                <input type="file" name="foto_ambiente3" id="foto_ambiente3" accept="image/*">
                                            </div>

                                            <div class="foto_ambiente4">
                                                <label for="foto_ambiente4">
                                                    <img class="foto_ambiente" src="img/image 3.png" alt="Foto Ambiente 4">
                                                </label>
                                                <input type="file" name="foto_ambiente4" id="foto_ambiente4" accept="image/*">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                                            
                            </div>

                            
                        </div>
                </div>
                <input id="btn_enviar" type="submit" value="Enviar">
            </form>
        </section>
    </main>
    
    <?php 
        require_once '../conexao.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_estabelecimento = $_SESSION['id_estabelecimento']; 
    
     if(isset($_FILES['foto_perfil'])) {
        $fotoperfil = $_FILES['foto_perfil'];
        if($fotoperfil['size'] > 8388608) {
            echo "Tamanho muito grande.";
        }
        else {
        $pasta = 'fotos_perfil/';
        $nomedafoto = $fotoperfil['name'];
        $Novonomedafoto = uniqid();
        $extensao = strtolower(pathinfo($nomedafoto, PATHINFO_EXTENSION));
        
        if($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
            die("Tipo de arquivo não suportado"); }
            else {
                $path = $pasta.$Novonomedafoto.".". $extensao;
                $aceito = move_uploaded_file($fotoperfil["tmp_name"], $path);

                if($aceito)  {
                    $con = new mysqli("$servidor", "$usuario", "$senha", "$banco");
                }
                $path = $con->real_escape_string($path);
                $sqlf = "INSERT INTO foto_ambiente_estab (img_perf, id_estabelecimento) VALUES ('$path', $id_estabelecimento)";
                $resultadof = mysqli_query($con, $sqlf);
                if($resultadof) {
                  echo "<script>window.location.href='CadEstabPt4.php'</script>";
                }
            }


    }
}

        }
// quatro



//


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regraseju = mysqli_real_escape_string($con, $_POST['regrasejuris']);
    $sobreestabelecimento = mysqli_real_escape_string($con, $_POST['sobreoestabelecimento']);
    $id_estabelecimento = $_SESSION['id_estabelecimento'];

    // Verifica a conexão
    if ($con->connect_error) {
        echo "Connection failed: " . $con->connect_error;
        exit();
    }

    // Define constantes
    define('MAX_FILE_SIZE', 8388608); // 8MB
    $uploadDir = 'fotos_ambiente/';

    // Certifica-se de que o diretório de upload existe
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $paths = [];
    $errors = [];

    function processUpload($fileInputName, $uploadDir, $con, &$errors) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$fileInputName];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $mimeType = mime_content_type($file['tmp_name']);

            // Verifica o tamanho do arquivo
            if ($fileSize > MAX_FILE_SIZE) {
                $errors[] = "File size exceeds limit for $fileInputName.";
                return null;
            }

            // Verifica o tipo de arquivo
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $allowedMimeTypes = ['image/jpeg', 'image/png'];

            if (!in_array($ext, $allowedExtensions) || !in_array($mimeType, $allowedMimeTypes)) {
                $errors[] = "Tipo de arquivo não suportado para $fileInputName.";
                return null;
            }

            $newFileName = uniqid() . '.' . $ext;
            $path = $uploadDir . $newFileName;

            if (move_uploaded_file($file["tmp_name"], $path)) {
                return $con->real_escape_string($path);
            } else {
                $errors[] = "Falha ao mover o arquivo para $fileInputName.";
                return null;
            }
        }
        return null;
    }

    // Processa uploads
    for ($i = 1; $i <= 4; $i++) {
        $paths["foto_ambiente$i"] = processUpload("foto_ambiente$i", $uploadDir, $con, $errors);
    }

    $validPaths = array_filter($paths);

    // Exibe erros se houver
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Verifica se há pelo menos 4 imagens válidas
    if (count($validPaths) < 4) {
        echo "Você precisa adicionar no mínimo 4 imagens.";
    } else {
        $pathsString = implode(";", $validPaths);

        // Atualiza o banco de dados com os caminhos das imagens
        $sql = "UPDATE foto_ambiente_estab SET imgs_ambiente = ? WHERE id_estabelecimento = ?";
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("si", $pathsString, $id_estabelecimento);
            if ($stmt->execute()) {
                echo "Arquivos enviados e registrados com sucesso.";
            } else {
                echo "Erro: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da consulta: " . $con->error;
        }

        // Atualiza informações adicionais
        $updateQueries = [
            "UPDATE usu_estabelecimento SET sobre_estab = ? WHERE id_estabelecimento = ?",
            "UPDATE usu_estabelecimento SET regras_jurisdicoes = ? WHERE id_estabelecimento = ?"
        ];
        $params = [[$sobreestabelecimento, $id_estabelecimento], [$regraseju, $id_estabelecimento]];

        foreach ($updateQueries as $key => $sql) {
            if ($stmt = $con->prepare($sql)) {
                $stmt->bind_param("si", ...$params[$key]);
                if (!$stmt->execute()) {
                    echo "Erro na atualização: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Erro na preparação da consulta: " . $con->error;
            }
        }
    }
}
?>
<style>
.global_fotos_ambiente {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    margin: 0;
}

.container_fotos_ambiente {
    display: flex;
    flex-wrap: wrap;
 
    
}
.container_fotos_ambiente > div {
    flex: 1 1 50%; 
    box-sizing: border-box;
    padding: 5px;
    height: 200px;
    width: 130px;
  
}

.foto_ambiente {
    width: 100%;
    height: 100%;
    object-fit: cover;      /* Ajusta a imagem para cobrir o contêiner sem distorcer */
}
.div_input_file {
    text-align: center; 
}

#circulo_perfil {
    width: 110px;  /* Ajuste o tamanho conforme necessário */
    height: 110px; /* Ajuste o tamanho conforme necessário */
    border-radius: 50%; 
    object-fit: cover;  
    border: 2px solid #ddd; 
}

input[type="file"] {
    display: none; /* Oculta o input de arquivo */
}

.div_input_file label:nth-of-type(1) {
    display: block;
    cursor: pointer; /* Adiciona um cursor pointer para indicar que é clicável */
}


</style>
<script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(event) {
        const inputElement = event.target;
        const label = inputElement.previousElementSibling; // O label está imediatamente antes do input
        const img = label.querySelector('img'); // Encontra a imagem dentro do label

        if (inputElement.files && inputElement.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                img.src = e.target.result; // Atualiza a src da imagem com o novo arquivo
            };

            reader.readAsDataURL(inputElement.files[0]); // Lê o arquivo como Data URL
        }
    });
});
document.getElementById('foto_perfil').addEventListener('change', function(event) {
    const inputElement = event.target;
    const img = document.getElementById('circulo_perfil');

    if (inputElement.files && inputElement.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            img.src = e.target.result; // Atualiza a src da imagem com o novo arquivo
        };

        reader.readAsDataURL(inputElement.files[0]); // Lê o arquivo como Data URL
    }
});
</script>
</body>
</html>