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
  <link rel="stylesheet" type="text/css" href="css/alojamento.css">
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
            <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div class="collapse navbar-collapse pull-right cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="main-nav">
            <h3>Menu</h3>
            <ul class="nav navbar-nav navbar-right">
              <li style="margin-top: 40px;"></li>
              <li class="active dropdown" role="presentation">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Informações Gerais<i class="fa fa-caret-down"></i></a>
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
                <a href="<?php echo isset($_SESSION['user_id']) ? 'feedbacks/dar_feedback.php' : 'feedbacks/login.html'; ?>" role="button" aria-expanded="false">Dê o seu feedback!</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  

    <a href="bilhetes.php" class="destaque-bilhetes"><img src="./images/tickets-ticket-svgrepo-com.svg" alt="Tickets">Bilhetes Online</a>

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
      <img src="https://www.slidesplash.com/static/assets/images/banners/banner-servicos.png" alt="">
    </div>
  </section>

  <section class="alojamentos">
    <div class="container-fluid">
      <div class="col-md-12 pad80">
        <h2 class="section-title">Alojamento</h2>
      </div>
    </div>
  </section>

  <div class="product-gallery" id="products"></div>

  <div id="rentModal" class="modal">
    <div class="modal-content">
      <h2>Formulário de Alojamento</h2>
      <form id="rentForm" class="form-styled">
        <div class="form-group">
          <label for="productName">Produto:</label>
          <input type="text" id="productName" name="productName" readonly>
        </div>
        <div class="form-group">
          <img id="productImage" src="" alt="Imagem do produto">
        </div>
        <div class="form-group">
          <label for="startTime">Data de Entrada:</label>
          <input type="date" id="startDate" name="startDate">
        </div>
        <p id="errorMessage"></p>
        <div class="form-group">
          <label for="endTime">Data de Saída:</label>
          <input type="date" id="endDate" name="endDate">
        </div>
        <div class="form-group">
          <label for="quantity">Quantidade:</label>
          <input type="number" id="quantity" name="quantity" min="1">
        </div>
        <p id="availabilityMessage"></p>
        <div class="form-group">
          <label for="totalPrice">Preço Total:</label>
          <input type="text" id="totalPrice" name="totalPrice" readonly>
        </div>
        <input type="hidden" id="isAlojamento" name="isAlojamento" value="true">
        <button type="submit" class="btn-styled">Confirmar</button>
      </form>

    </div>
  </div>

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
  <script src="js/alojamento.js"></script>
</body>