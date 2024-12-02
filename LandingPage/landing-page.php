<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dica Gourmet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="banner">
        <header>
            <nav>
                <img id="logo" src="imgs/Logo.png" alt="logo">
                <ul>
                    <li><a href="cadastro.php">Home</a></li>
                    <li><a href="cadastro.php">Perfil</a></li>
                    <li><a href="cadastro.php">Histórico</a></li>
                    <li><a href="cadastro.php">Favoritos</a></li>
                    <li><a href="cadastro.php">Minhas reservas</a></li>
                </ul>
            </nav>
        </header>
        
        <div class="conteudo-banner">
            <div class="texto-banner">
                <h1>DICA GOURMET</h1>
                <p>Venha fazer parte do nosso sistema e deixe de lado a dor de cabeça na hora de realizar uma reserva. Restaurantes próximos de você e com as melhores avaliações aqui!</p> 
                <a href="#"><button onclick="escolhaCadastro()" id="cadastre-banner">Cadastre-se</button></a>
                <a href="#"><button onclick="entrar()" id="login-banner">Login</button></a> 
            </div>
            <img id="img-banner" src="imgs/PratoBanner.png" alt="prato de comida">
        </div>
        <img id="wave-banner" src="imgs/wave (1) 2.png" alt="wave">
    </div>

    <div class="pq-o-dica">
        <h2>Por que o Dica Gourmet?</h2>
        <div class="conteudo-pq-o-dica">
            <div class="img-pq-o-dica">
                <img id="prato-metade" src="imgs/PratoMetade-removebg-preview.png" alt="prato metade">
            </div>
            <div class="txt-pq-o-dica">
                <div class="listas">
                    <ol id="listaum">
                        <li><h3>Evitando filas de espera</h3>
                    <p>Faça reservas em qualquer momento do seu dia, evitando filas de espera e a burocracia das reservas presenciais</p></li>

                    <li><h3>Personalizar perfil</h3>
                    <p>Você pode personalizar seu perfil com temas que se enquadram na identidade visual do seu  Estabelecimento.</p></li>

                    <li><h3>Geolocalização</h3>
                    <p>Mostramos restaurantes de acordo com sua geolocalização, facilitando assim sua busca por estabelecimentos em sua área</p></li>

                    </ol>
                    <ol id="listadois" start="4" >
                    <li><h3>Favoritos e histórico</h3>
                    <p>Organize seus restaurantes de interesse em um só lugar, nossa aba de Favoritos e de histórico auxilia na sua busca pelo restaurante ideal.</p></li>
                    
                    <li><h3>Profissionais capacitados</h3>
                    <p>Profissionais extremamente capacitados prontos para auxiliá-lo durante toda sua estadia em nosso Software</p></li>
                    
                    <li><h3>Sistema avaliativo</h3>
                    <p>Tenha maior interação com seus clientes através do nosso sistema de avaliação que avalia desde os pratos até o ambiente oferecido.</p></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
            <h1 id="nossos-planos">Nossos planos</h1>
            <div class="nossos-planos">

                <div class="plano plano-prime">
                <div class="imagens-plano-prime">
                    <img id="logo-plano" src="imgs/plano-prime-logo.png" alt="plano-prime-logo">
                    <img id="um-mes-gratis" src="imgs/1-mes-gratis.png" alt="1-mes-gratis">
                </div>
                <div class="topo-card">
                    <h2>Prime</h2>
                    <hr>
                </div>
                <ul>
                    <li>100 reservas mensais</li>
                    <li>Acesso em um dispositivo</li>
                    <li>Acesso a avaliação de usuários</li>
                    <li>Divulgação básica</li>
                </ul>
                <a href="../Estabelecimento/CadEstabPt1.php"><button>Experimente já</button></a>
                </div>


                <div class="plano plano-deluxe">
                <img id="logo-plano"src=" imgs/plano-deluxe-logo.png" alt="plano-prime-logo">
                <div class="topo-card">
                    <h2>Deluxe</h2>
                    <hr>
                </div>
                
                    <ul>
                        <li>250 reservas mensais</li>
                        <li>Acesso em dois dispositivos</li>
                        <li>Acesso a avaliação de usuários</li>
                        <li>Divulgação média</li>
                    </ul>
                    <a href="../Estabelecimento/CadEstabPt1.php"><button>Experimente já</button></a>
                </div>


                <div class="plano plano-elegance">
                <img id="logo-plano" src="imgs/plano-elegance-logo.png" alt="plano-prime-logo">
                <div class="topo-card">
                    <h2>Elegance</h2>
                    <hr>
                </div>
                <ul>
                    <li>Reservas ilimitadas</li>
                    <li>Acesso livre</li>
                    <li>Acesso a avaliação de usuários</li>
                    <li>Divulgação avançada</li>
                </ul>
                <a href="../Estabelecimento/CadEstabPt1.php"><button>Experimente já</button></a>
                </div>


            </div>

                <h1 id="dificuldade-reserva">Dificuldade na hora de fazer uma reserva?</h1>
            <div class="dificuldade-na-reserva">
            <div class="cards">


                <div class="card1">
                <img class="icone icone-pergunta" src="imgs/pergunta.png" alt="icone-pergunta">

                <div class="texto-card">
                    <h2>Cansado da frustração na hora de fazer uma reserva?</h2>
                    <p>Cansado de ligar para vários restaurantes, só para ouvir que estão lotados? Com o Dica Gourmet, você reserva sua mesa sem sair de casa. Fuja das dificuldades e garanta seu lugar com apenas alguns cliques. </p>
                </div>
                </div>


                <div class="card2">
                <img class="icone icone-bate-papo" src="imgs/bate-papo.png" alt="icone-bate-papo">

                <div class="texto-card">
                    <h2>Praticidade e interface feita para você!</h2>
                    <p>A tranquilidade e a praticidade são essenciais durante sua reserva. Por isso dedicamos nossos esforços a criar uma interface limpa e intuitiva.</p>
                </div>
                </div>



                <div class="card3">
                <img class="icone icone-data" src="imgs/data-limite.png" alt="icone-data">
               
                <div class="texto-card">
                    <h2>Acompanhe suas reservas</h2>
                    <p>Escolha o horário, o dia e o local ideais para suas refeições. Explore o cardápio e os comentários de outros clientes, tudo de forma rápida e simples.</p>
                </div>
            </div>

    
               
            </div>
            <div class="mulher-telefone"><img id="mulher-telefone" src="imgs/mulher-usando-telefone.png" alt="mulher-usando-telefone"></div>
            </div>

                <div class="ta">
                    <img id="ondaRosa" src="imgs/ondaRosa.png" alt="">
                    <h1 id="alguns-estabelecimentos">Alguns estabelecimentos com nossos serviços</h1>
                    <div class="estabelecimentos">
                    <div class="estabelecimentos-imagens">
                        <div class="div-foto-estab">
                            <img class="foto-estab" src="imgs/outback.png" alt="outback">
                            <h2>Outback</h2>
                        </div>
                        <div class="div-foto-estab">
                            <img class="foto-estab" src="imgs/vikings.png" alt="vikings">
                            <h2>Viking's Burguer</h2>
                        </div>
                        <div class="div-foto-estab">
                            <img class="foto-estab" src="imgs/faustino.png" alt="faustino">
                            <h2>Faustino</h2>
                        </div>
                    </div>
                    </div>
                </div>
                    

                <?php 

                include "../Footer/footer.php";


                ?>

    <script>
        function escolhaCadastro() {
            window.location.replace("cadastro.php");
        }
        function entrar(){
            window.location.replace("../login/login.php");
        }
    </script>

</body>

</html>