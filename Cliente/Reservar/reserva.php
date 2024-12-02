<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Mesas</title>
    <link rel="stylesheet" href="css/Reservarstyle.css">
    <link rel="stylesheet" href="css/Reservarpt2.css">
</head>
<body>
    <main>
        <?php 
        include '../../conexao.php';
        include '../apitest.php';

        $id_estabelecimento = isset($_GET['id']) ? $_GET['id'] : null;
        
        $query = "SELECT * FROM mesa WHERE id_estabelecimento = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id_estabelecimento);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        
        <div class="header_main">
            <a id="a_logo" href=""><img id="seta" src="img/Arrow 2.png" alt=""></a>
            <img id="logo" src="img/logo (2).png" alt="">
        </div>

        <form class="container_geral" method="post" action="">
            <div class="select_mes">
                <select name="mes" id="mes" onchange="atualizarCarrossel(); atualizarData();">
                    <!-- Mês do ano -->
                    <option value="jan">Janeiro</option>
                    <option value="fev">Fevereiro</option>
                    <option value="mar">Março</option>
                    <option value="abr">Abril</option>
                    <option value="mai">Maio</option>
                    <option value="jun">Junho</option>
                    <option value="jul">Julho</option>
                    <option value="ago">Agosto</option>
                    <option value="set">Setembro</option>
                    <option value="out">Outubro</option>
                    <option value="nov">Novembro</option>
                    <option value="dez">Dezembro</option>
                </select>
            </div>
            <div class="carrossel">
                <button class="prev" type="button" onclick="mudarCard(-1)">&#10094;</button>
                <div class="slides" id="slides"></div>
                <button class="next" type="button" onclick="mudarCard(1)">&#10095;</button>
            </div>
            <input type="hidden" name="data" id="data">
            <div class="mesas_escolha">

                <?php 
                while ($row = $result->fetch_assoc()) {
                    $id_mesa = htmlspecialchars($row['id_mesa']); // ID da mesa
                    $nome_mesa = htmlspecialchars($row['nome_mesa']); // Nome da mesa
                    $descmesa = htmlspecialchars($row['descmesa']); // Descrição da mesa
                    $capacidade = htmlspecialchars($row['npessoas']); // Capacidade da mesa
                    ?>
                    
                    <div class="card_mesa">
                        <label for="mesa<?= $id_mesa ?>">Mesa <?= $id_mesa ?></label>
                        <label for="mesa<?= $id_mesa ?>"><?= $nome_mesa ?>, <?= $descmesa ?> </label>
                        <label id="label_user" for="mesa<?= $id_mesa ?>">
                            <img id="img_user" src="img/user (1) 6.png" alt=""><?= $capacidade ?>
                        </label>
                        <div>
                            <input type="checkbox" name="mesas[]" value="<?= $id_mesa ?>" id="mesa<?= $id_mesa ?>">
                            <label for="mesa<?= $id_mesa ?>" id="btn_reserva<?= $id_mesa ?>" class="btn_reserva">Reservar</label>
                        </div>
                    </div>
                <?php
                }
                ?>
                
            </div>
            <input type="hidden" name="mesa_selecionada" id="mesa_selecionada">
            <input id="btn_avancar"  type="submit" value="Avançar">
        </form>
        
<script>
    function mudarTexto(checkbox) {
    const mesaSelecionada = checkbox.id.replace('mesa', ''); // Captura o ID da mesa
    document.getElementById('mesa_selecionada').value = mesaSelecionada; // Atualiza o campo oculto
}
 let cardIndex = 0;
const cardsPorPagina = 9;

document.addEventListener("DOMContentLoaded", function() {
    const dataAtual = new Date();
    const mesAtual = dataAtual.getMonth();
    const mesNome = Object.keys({jan:0, fev:1, mar:2, abr:3, mai:4, jun:5, jul:6, ago:7, set:8, out:9, nov:10, dez:11})[mesAtual];

    document.getElementById('mes').value = mesNome; // Define o mês atual como padrão

    const meses = document.getElementById('mes').options;
    for (let i = 0; i < meses.length; i++) {
        if (i < mesAtual) {
            meses[i].disabled = true;
        }
    }

    atualizarCarrossel();
});

function atualizarCarrossel() {
    const mes = document.getElementById('mes').value;
    const diasNoMes = getDiasDoMes(mes);
    const slides = document.getElementById('slides');
    slides.innerHTML = '';

    const dataAtual = new Date();
    const diaAtual = dataAtual.getDate();
    const mesAtual = dataAtual.getMonth();

    let primeiroDiaHabilitado = 0; // Salva o primeiro dia habilitado para iniciar o carrossel

    // Adiciona todos os dias do mês
    for (let i = 1; i <= diasNoMes; i++) {
        const card = document.createElement('div');
        card.className = 'select_dia card_dia';
        const diaComZero = i < 10 ? `0${i}` : i;

        const isDisabled = isDiaDesabilitado(i, mesAtual, diaAtual);
        card.innerHTML = `
            <input type="radio" name="dia" class="check" id="d${i}" value="${i}" onchange="atualizarData();" ${isDisabled ? 'disabled' : ''}>
            <label class="card ${isDisabled ? 'disabled' : ''}" for="d${i}">${diaComZero}</label>
        `;
        slides.appendChild(card);

        if (!isDisabled && primeiroDiaHabilitado === 0) {
            primeiroDiaHabilitado = i; // Define o primeiro dia habilitado para o índice inicial
        }
    }

    // Calcula o índice inicial para o primeiro dia habilitado
    cardIndex = Math.floor((primeiroDiaHabilitado - 1) / cardsPorPagina) * cardsPorPagina;
    mostrarCards(cardIndex, diasNoMes);
}

function getDiasDoMes(mes) {
    const diasEmMeses = {
        jan: 31, fev: 28, mar: 31, abr: 30,
        mai: 31, jun: 30, jul: 31, ago: 31,
        set: 30, out: 31, nov: 30, dez: 31
    };

    const anoAtual = new Date().getFullYear();
    if (mes === 'fev' && (anoAtual % 4 === 0 && (anoAtual % 100 !== 0 || anoAtual % 400 === 0))) {
        return 29;
    }

    return diasEmMeses[mes];
}

function mostrarCards(index, totalCards) {
    const slides = document.querySelector('.slides');
    const offset = -Math.floor(index / cardsPorPagina) * 100;
    slides.style.transform = `translateX(${offset}%)`;

    const cards = document.querySelectorAll('.card_dia');
    cards.forEach((card, i) => {
        card.classList.toggle('ativo', i >= index && i < index + cardsPorPagina);
    });
}

function mudarCard(n) {
    const dias = document.querySelectorAll('.card_dia').length;
    const novoIndex = cardIndex + n * cardsPorPagina;

    if (novoIndex >= 0 && novoIndex < dias) {
        cardIndex = novoIndex;
        mostrarCards(cardIndex, dias);
    }
}

function atualizarData() {
    const mes = document.getElementById('mes').value;
    const diaSelecionado = document.querySelector('input[name="dia"]:checked');
    if (diaSelecionado) {
        const dia = diaSelecionado.value;
        const data = `${dia}/${mes}`;
        document.getElementById('data').value = data;
        console.log(data); // Verifique o valor da data aqui
    }
}

function isDiaDesabilitado(dia, mesAtual, diaAtual) {
    const mesSelecionado = Object.keys({jan: 0, fev: 1, mar: 2, abr: 3, mai: 4, jun: 5, jul: 6, ago: 7, set: 8, out: 9, nov: 10, dez: 11}).indexOf(document.getElementById('mes').value);
    return (mesSelecionado < mesAtual) || (mesSelecionado === mesAtual && dia < diaAtual);
}


</script>

<style>
            .disabled {
                opacity: 0.5; 
                pointer-events: none; 
                background-color: rgb(80, 80, 80); 
                color: black; 
            }
            label {
                color: white;
            }
        </style>

    </main>

    <?php 

    $id_cliente = $_SESSION['id_cliente'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dataSelecionada = $_POST['data']; // Captura a data selecionada
        $mesas_selecionadas = $_POST['mesas'] ?? []; // Captura as mesas selecionadas
        $mesa_selecionada = $_POST['mesa_selecionada'] ?? null; // Captura a última mesa selecionada
      
        // Exibe a primeira mesa do array
        if (!empty($mesas_selecionadas)) {
            $primeira_mesa_selecionada = $mesas_selecionadas[0];
            $mesas_string = implode(',', $mesas_selecionadas);
           
        } else {
            echo " Nenhuma mesa foi selecionada.";
        }
        
        $sql = "INSERT INTO reserva (id_cliente, id_estabelecimento, data_reserva, id_mesa, mesa_s, data_reserva_criacao) 
VALUES ($id_cliente, $id_estabelecimento, '$dataSelecionada', '$primeira_mesa_selecionada', '$mesas_string', NOW())";
        $resultado = mysqli_query($con, $sql);
        $id_reserva =  mysqli_insert_id($con);
        $_SESSION['id_reserva'] = $id_reserva;
        $_SESSION['data_reserva'] = $dataSelecionada;
        echo "<script> window.location.href='reservarpt2.php'  </script>";
        exit; 
    }
    ?>
</body>
</html>
</body>
</html>
