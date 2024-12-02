<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleHome.css">
</head>
<body>
    
    <?php
    include "../conexao.php";
    include_once "apitest.php";
    $_SESSION['id_cliente'] = $id_cliente;
   
    ?>
    
    
    
   
    <section class="section_banner">
        <div class="header">
            <figure>
                <img src="img/logo.png" id="logo" alt="">
            </figure>
            <nav class="nav_header">
               <ul class="ul_header">
                    <li><a href="">Home</a></li>
                    <li><a href="<?php echo 'perfil.php?id=' .$id_cliente ?>">Perfil</a></li>
                    <li><a href="">Histórico</a></li>
                    <li><a href="">Favoritos</a></li>
                    <li><a href="">Minhas reservas</a></li>
                    <li><a href="">Avaliação</a></li>
               </ul>
            </nav>
        </div>

        <div class="principal_section_banner">
        <div class="txt_section_principal">
            <h1>Encontrar <span  class="txt_especial">bares</span> e <span class="txt_especial">restaurantes</span> nunca foi tão fácil!</h1>
            <form action="buscar.php" method="GET">
                <div class="container_pesquisa">
                    <input type="search" name="pesquisa" id="pesquisa" placeholder="Pesquise...">
                    <figure class="figure_img_pesquisa">
                        <img id="icon_pesquisa" src="img/icon-pesquisa.png" alt="Ícone de pesquisa">
                    </figure>
                </div>
            </form>
        </div>
        <div class="img_section_principal">
            <img id="img_principal" src="img/imgBanner.png" alt=""> 
        </div>
    </div>
    
    <!-- Resultados da Pesquisa (inicialmente ocultos) -->
   
</section>
   
<div id="resultados" style="

    width:100%;
    margin-top:4em;
    display:none
    ;
    
    justify-content:space-evenly;
    
    ">






        <div class="item" data-titulo="Item 1" style="">
            
        dadadadadadadaddadada
    
    </div>
        <div class="item" data-titulo="Item 2" style="">
            
        Outro item
    
    </div>
    </div>
<main id="main_content">
       <h2 id="encontre">Encontre a sua categoria ideal</h2>
       <section class="section_categorias">
           <div>
               <h2 class="categoria_h2">Categorias</h2>
                   <nav class="nav_categorias">
                       <ul>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('massa')" ><img class="comida_img" src="img/massa.png" alt="">Massas</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('pizzaria')"><img class="comida_img" src="img/pizza.png" alt="">Pizzaria</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Churrascaria')"><img class="comida_img" src="img/churrasco.png" alt="">Churrascaria</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('lanchonete')"><img class="comida_img" src="img/massa.png" alt="">lanchonete</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('vegana')"><img class="comida_img" src="img/vegan.png" alt="">Comida Vegana</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Comida Vegetariana')"><img class="comida_img" src="img/salada.png" alt="">Comida Vegetariana</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('tailandesa')"><img class="comida_img" src="img/comida-tailandesa.png" alt="">Comida Tailandesa</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Comida Indiana')"><img class="comida_img" src="img/biryani.png" alt="">Comida Indiana</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Frutos do mar')"><img class="comida_img" src="img/peixe-e-batata-frita.png" alt="">Frutos do Mar</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Carnes')"><img class="comida_img" src="img/carne.png" alt="">Carnes</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('petiscos')"><img class="comida_img" src="img/molho.png" alt="">Petiscos</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Infantil')"><img class="comida_img" src="img/cachorro-quente.png" alt="">Infantil</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Fast food')"><img class="comida_img" src="img/hamburguer (1).png" alt="">Fast Food</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('lanchonete')"><img class="comida_img" src="img/nachos.png" alt="">Lanchonete</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Bar')"><img class="comida_img" src="img/cerveja.png" alt="">Bar/Pub</a></li>
                           <li><a href=""onclick="event.preventDefault(); changeCategory('Sobremesas')"><img class="comida_img" src="img/taca-de-sorvete.png" alt="">Sobremesas</a></li>
                       </ul>
                   </nav>
           </div>
       
               <div class="container_categorias"  id="container_categorias">
       
               <script>

async function fetchRestaurantes(categoria = '') {
    console.log('Buscando restaurantes para a categoria:', categoria); 
    try {
        const response = await fetch(`buscar_restaurantes.php?categoria=${encodeURIComponent(categoria)}`);
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        const data = await response.json();

        console.log('Dados recebidos:', data); 

        const container = document.getElementById('container_categorias');
        container.innerHTML = ''; 

        if (data.length > 0) {
            data.forEach(restaurante => {
                console.log('Imagem:', restaurante.primeira_imagem); 

                let imagem = `../Estabelecimento/${restaurante.primeira_imagem}`;

                const card = `
                <a href='HomeEstab.php?id=${restaurante.id_estabelecimento}'>
                    <div class='cardCategoria'  >
                        <div class='enderecocard' >
                            <img class='estrelas'  src='img/estrelas-não-completas.png' alt=''>
                            <h2 class='h2_card'>${restaurante.nome_estabelecimento}</h2>
                            <div class='div_endereco'>
                                <img class='endereco_mapa' id='mapa' src='img/mapas-e-bandeiras 1.png' alt=''>
                                <p class='endereco_mapa'>${restaurante.logradouro}</p>
                            </div>
                        </div>
                        <div class='img-card' style="
                            background-image: url('${imagem}');
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;">
                        </div>
                    </div>
                </a>`;
                
                container.innerHTML += card;
            });
            
        } else {
            container.innerHTML = '<p id="nenhumrest" >Nenhum restaurante disponível no momento.</p>';
        }
    } catch (error) {
        console.error('Erro ao buscar restaurantes:', error);
    }
}


function changeCategory(categoria) {
    fetchRestaurantes(categoria);
}


window.onload = () => fetchRestaurantes('massa');


</script>
       </div>
       
       </section>
       <section class="section_recomendacao">
           <h2 class="titulo_recomenda">Como funcionam nossas recomendações</h2>
           <div class="div_recomendacao">
               <div class="cad_recomenda">
                   <img class="icon_recomenda_estrela" src="img/cinco-estrelas 1.png" alt="">
                   <div>
                       <h3>Avaliações</h3>
                       <p>Restaurantes com maiores avaliações serão priorizados em sua pesquisa</p>
                   </div>
               </div>
               <div class="cad_recomenda">
                   <img class="icon_recomenda" src="img/localizacao (1) 1.png" alt="">
                   <div>
                       <h3>Sua localização</h3>
                       <p>Baseado na sua geolocalização encontramos os melhores restaurantes próximos a você</p>
                   </div>
               </div>
               <div class="cad_recomenda">
                   <img class="icon_recomenda" src="img/interativo 2.png" alt="">
                   <div>
                       <h3>Seus interesses</h3>
                       <p>Nós analisamos restaurantes que você já tenha demonstrado interesse e moldamos suas sugestões </p>
                   </div>
               </div>
           </div>
           <p class="p_relatorio">Gostaria de ver os restaurantes mais cobiçados?<a href="gerar_relatorio_restaurantes.php">Ver Relatório</a></p>
       </section>
       <h2 class="titulo_proxima_voce">Próximos a você</h2>
       
       
       <section class="section_proximo_voce">
       <?php    
         
         if ($con->connect_error) {
       die("Conexão falhou: " . $con->connect_error);
       }
       
       
        
       
       
       if (isset($nearbyEstablishments) && count($nearbyEstablishments) > 0) {
       $exibidos = [];
           //echo "<pre>";
           //echo print_r($nearbyEstablishments);
          // echo "</pre>";
       foreach ($nearbyEstablishments as $establishiment) {
           // Adiciona o ID do restaurante ao array de exibidos
           $exibidos[] = $establishiment['id_estabelecimento'];
           // Define a imagem do restaurante
           $primeiraImagem = $establishiment['primeira_imagem'];  // Corrigido de $establishment para $establishiment
           // Obter serviços do restaurante (assumindo que $establishiment já contém serviços)
           $servicos = $establishiment['servicos'] ?? []; // Adicionando os serviços aqui
       
           echo "
           <a href='HomeEstab.php?id={$establishiment['id_estabelecimento']}'>
               <div class='card' style='width: 25vw; min-height: 40vh;'>
                   <img id='imagemcard'
                   style='
                   border-top-left-radius: 1em;
                   border-top-right-radius: 1em;
                   width: 25vw;
                   height: 28vh;'
                   src='../Estabelecimento/$primeiraImagem' alt='Imagem do estabelecimento'>
                   <div class='titulo'>
                       <h2 style='color: black; width: 26vw; font-size: 16pt;'>{$establishiment['nome_estabelecimento']}</h2>
                       <div class='enderec_container' style='width: 25vw; display:flex; align-items: center;'>
                           <img class='enderec' src='img/lugar-colocar 2.png' alt='' style='width:1.2vw'>
                           <p style='color:#232222; font-size: 8pt' class='enderec'>{$establishiment['logradouro']}</p>
                       </div>
                   </div>
                   <div class='categoriasrestaurante' style='
                   width: 23w;
                   display: flex;
                   flex-wrap: wrap;
                   align-items: center'
                   justify-content: center;>
           ";
           $_SESSION['id_estab'] = $establishiment['id_estabelecimento']  ;
           // Exibe os serviços de cada restaurante
           if (!empty($servicos)) {
               foreach ($servicos as $servico) {
                   echo "
                   <div class='card_serv' style='
                   box-shadow: 2px 2px 6px 2px rgba(0,0,0,0.16);
                   min-width: 3vw;
                   height: 3vh;
                   display:flex;
                   align-items: center;
                   justify-content: center;
                   padding: 1.2em 1.3em;
                   border-radius: 5px'>
                       <p style='color: #515151; font-size: 8pt; font-weight: 400;'>" . htmlspecialchars($servico) . "</p>
                   </div>";
               }
           } else {
               echo "<p style='color: black; font-size: 0.8em'>Nenhum serviço disponível.</p>";
           }
           echo "
                   </div>
                   <div class='reservarfavoritar'>
                       <button id='reservar'>Reservar</button>
                       </a>
                        <img class='favoritar'
            src='img/amar2.png'
            alt='Favoritar'
            data-id='{$establishiment['id_estabelecimento']}'>
       
                   </div>
               </div>
       
           ";
       }
       } else {
       echo "<p id='nenhumrest'>Nenhum restaurante próximo disponível no momento.</p>";
       }
       ?>
       
       
       </section>
       
       
       <script>
         document.addEventListener('DOMContentLoaded', () => {
       // Seleciona o container pai dos cards (ajuste o seletor se necessário)
       const container = document.querySelector('.section_proximo_voce');
       // Usa evento delegado no container
       container.addEventListener('click', (event) => {
           if (event.target.classList.contains('favoritar')) {
               // Obtém o ícone clicado
               const icon = event.target;
               // Alterna a imagem do coração
               const isFavorited = icon.src.includes('img/amar1');
               if (isFavorited) {
                   icon.src = 'img/amar2.png'; // Coração branco
               } else {
                   icon.src = 'img/amar1.png'; // Coração vermelho
               }
               // (Opcional) Enviar requisição para o backend com o estado
               const estabelecimentoId = icon.getAttribute('data-id');
               console.log('Estabelecimento ID:', estabelecimentoId); // Debug
               // Você pode usar fetch/AJAX para atualizar o estado no banco
               /*
               fetch('atualizarFavorito.php', {
                   method: 'POST',
                   body: JSON.stringify({ id: estabelecimentoId, favorito: !isFavorited }),
                   headers: {
                       'Content-Type': 'application/json'
                   }
               });
               */
           }
       });
       });
       </script>
   </main> 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function() {
    // Função de busca com AJAX
    function realizarBusca() {
        var pesquisa = $('#pesquisa').val().trim();

        // Verifica se há pesquisa
        if (pesquisa !== '') {
            $.ajax({
                url: 'buscar.php',  // URL onde está seu código PHP
                type: 'GET',
                data: { pesquisa: pesquisa },
                success: function(data) {
                    // Exibe os resultados no mesmo local
                    $('#resultados').html(data).show();
                },
                error: function() {
                    $('#resultados').html('Erro ao realizar a busca.').show();
                }
            });
        } else {
            $('#resultados').hide();  // Se a pesquisa estiver vazia, esconde os resultados
        }
    }

    // Ao clicar no ícone de pesquisa
    $('#icon_pesquisa').click(function(e) {
        e.preventDefault();  // Previne o envio do formulário
        realizarBusca();     // Chama a função de busca
    });

    // Ao pressionar "Enter" no campo de pesquisa
    $('#pesquisa').keypress(function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();  // Previne o envio do formulário
            realizarBusca();     // Chama a função de busca
        }
    });
});
    </script>
</body>
</html>
