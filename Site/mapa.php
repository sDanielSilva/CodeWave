<?php
session_start(); // Inicia a sessão
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

  <title>CodeWave</title>
  <link rel="shortcut icon" href="images/1.png" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/shuffle.css">
  <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>

  <header class="main">
    <nav class="navbar navbar-default navbar-static-top fluid_header">
      <div class="container">
        <div class="col-md-4">
          <a class="navbar-brand" href="index.php"><img src="images/logo2.png" style="height: 50px" alt="logo" /></a>
        </div>

        <div class="col-md-8">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse"
              data-target="#main-nav" aria-expanded="false">
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Serviços
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Eventos e
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


    <a href="bilhetes.php" class="destaque-bilhetes"><img src="./images/tickets-ticket-svgrepo-com.svg"
        alt="Tickets">Bilhetes Online</a>

        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="CodeWave"
  agent-id="7608ed60-5ee5-4799-a4fb-786a5e86e2d5"
  language-code="pt"
></df-messenger>
    </div>
  </header>

  <section class="main" id="pages" style="height: 220px">
    <div class="page-title overlay">
      <img src="https://www.slidesplash.com/static/assets/images/banners/banner-mapa.png" alt="">
    </div>
  </section>

  <style>
    .mapa {
      position: relative;
      width: 100%;
      height: auto;
      bottom: 100px;
      left: 15px;
    }

    .btn-container {
      position: absolute;
      bottom: 60px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .btn-container .btn {
      margin: 5px;
    }

    .full-width-img {
      width: 100%;
      height: auto;
      display: block;
    }
  </style>
  <section class="mapa">
    <div class="container-fluid222">
      <br>
      <br>
      <br>
      <div class="col-md-12 pad80">
        <h2 class="section-title">Mapa do Parque</h2>
      </div><div class="btn-container">
        <button class="btn btn-primary" type="submit" onclick="toggle360()" id="toggleButton6">
          <img src="./images/parque/panorama-video-svgrepo-com.svg" alt="" width="30px" height="30px"> Mapa Virtual
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleRestaurantes()" id="toggleButton2">
          <img src="./images/parque/icons8-fork.svg" alt="" width="30px" height="30px"> Restaurantes
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleWc()" id="toggleButton5">
          <img src="./images/parque/water-closet-svgrepo-com.svg" alt="" width="30px" height="30px"> WC
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleLojas()" id="toggleButton3">
          <img src="./images/parque/icons8-store.svg" alt="" width="30px" height="30px"> Lojas
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleServico()" id="toggleButton4">
          <img src="./images/parque/icons8-information.svg" alt="" width="30px" height="30px"> Serviços
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleDiversoes()" id="toggleButton1">
          <img src="./images/parque/icons8-water-park.svg" alt="" width="30px" height="30px"> Escorregas
        </button>
      </div>
      <!-- Imagem -->
      <!-- <img src="./images/image.jpg" alt="" class="full-width-img"> -->
      <iframe src="mapaInterativo.php" frameborder="0" width="1875px" height="900px" id="myFrame"></iframe>
      <!-- Botões -->
      
      <script>
        function toggleDiversoes() {
          var iframe = document.getElementById('myFrame');
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
          var toggleButton = iframeDocument.getElementById('toggleButton1');

          if (toggleButton) {
            // Simula um clique no botão dentro do iframe
            toggleButton.click();
          } else {
            console.error('Botão não encontrado dentro do iframe.');
          }
        }
        function toggleRestaurantes() {
          var iframe = document.getElementById('myFrame');
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
          var toggleButton = iframeDocument.getElementById('toggleButton2');

          if (toggleButton) {
            // Simula um clique no botão dentro do iframe
            toggleButton.click();
          } else {
            console.error('Botão não encontrado dentro do iframe.');
          }
        }
        function toggleLojas() {
          var iframe = document.getElementById('myFrame');
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
          var toggleButton = iframeDocument.getElementById('toggleButton3');

          if (toggleButton) {
            // Simula um clique no botão dentro do iframe
            toggleButton.click();
          } else {
            console.error('Botão não encontrado dentro do iframe.');
          }
        }
        function toggleServico() {
          var iframe = document.getElementById('myFrame');
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
          var toggleButton = iframeDocument.getElementById('toggleButton4');

          if (toggleButton) {
            // Simula um clique no botão dentro do iframe
            toggleButton.click();
          } else {
            console.error('Botão não encontrado dentro do iframe.');
          }
        }
        function toggle360() {
          var iframe = document.getElementById('myFrame');
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
          var toggleButton = iframeDocument.getElementById('toggleButton6');

          if (toggleButton) {
            // Simula um clique no botão dentro do iframe
            toggleButton.click();
          } else {
            console.error('Botão não encontrado dentro do iframe.');
          }
        }
        function toggleWc() {
          var iframe = document.getElementById('myFrame');
          var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
          var toggleButton = iframeDocument.getElementById('toggleButton5');

          if (toggleButton) {
            // Simula um clique no botão dentro do iframe
            toggleButton.click();
          } else {
            console.error('Botão não encontrado dentro do iframe.');
          }
        }
      </script>
      <div class="btn-container">
        <button class="btn btn-primary" type="submit" onclick="toggle360()" id="toggleButton6">
          <img src="./images/parque/panorama-video-svgrepo-com.svg" alt="" width="30px" height="30px"> Mapa Virtual
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleRestaurantes()" id="toggleButton2">
          <img src="./images/parque/icons8-fork.svg" alt="" width="30px" height="30px"> Restaurantes
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleWc()" id="toggleButton5">
          <img src="./images/parque/water-closet-svgrepo-com.svg" alt="" width="30px" height="30px"> WC
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleLojas()" id="toggleButton3">
          <img src="./images/parque/icons8-store.svg" alt="" width="30px" height="30px"> Lojas
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleServico()" id="toggleButton4">
          <img src="./images/parque/icons8-information.svg" alt="" width="30px" height="30px"> Serviços
        </button>
        <button class="btn btn-primary" type="submit" onclick="toggleDiversoes()" id="toggleButton1">
          <img src="./images/parque/icons8-water-park.svg" alt="" width="30px" height="30px"> Escorregas
        </button>
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
                <span><i class="fa fa-envelope-o"><a href="contact.php" style="hover: color: #f69504;">CodeWave</a></i>
              </li>
            </div>
          </ul>
        </div>

        <div class="col-md-3 col-xs-6 footer-loc">
          <h4>Localização</h4>
          <ul>
            <li>
              <span><i class="fa fa-map-marker"></i>&nbsp;&nbsp;&nbsp;ESTGA</span>
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
  </footer>

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
</body>