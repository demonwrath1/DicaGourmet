<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/NavStyle.css">
    <link rel="stylesheet" href="css/CadCardapioStyle.css">
   

</head>
<body>
    <?php session_start(); 
    
    $id_estabelecimento = $_GET['id'] ?? $_SESSION['user_id'];

    // Verifica se o ID foi passado corretamente
    if (!$id_estabelecimento) {
        echo "ID do estabelecimento não encontrado!";
        exit();
    }
    ?>
    <main>
        <div class="nav_esquerda">
            <img id="logo" src="img/g1 (4).png" alt="">
            <nav>
                <ul>
                    <a href="dashboard.php?id=<?php echo $id_estabelecimento;?>"><li><img class="img_nav" src="img/botao-home 1.png" alt="">Home</li></a>
                    <a href="#"><li><img class="img_nav" src="img/perfil 2.png" alt="">Meu Perfil</li></a>
                    <a href="CadMesa.php?id=<?php echo $id_estabelecimento;?>"><li><img class="img_nav" src="img/mesa-de-jantar 1.png" alt="">Mesas</li></a>
                    <a href=""><li><img class="img_nav" src="img/cardapio 1.png" alt="">Cardápio</li></a>
                    <a href="ReservaPen.php"><li><img class="img_nav" src="img/sino-do-hotel 1.png" alt="">Reservas </li></a>
                    <a href=""><li><img class="img_nav" src="img/notificacao 1.png" alt="">Notificação</li></a>
                    <a href=""><li><img class="img_nav" src="img/avaliacao 8.png" alt="">Avaliações</li></a>
                    <a href="../../login/login.php"><li><img id='sair_icone' src="img/sair.png" alt="">Sair</li></a>
                </ul>
            </nav>
        </div>
        <div class="container_direita">
            <h1>Cadastre pratos</h1>
            <div class="cad_prato">
                <form style="justify-content: space-around;" action="" enctype="multipart/form-data" method="POST">
                    <div class="form_esquerda">
                        <div>
                            <label for="nome">Nome do Prato</label>
                            <input type="text" name="nome" id="nome">
                        </div>
                        <div>
                            <label for="desc">Descrição</label>
                            <textarea name="desc" id="desc"></textarea>
                        </div>
                    </div>
                    <div class="form_direita">
                        <div class="foto_session">
                            <label for="img">Foto</label>
                            <label for="img">
                                <img style="width: 12vw; height: 16vh; border-radius: 0.5em;" id="foto_img" src="img/Rectangle 509.png" alt="">
                            </label>
                            <input type="file" name="imagem_prato" id="img">
                        </div>
                        <div id="prec">
                            <label for="preco">Preço</label>
                            <input type="number" placeholder="R$" step="0.01" name="preco" id="preco">
                        </div>
                        <div class="btn">
                            <input id="cad_btn" type="submit" value="Cadastrar">
                        </div>
                    </div>
                    <input type="hidden" name="prato_id" id="prato_id">
                </form>
            </div>

            <h1 id="titulo_cardapio">Cardápio</h1>
            <div class="pratos_container">
                <div class="pratos" id="pratos"></div>
                <div class="pagination">
                    <button id="prev" onclick="changePage(-1)"><</button>
                    <button id="next" onclick="changePage(1)">></button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar Remoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja remover este prato?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmRemoveBtn">Confirmar</button>
            </div>
        </div>
    </div>
</div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.getElementById("img").addEventListener("change", function(event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("foto_img").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    let pratosData = [];
    const itemsPerPage = 1;
    let currentPage = 1;

    async function fetchPratos() {
        try {
            const response = await fetch("fetch_pratos.php?id=<?php echo $id_estabelecimento;?>");
            const data = await response.json();
            pratosData = data;
            displayPratos();
        } catch (error) {
            console.error("Erro ao buscar pratos:", error);
        }
    }

    function displayPratos() {
        const pratosContainer = document.getElementById('pratos');
        pratosContainer.innerHTML = '';
        const totalPratos = pratosData.length;
        const totalPages = Math.ceil(totalPratos / itemsPerPage);
        currentPage = Math.max(1, Math.min(currentPage, totalPages));
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        pratosData.slice(startIndex, endIndex).forEach(prato => {
    pratosContainer.innerHTML += `
        <div class="prato" style='width:95%; display:flex; justify-content: space-between;'>
            <img style="width: 12vw; height: 18vh; border-radius: 0.4em; border: 0.2px solid white;" class="img_prato" src="${prato.foto_prato}" alt="">
            <div class="desc_prato">
                <input type="hidden" class="input_nome" value="${prato.nome_prato}">
                <input type="text" class="input_nome_edit" value="${prato.nome_prato}" style="display:none;"> <!-- Adicionado como input -->
                <p class="nome_prato">${prato.nome_prato}</p>
                <textarea class="input_desc" style="display:none;">${prato.descricao_prato}</textarea>
                <p class="desc_prato_text">${prato.descricao_prato}</p>
                <input type="number" class="input_preco" value="${prato.valor_prato}" step="0.01" style="display:none;">
                <p class="preco_text">R$ ${prato.valor_prato}</p>
                <div class="btn_func">
                    <button class="btn_editar" data-id="${prato.id_prato}">Editar</button>
                    <button class="btn_salvar" data-id="${prato.id_prato}" style="display:none;
                     background-color: #72383D;
    color: #fff; width: 6vw;
    height: 5vh;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.8em;
    font-weight: 600;">Salvar</button>
                    <button class="btn_remover" data-id="${prato.id_prato}">Remover</button>
                </div>
            </div>
        </div>
    `;
});

        document.getElementById('prev').disabled = currentPage === 1;
        document.getElementById('next').disabled = currentPage === totalPages;

        addEditButtonsListeners();
        addRemoveButtonsListeners();
        addSaveButtonsListeners();
    }

    function addEditButtonsListeners() {
    const editButtons = document.querySelectorAll('.btn_editar');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pratoId = parseInt(this.getAttribute('data-id'), 10);
            if (isNaN(pratoId)) {
                alert('ID do prato não é válido.');
                return;
            }

            // Preenche o input oculto com o ID do prato
            document.getElementById("prato_id").value = pratoId;

            const inputs = this.parentNode.parentNode.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.style.display = 'block'; // Mostra todos os inputs
            });

            // Esconde o parágrafo da descrição antiga
            const descPratoText = this.parentNode.parentNode.querySelector('.desc_prato_text');
            descPratoText.style.display = 'none'; // Esconde a descrição antiga

            this.style.display = 'none'; // Esconde o botão "Editar"
            this.nextElementSibling.style.display = 'inline'; // Mostra o botão "Salvar"
        });
    });
}

function addSaveButtonsListeners() {
    const saveButtons = document.querySelectorAll('.btn_salvar');
    saveButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const pratoId = parseInt(this.getAttribute('data-id'), 10);
            if (isNaN(pratoId)) {
                alert('ID do prato não é válido.');
                return;
            }

            // Aqui, pegue o valor do input editável
            const inputDesc = this.parentNode.parentNode.querySelector('.input_desc').value;
            const inputPreco = this.parentNode.parentNode.querySelector('.input_preco').value;
            const inputNome = this.parentNode.parentNode.querySelector('.input_nome_edit').value; // Altere para pegar o valor do input editável

            // Valida entradas
            if (!inputNome || !inputDesc || !inputPreco) {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            // Atualiza o prato
            await updatePrato(pratoId, inputDesc, inputPreco, inputNome);

            // Esconde os inputs e mostra o nome e o botão de editar
            const inputs = this.parentNode.parentNode.querySelectorAll('input, textarea');
            inputs.forEach(input => input.style.display = 'none');
            this.style.display = 'none'; // Esconde o botão "Salvar"
            this.previousElementSibling.style.display = 'inline'; // Mostra o botão "Editar"

            // Atualiza os textos com os novos valores
            this.parentNode.parentNode.querySelector('.nome_prato').innerText = inputNome;
            this.parentNode.parentNode.querySelector('.desc_prato_text').innerText = inputDesc;
            this.parentNode.parentNode.querySelector('.preco_text').innerText = `R$ ${inputPreco}`;
        });
    });
}

function addRemoveButtonsListeners() {
    const removeButtons = document.querySelectorAll('.btn_remover');
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pratoId = parseInt(this.getAttribute('data-id'), 10);
            if (isNaN(pratoId)) {
                alert('ID do prato não é válido.');
                return;
            }
            
            // Armazena o ID do prato no botão de confirmação
            document.getElementById("confirmRemoveBtn").setAttribute("data-id", pratoId);

            // Abre o modal de confirmação
            $('#confirmModal').modal('show');
        });
    });
}

// Adiciona o evento de clique no botão de confirmação
document.getElementById("confirmRemoveBtn").addEventListener("click", async function() {
    const pratoId = parseInt(this.getAttribute("data-id"), 10);
    if (!isNaN(pratoId)) {
        await removePrato(pratoId); // Chama a função de remoção
        $('#confirmModal').modal('hide'); // Fecha o modal
    }
});

    async function updatePrato(pratoId, descricao, preco, nome) {
        try {
            const response = await fetch("update_prato.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: pratoId, descricao, preco, nome }),
            });

            if (!response.ok) {
                throw new Error(`Erro: ${response.status}`);
            }

            const result = await response.json();
            if (result.status === 'success') {
                alert(result.message); // Mensagem de sucesso
            } else {
                alert(result.message); // Mensagem de erro
            }
            
            fetchPratos(); // Recarrega os pratos após a atualização
        } catch (error) {
            console.error("Erro ao atualizar prato:", error);
            alert("Erro ao atualizar prato. Tente novamente.");
        }
    }

    async function removePrato(pratoId) {
    try {
        const response = await fetch("remove_prato.php", {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ id: pratoId }), // Envia o ID do prato para ser removido
        });

        if (!response.ok) {
            throw new Error(`Erro: ${response.status}`);
        }

        const result = await response.json();
        if (result.status === 'success') {
            alert(result.message); // Mensagem de sucesso
        } else {
            alert(result.message); // Mensagem de erro
        }

        fetchPratos(); // Recarrega os pratos após a remoção
    } catch (error) {
        console.error("Erro ao remover prato:", error);
        alert("Erro ao remover prato. Tente novamente.");
    }
}
    function changePage(direction) {
        currentPage += direction;
        displayPratos();
    }
    
    fetchPratos();
</script>

<?php
    include "../../conexao.php";
   
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $desc = $_POST['desc'];
        $preco = $_POST['preco'];
        $prato_id = $_POST['prato_id']; // Captura o ID do prato para edição
        $con = new mysqli($servidor, $usuario, $senha, $banco);
    
        if ($con->connect_error) {
            die("Falha na conexão: " . $con->connect_error);
        }
    
        if (isset($_FILES['imagem_prato']) && $_FILES['imagem_prato']['size'] > 0) {
            $fotoprato = $_FILES['imagem_prato'];
            if ($fotoprato['size'] > 8388608) {
                echo "Tamanho muito grande.";
            } else {
                $pasta = 'fotos_pratos/';
                $nomedafoto = $fotoprato['name'];
                $Novonomedafoto = uniqid();
                $extensao = strtolower(pathinfo($nomedafoto, PATHINFO_EXTENSION));
    
                if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
                    die("Tipo de arquivo não suportado");
                } else {
                    $path = $pasta . $Novonomedafoto . "." . $extensao;
                    $aceito = move_uploaded_file($fotoprato["tmp_name"], $path);
    
                    if ($aceito) {
                       
                        
                        $path = $con->real_escape_string($path);
                        // Se o ID do prato for definido, faça a atualização
                        if ($prato_id) {
                            $sql = "UPDATE cardapio SET foto_prato = '$path', nome_prato = '$nome', descricao_prato = '$desc', valor_prato = '$preco' WHERE id_prato = $prato_id";
                        } else {
                            $sql = "INSERT INTO cardapio (foto_prato, nome_prato, descricao_prato, valor_prato, id_estabelecimento) VALUES ('$path', '$nome', '$desc', '$preco', $id_estabelecimento)";
                        }
                    }
                }
            }
        } else {
            // Se não houver imagem, apenas atualize os outros campos
            if ($prato_id) {
                $sql = "UPDATE cardapio SET nome_prato = '$nome', descricao_prato = '$desc', valor_prato = '$preco' WHERE id_cardapio = $prato_id";
            } else {
                // Inserção de novo prato
                $sql = "INSERT INTO cardapio (foto_prato, nome_prato, descricao_prato, valor_prato, id_estabelecimento) VALUES ('$path', '$nome', '$desc', '$preco', $id_estabelecimento)";
            }
        }
    
        $resultado = mysqli_query($con, $sql);
    
        if ($resultado) {
            
        } else {
            echo "Erro ao cadastrar ou atualizar o prato.";
        }


    }

    $sql = "SELECT COUNT(*) as total_pratos FROM cardapio WHERE id_estabelecimento = $id_estabelecimento";
    $result = $con->query($sql);
    
    $total_pratos = 0; // Inicializa a variável
    
    if ($result) {
        $row = $result->fetch_assoc();
        $total_pratos = $row['total_pratos'];
    }
    
    $_SESSION['totalpratos'] = $total_pratos;

    ?>
</body>
</html>