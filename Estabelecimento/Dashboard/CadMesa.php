<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/NavStyle.css">
    <link rel="stylesheet" href="css/CadMesaStyle.css">
</head>
<body><?php 
include "../../conexao.php";
session_start();
$id_estabelecimento = $_GET['id'] ?? $_SESSION['user_id'];

// Verifica se o ID foi passado corretamente
if (!$id_estabelecimento) {
    echo "ID do estabelecimento não encontrado!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


$nomemesa = $_POST['nomemesa'];
$desc = $_POST['desc'];
$numeropeople = $_POST['npessoa'];
 



$sql = "INSERT INTO mesa (npessoas, descmesa, nome_mesa, id_estabelecimento) VALUES ($numeropeople, '$desc','$nomemesa', $id_estabelecimento) ";
$insert = mysqli_query($con, $sql);

}

?>

<?php 
$sql = "SELECT nome_mesa, descmesa, npessoas FROM mesa WHERE id_estabelecimento = $id_estabelecimento";
$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $mesas = [];
    
    
    while ($row = mysqli_fetch_assoc($result)) {
        $mesas[] = $row;
    }
} 




?>
    <main>
        <div class="nav_esquerda">
            <img id="logo" src="img/g1 (4).png" alt="">
            <nav>
                <ul>
                    <a href="dashboard.php?id=<?php echo $id_estabelecimento;?>"><li><img class="img_nav" src="img/botao-home 1.png" alt="">Home</li></a>
                    <a href=""><li><img class="img_nav" src="img/perfil 2.png" alt="">Meu Perfil</li></a>
                    <a href="CadMesa.php?id=<?php echo $id_estabelecimento;?>"><li><img class="img_nav" src="img/mesa-de-jantar 1.png" alt="">Mesas</li></a>
                    <a href="CadCardapio.php?id=<?php echo $id_estabelecimento;?>"><li><img class="img_nav" src="img/cardapio 1.png" alt="">Cardápio</li></a>
                    <a href="ReservaPen.php"><li><img class="img_nav" src="img/sino-do-hotel 1.png" alt="">Reservas</li></a>
                    <a href=""><li><img class="img_nav" src="img/notificacao 1.png" alt="">Notificação</li></a>
                    <a href=""><li><img class="img_nav" src="img/avaliacao 8.png" alt="">Avaliações</li></a>
                    <a href="../../login/login.php"><li><img id='sair_icone' src="img/sair.png" alt="">Sair</li></a>
                </ul>
            </nav>
        </div>
        <div class="container_direita">
            <h1>Cadastrar Mesas</h1>
            <div class="cad_mesa">
                <form action="" method="post">
                    <div class="form_esquerda">
                        <div>
                            <label for="nome">Mesa</label>
                            <input style = "
                            background-color: #d8d8d8;
                            
                            
                            " type="text" name="nomemesa">
                        </div>
                        <div>
                            <label for="desc">Descrição</label>
                            <textarea style = "
                            background-color:#d8d8d8;
                            
                            
                            "  name="desc" id="desc"></textarea>
                        </div>
                    </div>
                    <div class="form_direita">
                       <div>
                        <label for="npessoa">Número de pessoas</label>
                        <input style = "
                           background-color: #d8d8d8;
                            
                            
                            " type="number" name="npessoa" id="npessoa" class="number">
                       </div>
                       <input  id="btn_enviar" type="submit" value="Cadastrar">
                    </div>
                </form>
            </div>
            <h1>Mesas cadastradas</h1>
            <div class="container_global">
                <div class="container_mesas">

<?php 


if (!empty($mesas)) {
    foreach ($mesas as $mesa) {
        echo '
        <div class="card_mesa">
            <h2>' . $mesa['nome_mesa'] . '</h2>
            <p>' . $mesa['descmesa'] . '</p>
            <div class="div_btn">
                <p id="estado_mesa">Livre</p> <!-- Ajuste conforme o estado real -->
                <div class="desc_img">
                    <img id="img" src="img/pessoa.png" alt="">
                    <p>' . $mesa['npessoas'] . ' pessoas</p>
                </div>
            </div>
        </div>
        ';
    }
} else {
    echo "<p>Nenhuma mesa disponível para este estabelecimento.</p>";
}

$sql = "SELECT COUNT(*) as total_mesas FROM mesa WHERE id_estabelecimento = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_estabelecimento); // 'i' para inteiro
$stmt->execute();
$stmt->bind_result($total_mesas);
$stmt->fetch();
$stmt->close();


$_SESSION['totalmesas'] = $total_mesas;






?>

                
                </div>
                </div>
            </div>
    </main>
</body>





</html>