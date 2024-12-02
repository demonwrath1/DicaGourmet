<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estiloPerfil.css">
</head>
<body>
<?php
include '../conexao.php';
include 'minhas_reservas.php';

if (!isset($_SESSION['id_cliente'])) {
    echo "ID do cliente não está definido na sessão.";
    exit;
}

$id_cliente = $_SESSION['id_cliente'];

$sql = "SELECT * FROM usu_cliente WHERE id_cliente = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    echo "Erro na preparação da consulta: " . $con->error;
    exit;
}

$stmt->bind_param('i', $id_cliente); // Substituir parâmetro na consulta
$stmt->execute();
$result = $stmt->get_result();

$cliente = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cliente[] = [
            'email' => $row['email'],
            'nome_cliente' => $row['nome_cliente'],
            'cpf' => $row['cpf'],
            'foto_perfil' => $row['foto_perfil'] // Adicionando foto_perfil
        ];
    }
} else {
    echo "Nenhum dado encontrado.";
    exit;
}
?>

<div class="fundo">
    <a href="homeDg.php?id=<?php echo $id_cliente;?>"><img id="seta" src="img/Arrow 1.png" alt=""></a>
</div>
<div class="div_dados">
    <div class="dados">
    <form enctype="multipart/form-data" action="" method="post">
    <!-- Input para carregar a foto de perfil -->
    <input type="file" name="foto_perfil" id="foto_perfil" accept="image/*" onchange="previewImage(event)" style="display: none;">
    
    <!-- Botão personalizado -->
  
    
    <div id="preview-container">
        <!-- Exibe a foto de perfil atual ou a foto carregada -->
        <img id="preview-img" src="<?php echo $cliente[0]['foto_perfil'] ? $cliente[0]['foto_perfil'] : ''; ?>" alt="Preview da imagem" style="display: <?php echo $cliente[0]['foto_perfil'] ? 'block' : 'none'; ?>; width: 150px; height: 150px; object-fit: cover;">
    </div>
    <button type="button" id="custom-file-button" onclick="document.getElementById('foto_perfil').click()">Escolher foto</button>
    <div id="btns-container" style="display: <?php echo $cliente[0]['foto_perfil'] ? 'none' : 'block'; ?>">
        <button type="button" id="confirmar-btn" onclick="confirmarFoto()">Confirmar</button>
        <button type="button" id="cancelar-btn" onclick="cancelarFoto()">Cancelar</button>
    </div>
</form>

        <div class="info">
            <div class="margin">
                <h2 class="titulo_info">E-mail</h2>
                <p><?php echo htmlspecialchars($cliente[0]['email'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            
            <div class="margin">
                <h2 class="titulo_info">Senha</h2>
                <p>******</p>
            </div>
            
            <div class="div_p">
                <h2 class="titulo_info">CPF</h2>
                <p><?php echo htmlspecialchars($cliente[0]['cpf'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="nav_perfil">
        <h1 class="h1_p" onclick="showSection('historico')">Histórico</h1>
        <h1 class="h1_p" onclick="showSection('favoritos')">Favoritos</h1>
        <h1 class="h1_g" onclick="showSection('reservas'), fetchReservasCliente()">Minhas reservas</h1>
    </div>
    <div id="historico" class="section" style="display: none;">
        <p>Conteúdo do Histórico.</p>
    </div>
    <div id="favoritos" class="section" style="display: none;">
        <p>Conteúdo dos Favoritos.</p>
    </div>
    <div id="reservas" class="section" style="display: none;">
    <div style = "
    
    display:flex;
    justify-content:space-evenly;
    align-items: center;
    gap: 2em;
    width: 80vw;
    margin-bottom: 1em;
    "id="container_reservas">





    <script>
const idcliente = <?php echo $id_cliente; ?>; // ID do cliente da sessão

function fetchReservasCliente() {
    const idCliente = '<?php echo $_SESSION['id_cliente']; ?>';
    const container = document.getElementById('container_reservas');
    
    fetch(`minhas_reservas.php?id_cliente=${encodeURIComponent(idCliente)}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                container.innerHTML = '';
                data.forEach(reserva => {
                    // Reduzir o logradouro para as duas primeiras palavras
                    let logradouroReduzido = reserva.logradouro.split(' ').slice(0, 2).join(' ');
                    let imagem = `../Estabelecimento/${reserva.primeira_imagem}`;

                    // Montar o card da reserva
                    const card = `
                        <a  href="HomeEstab.php?id=${reserva.id_estabelecimento}">
                            <div class="cardCategoria">
                                <div class="enderecocard">
                                    <img class="estrelas" src="img/estrelas-não-completas.png" alt="Estrelas">
                                    <h2 class="h2_card">${reserva.nome_estabelecimento}</h2>
                                    <div class="div_endereco">
                                        <img class="endereco_mapa" id="mapa" src="img/mapas-e-bandeiras 1.png" alt="Mapa">
                                        <p class="endereco_mapa">${logradouroReduzido}</p> 
                                        <p class="horario_reserva"><strong>Horário:</strong> ${reserva.horario_reserva}</p>
                                        <p class="data_reserva"><strong>Data:</strong> ${reserva.data_reserva}</p>
                                    </div>
                                </div>
                                <div class="img-card" style="background-image: url('${imagem}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                            </div>
                        </a>
                    `;
                    container.innerHTML += card;
                });
            } else {
                container.innerHTML = '<p id="nenhuma_reserva">Você ainda não possui reservas.</p>';
            }
        })
        .catch(error => {
            console.error('Erro ao carregar as reservas:', error);
        });
}

// Chama a função com o ID do cliente da sessão
window.onload = () => fetchReservasCliente(idCliente);
            </script>
        </div>
        
        
        
        
        
        
        
        
        
       
    </div>
</main>

<script>
// Função para pré-visualizar a imagem
function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    // Exibe os botões "Confirmar" e "Cancelar" somente após o usuário selecionar um arquivo
    document.getElementById('btns-container').style.display = 'block';

    reader.onload = function() {
        const img = document.getElementById('preview-img');
        img.src = reader.result;
        img.style.display = 'block'; // Exibe a imagem de pré-visualização
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}
// Função para confirmar o upload da foto
function confirmarFoto() {
    const inputFile = document.getElementById('foto_perfil');
    if (inputFile.files.length > 0) {
        const formData = new FormData();
        formData.append('foto_perfil', inputFile.files[0]);
        
        fetch('upload_foto.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Foto de perfil atualizada com sucesso!');
                // Atualiza a imagem na interface
                const previewImg = document.getElementById('preview-img');
                previewImg.src = data.path;
                previewImg.style.display = 'block';
                document.getElementById('btns-container').style.display = 'none'; // Esconde os botões de confirmação após sucesso
            } else {
                alert('Erro ao atualizar a foto de perfil.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    } else {
        alert('Por favor, selecione uma imagem primeiro.');
    }
}

// Função para cancelar a alteração da foto
function cancelarFoto() {
    // Limpa o campo de arquivo para permitir uma nova seleção
    const inputFile = document.getElementById('foto_perfil');
    inputFile.value = ''; // Limpa o input de arquivo

    // Mantém a imagem anterior visível
    const previewImg = document.getElementById('preview-img');
    previewImg.style.display = 'block'; // Garante que a imagem anterior fique visível

    // Esconde os botões de confirmar e cancelar
    document.getElementById('btns-container').style.display = 'none';
}
window.onload = function() {
    // Se já houver uma foto de perfil, escondemos os botões
    const fotoPerfil = '<?php echo $cliente[0]['foto_perfil']; ?>';
    if (fotoPerfil) {
        document.getElementById('btns-container').style.display = 'none';
    } else {
        // Caso contrário, garantimos que os botões não apareçam inicialmente
        document.getElementById('btns-container').style.display = 'none';
    }
};
// Função para mostrar as seções do perfil
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.style.display = 'none');

    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}
</script>

</body>
</html>
