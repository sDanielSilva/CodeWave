<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />

  <title>CodeWave</title>
  <link rel="shortcut icon" href="images/1.png" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="css/swiper.min.css" />
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
  <link rel="stylesheet" type="text/css" href="css/shuffle.css" />
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/tempo.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

  <header class="main">
    <nav class="navbar navbar-default navbar-static-top fluid_header">
            <div class="container">
                <div class="col-md-4">
                    <a class="navbar-brand" href="index.php"><img src="images/logo2.png" style="height: 50px"
                            alt="logo" /></a>
                </div>

                <div class="col-md-8">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle toggle-menu menu-right push-body"
                            data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-right cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right"
                        id="main-nav">
                        <h3>Menu</h3>
                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-top: 40px;"></li>
                            <li class="active dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Informações Gerais<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="mapa.php">Mapa do Parque</a></li>
                                    <li><a href="contact.php">Contactos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Serviços
                                    e Horários<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="horarios.php">Horários</a></li>
                                    <li><a href="bilhetes.php">Bilhetes</a></li>
                                    <li><a href="restauracao.php">Restauração</a></li>
                                    <li><a href="alojamento.php">Alojamento</a></li>
                                    <li><a href="alugueres.php">Alugueres</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Eventos e
                                    Entretenimento<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="eventos.php">Eventos e Atividades</a>
                                    </li>
                                    <li><a href="noticias.php">Notícias</a></li>
                                </ul>
                            </li>
                            <li style="margin-bottom: 50px;">
                                <a href="loja-online/index.php" role="button" aria-expanded="false">Loja Online</a>
                            </li>
                            <li style="margin-top: 360px;"></li>
                           
                            <li>
                                <a href="<?php echo isset($_SESSION['user_id']) ? 'feedbacks/dar_feedback.php' : 'feedbacks/login.html'; ?>"
                                    role="button" aria-expanded="false">Dê o seu feedback!</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
  </header>

  <section class="main" id="home">
    <div class="swiper-container fullscreen">
      <div class="swiper-wrapper">
        <div class="swiper-slide overlay" style="
              background: url('./images/banner1.jpg');
              background-size: cover;
            ">
          <div class="slider-content container">
            <div class="col-md-12">
              <h3>
                Bem-vindo ao <br />
                <span>CodeWave</span>
              </h3>
              <h4>Portugal <span>Aveiro</span>!</h4>
              <div class="cta">
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide overlay" style="
              background: url('./images/banner2.jpg');
              background-size: cover;
            ">
          <div class="slider-content container">
            <div class="col-md-12">
              <h3>
                Bem-vindo ao <br />
                <span>CodeWave</span>
              </h3>
              <h4>Portugal <span>Aveiro</span>!</h4>
              <div class="cta">
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide overlay" style="
              background: url('./images/banner3.webp');
              background-size: cover;
            ">
          <div class="slider-content container">
            <div class="col-md-12">
              <h3>
                Bem-vindo ao <br />
                <span>CodeWave</span>
              </h3>
              <h4>Portugal <span>Aveiro</span>!</h4>
              <div class="cta">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="swiper-pagination"></div>

      <div class="scroll-down">
        <a href="#about-us"><i class="fa fa-angle-double-down"></i></a>
      </div>



      <a href="bilhetes.php" class="destaque-bilhetes"><img src="./images/tickets-ticket-svgrepo-com.svg" alt="Tickets">Bilhetes Online</a>

      <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="CodeWave"
  agent-id="7608ed60-5ee5-4799-a4fb-786a5e86e2d5"
  language-code="pt"
></df-messenger>
    </div>
  </section>

  <section id="about-us">
    <br>
    <br>
    <br>
    <div class="container main-content">
      <div class="row">
        <h2 class="section-title">Sobre Nós</h2>
        <div class="about-description">
          <p>
            <br />
            Bem-vindo ao CodeWave, o seu destino definitivo para diversão aquática e aventuras emocionantes! Situado no
            coração de uma paisagem exuberante e tropical, oferece uma experiência única que combina
            adrenalina, relaxamento e momentos inesquecíveis para toda a família. <br />

            No CodeWave, estamos comprometidos em proporcionar uma experiência aquática incomparável, onde a diversão
            e a segurança são prioridades máximas. Com uma variedade de escorregas desde alta velocidade até
            escorregas de água suaves para os mais pequenos, há algo para todos os gostos e
            idades. Prepare-se para mergulhar em piscinas cristalinas, surfar nas ondas artificiais, e relaxar em rios
            tranquilos que serpenteiam pelo parque. <br />

            Além dos escorregas emocionantes, é-lhe oferecida uma variedade de comodidades, incluindo áreas de
            descanso sombreadas, restaurantes à beira da piscina e opções de entretenimento ao vivo. A nossa equipa
            dedicada está sempre à disposição para garantir que sua visita seja memorável e sem preocupações. <br />

            Seja para uma escapadela de fim de semana em família, uma festa de aniversário emocionante ou uma excursão
            escolar divertida, o CodeWave é o lugar ideal para criar memórias duradouras. Junte-se a nós e deixe a
            diversão começar!
            <br />
            <br>
            <br>
            <br>
          </p>
          <a href="about.php" class="btn">Ver mais</a>
        </div>
      </div>
    </div>
  </section>

  <br>
  <br>

  <section id="gallery">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 pad80">
          <h2 class="section-title">Galeria</h2>
        </div>

        <ul class="gallery-sorting text-center">
          <li>
            <a href="#" class="btn-border active" data-group="all">Tudo</a>
          </li>
          <li>
            <a href="#" class="btn-border" data-group="escorrega">Escorregas</a>
          </li>
          <li>
            <a href="#" class="btn-border" data-group="piscinas">Piscinas</a>
          </li>
          <li>
            <a href="#" class="btn-border" data-group="atracoes">Atrações</a>
          </li>
          <li>
            <a href="#" class="btn-border" data-group="restauracao">Restauração</a>
          </li>
        </ul>

        <ul class="gallery-items list-unstyled" id="grid">
          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["escorrega"]'>
            <figure class="gallery-item">
              <a href="images/escorrega1.png">
                <img src="images/escorrega1.png" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["piscinas"]'>
            <figure class="gallery-item">
              <a href="images/piscina1.jpg">
                <img src="images/piscina1.jpg" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["escorrega"]'>
            <figure class="gallery-item">
              <a href="images/escorrega2.webp">
                <img src="images/escorrega2.webp" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["atracoes"]'>
            <figure class="gallery-item">
              <a href="images/atracao1.jpg">
                <img src="images/atracao1.jpg" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["restauracao"]'>
            <figure class="gallery-item">
              <a href="images/restauracao1.jpg">
                <img src="images/restauracao1.jpg" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["piscinas"]'>
            <figure class="gallery-item">
              <a href="images/piscina2.png">
                <img src="images/piscina2.png" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["escorrega"]'>
            <figure class="gallery-item">
              <a href="images/escorrega3.jpg">
                <img src="images/escorrega3.jpg" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["atracoes"]'>
            <figure class="gallery-item">
              <a href="images/atracao2.jpg">
                <img src="images/atracao2.jpg" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["piscinas"]'>
            <figure class="gallery-item">
              <a href="images/piscina3.png">
                <img src="images/piscina3.png" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["restauracao"]'>
            <figure class="gallery-item">
              <a href="images/restauracao2.jpg">
                <img src="images/restauracao2.jpg" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["restauracao"]'>
            <figure class="gallery-item">
              <a href="images/restauracao3.png">
                <img src="images/restauracao3.png" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6" data-groups='["atracoes"]'>
            <figure class="gallery-item">
              <a href="images/atracao3.png">
                <img src="images/atracao3.png" alt="" class="img-responsive" />
              </a>
            </figure>
          </li>

          <li class="col-md-2 col-sm-4 col-xs-6 shuffle_sizer"></li>
        </ul>
      </div>
    </div>
  </section>

  <section id="courses">
    <div class="container-fluid">
        <div class="col-md-12 main-content">
            <h2 class="section-title">Mapa</h2>
        </div>
        <br><br><br><br><br><br><br><br><br>
        <div id="mapContainer">
        <button id="unloadButton" onclick="unloadMap()" style="display:none;">Clique para esconder o mapa</button>
            <button id="loadButton" onclick="loadMap()">Clique para carregar o mapa</button>
            <iframe id="mapFrame" src="" frameborder="0"></iframe>
        </div>
    </div>
</section>
<script>
    function loadMap() {
    document.getElementById('mapFrame').src = './mapaInterativo.php';
    document.getElementById('mapFrame').style.display = 'block';
    document.getElementById('loadButton').style.display = 'none';
    document.getElementById('unloadButton').style.display = 'block'; // Mostra o botão de esconder
    document.getElementById('mapContainer').style.backgroundImage = 'none';
}

function unloadMap() {
    document.getElementById('mapFrame').src = '';
    document.getElementById('mapFrame').style.display = 'none';
    document.getElementById('loadButton').style.display = 'block';
    document.getElementById('unloadButton').style.display = 'none'; // Esconde o botão de esconder
    document.getElementById('mapContainer').style.backgroundImage = "url('./images/mapa2.png')";
}
</script>
<style> 
#unloadButton {
    position: absolute;
    top: 100px; /* Posição do topo ajustada */
    left: 50px; /* Posição da esquerda ajustada */
    z-index: 10;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    border: none;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: none; /* Inicialmente escondido */
}

#unloadButton:hover {
    background-color: rgba(0, 0, 0, 0.9);
}
#mapContainer {
            position: relative;
            width: 100%;
            height: 700px;
            background-image: url('./images/mapa2.png');
            background-size: cover;
            background-position: center;
        }

        #loadButton {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff; 
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #loadButton:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }

        #mapFrame {
            width: 100%;
            height: 100%;
            border: none;
            display: none; /* Inicialmente escondido */
        }
.testimonial {
  margin: 0 20px 40px;
}
.testimonial .testimonial-content {
  padding: 35px 25px 35px 50px;
  margin-bottom: 35px;
  background: #f0f5ff; /* Azul claro */
  border: 1px solid #3EC0F0; /* Azul claro */
  position: relative;
}

.testimonial-content .testimonial-icon {
  width: 50px;
  height: 45px;
  background: #3EC0F0; /* Azul do Facebook */
  text-align: center;
  font-size: 22px;
  color: #fff;
  line-height: 42px;
  position: absolute;
  top: 37px;
  left: -19px;
}
.testimonial-content .testimonial-icon:before {
  content: "";
  border-bottom: 16px solid #3EC0F0; /* Azul escuro */
  border-left: 18px solid transparent;
  position: absolute;
  top: -16px;
  left: 1px;
}
.testimonial .description {
  font-size: 15px;
  font-style: italic;
  color: #3EC0F0;
  line-height: 23px;
  margin: 0;
}
.testimonial .title {
  display: block;
  font-size: 18px;
  font-weight: 700;
  color: #3EC0F0; /* Cinzento escuro */
  text-transform: capitalize;
  letter-spacing: 1px;
  margin: 0 0 5px 0;
}
.testimonial .post {
  display: block;
  font-size: 14px;
  color: #3EC0F0; /* Azul do Facebook */
}
.owl-theme .owl-controls {
  margin-top: 20px;
}
.owl-theme .owl-controls .owl-page span {
  background: #3EC0F0; /* Azul claro */
  opacity: 1;
  transition: all 0.4s ease 0s;
}
.owl-theme .owl-controls .owl-page.active span,
.owl-theme .owl-controls.clickable .owl-page:hover span {
  background: #3EC0F0; /* Azul do Facebook */
}
</style>

  <section id="feedbacks">
    <h2 class="section-title"><br />
      Feedbacks
    </h2>
    <div class="demo">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div id="testimonial-slider" class="owl-carousel">
        <?php require 'testef.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:3,
        itemsDesktop:[1000,3],
        itemsDesktopSmall:[980,2],
        itemsTablet:[768,2],
        itemsMobile:[650,1],
        pagination:true,
        navigation:false,
        slideSpeed:1000,
        autoPlay:true
    });
});
</script>
    
  </section>

  <br>
  <br>

  <section id="events">
    <h2 class="section-title">Eventos 2024</h2>

    <ul class="gallery-sorting text-center">
      <li>
        <a href="#" class="btn-border" id="janeiro" data-month="1">janeiro</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="fevereiro" data-month="2">fevereiro</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="marco" data-month="3">marco</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="abril" data-month="4">abril</a>
      </li>
      <li>
        <a href="#" class="btn-border active" id="maio" data-month="5">maio</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="junho" data-month="6">junho</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="julho" data-month="7">julho</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="agosto" data-month="8">agosto</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="setembro" data-month="9">setembro</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="outubro" data-month="10">outubro</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="novembro" data-month="11">novembro</a>
      </li>
      <li>
        <a href="#" class="btn-border" id="dezembro" data-month="12">dezembro</a>
      </li>
    </ul>

    <br>
    <br>

    <div class="container mt-4">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Data de Início</th>
              <th>Data de Fim</th>
              <th>Tipo</th>
              <th>Descrição</th>
              <th>Número de Convidados</th>
              <th>Zona</th>
            </tr>
          </thead>
          <tbody id="tabelaEventos">
            <?php include 'scripts php index/evento.php';
            // Preenche a tabela com os dados dos funcionários
            if ($resultado->rowCount() > 0) {
              while ($evento = $resultado->fetch(PDO::FETCH_ASSOC)) {
                // Insere linhas na tabela HTML com os produtos
                echo '<tr>';
                echo '<td>' . $evento['data_inicio'] . '</td>';
                echo '<td>' . $evento['data_fim'] . '</td>';
                echo '<td>' . $evento['tipo'] . '</td>';
                echo '<td>' . $evento['descricao'] . '</td>';
                echo '<td>' . $evento['num_convidados'] . '</td>';
                echo '<td>' . $evento['nome_zona'] . '</td>';
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>Nenhum evento encontrado</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <script>
      // Função para filtrar os eventos por mês
      function filtrarEventosPorMes(mes) {
        // Obtem todos os elementos da tabela de eventos
        const tabela = document.getElementById('tabelaEventos');
        tabela.innerHTML = ''; // Limpa todas as linhas existentes na tabela

        // Itera sobre os eventos e mostra apenas os eventos correspondentes ao mês selecionado
        <?php
        include 'scripts php index/evento.php';
        if ($resultado->rowCount() > 0) {
          while ($evento = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo 'if (' . $evento['mes_inicio'] . ' === mes) {';
            echo 'const row = document.createElement("tr");'; // Cria uma nova linha na tabela
            echo 'row.innerHTML = `<td>' . $evento['data_inicio'] . '</td><td>' . $evento['data_fim'] . '</td><td>' . $evento['tipo'] . '</td><td>' . $evento['descricao'] . '</td><td>' . $evento['num_convidados'] . '</td><td>' . $evento['nome_zona'] . '</td>`;'; // Preencher a nova linha com os dados do evento
            echo 'tabela.appendChild(row);'; // Adiciona a nova linha à tabela
            echo '}';
          }
        }
        ?>
      }

      // Adiciona eventos de clique para cada botão de mês
      document.querySelectorAll('.gallery-sorting .btn-border').forEach(botao => {
        botao.addEventListener('click', function(event) {
          // Obtem o mês correspondente ao botão clicado
          const mes = parseInt(event.target.dataset.month);

          // Filtra os eventos pelo mês selecionado
          filtrarEventosPorMes(mes);
        });
      });

      // Função para filtrar os eventos por mês ao carregar a página
      window.addEventListener('DOMContentLoaded', function() {
        filtrarEventosPorMes(5); // Filtra os eventos pelo mês de maio (5)
      });
    </script>
  </section>

  <section id="weather-section">
    <div class="container">
      <h2 class="section-title">Previsão Meteorológica</h2>
      <div id="weather-carousel" class="carousel slide">
        <div class="carousel-container">
          <!-- Os elementos do carrossel serão adicionados dinamicamente aqui -->
        </div>
      </div>
      <div class="carousel">
        <button id="prevBtn">❮</button>
        <div id="carouselItems" class="carousel-container">
          <!-- Os elementos do carrossel serão adicionados dinamicamente aqui -->
        </div>
        <button id="nextBtn">❯</button>
      </div>

      <div id="hourly-weather" class="carousel slide">
        <div class="carousel-container">
          <!-- A previsão do tempo hora a hora será adicionada dinamicamente aqui -->
        </div>
      </div>
      <div class="carousel">
        <button id="prevBtnHourly">❮</button>
        <div id="hourlyItems" class="carousel-container">
          <!-- A previsão do tempo hora a hora será adicionada dinamicamente aqui -->
        </div>
        <button id="nextBtnHourly">❯</button>
      </div>
    </div>
  </section>

  <footer id="main-footer">
        <div class="container">
            <div class="row footer-top">
                <div class="col-md-3 col-xs-6 about">
                    <img src="images/logo2.png" alt="" />
                </div>

                <div class="col-md-2 col-xs-6 footer-nav">
                    <h4>Navegação</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="horarios.php">Horários</a></li>
                        <li><a href="bilhetes.php">Bilhetes</a></li>
                        <li><a href="loja-online/index.php">Loja Online</a></li>
                    </ul>
                </div>

                <div class="col-md-2 col-xs-6 footer-social">
                    <h4>Segue-nos</h4>
                    <ul class="footer-links">
                        <li><a href="https://www.facebook.com/" target="_blank">facebook</a></li>
                        <li><a href="https://twitter.com/?lang=pt" target="_blank">twitter</a></li>
                        <li><a href="https://www.instagram.com/" target="_blank">instagram</a></li>
                        <li><a href="https://www.tiktok.com/" target="_blank">tik tok</a></li>
                    </ul>
                </div>

                <div class="col-md-2 col-xs-6 footer-newsletter">
                    <h4>
                        Contactos
                    </h4>
                    <ul>
                        <div class="mailto">
                            <li>
                                <a href="contact.php" style="margin-left: 0px">codewaveptw@gmail.com</a>
                            </li>
                        </div>
                    </ul>
                </div>

                <div class="col-md-3 col-xs-6 footer-loc">
                    <h4>Localização</h4>
                    <ul>
                        <li>
                            ESTGA
                        </li>
                        <div class="localizacao">
                            <button class="btn_loc" id="btn_loc">Iniciar navegação</button>
                        </div>
                        <br>
                        <br>
                    </ul>
                </div>
            </div>
        </div>

  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/modernizr.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/swiper.min.js"></script>
  <script src="js/jquery.shuffle.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.countTo.js"></script>
  <script src="js/jquery.inview.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/calendar.min.js"></script>
  <script src="js/jquery.ajaxchimp.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/script.js"></script>
  <script src="js/tempo.js"></script>
</body>