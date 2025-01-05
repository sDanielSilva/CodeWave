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
                                    <li><a href="mapa.html">Mapa do Parque</a></li>
                                    <li><a href="contact.php">Contactos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Serviços
                                    e Horários<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="horarios.html">Horários</a></li>
                                    <li><a href="bilhetes.php">Bilhetes</a></li>
                                    <li><a href="restauracao.html">Restauração</a></li>
                                    <li><a href="alojamento.html">Alojamento</a></li>
                                    <li><a href="alugueres.html">Alugueres</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Eventos e
                                    Entretenimento<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#events">Eventos e Atividades</a>
                                    </li>
                                    <li><a href="noticias.html">Notícias</a></li>
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

    <section class="main" id="pages" style="height: 220px">
        <div class="page-title overlay">
            <img src="https://www.slidesplash.com/static/assets/images/banners/banner-historia.png" alt="">
        </div>
    </section>

    <section id="about">
        <div class="container main-content">

            <div class="col-md-12">
                <h2 class="section-title">como começámos</h2>

                <p>Bem-vindo à nossa jornada! Tudo começou com uma simples ideia e uma grande dose de paixão. O nosso
                    percurso nasceu de um desejo ardente de fazer a diferença e deixar uma marca positiva no mundo que
                    nos rodeia.</p>
                <p>No coração da nossa história está a procura incessante pela inovação, pelo desafio do
                    profissionalismo e pelo compromisso com a excelência. O que começou como um sonho compartilhado
                    entre amigos rapidamente se transformou numa missão compartilhada por uma equipa apaixonada.</p>
                <p>A nossa jornada foi moldada por desafios, conquistas e, acima de tudo, por pessoas extraordinárias
                    que se uniram em torno de um propósito comum. Cada passo dado, cada obstáculo superado e cada
                    sucesso alcançado são testemunhos do nosso compromisso inabalável com a qualidade, a integridade e a
                    inovação.</p>
            </div>

            <div class="col-md-6 about-vid pad40">
                <div class="vid-container">
                    <a href="https://www.youtube.com/watch?v=mOz13Y-QotI" class="popup-video">
                        <img src="images/descida_escorrega.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>

            <div class="col-md-6 pad40">
                <br>
                <br>
                <br>
                <ul class="check-list">
                    <li>2 novos escorregas para diversão extra!</li>
                    <li>Várias zonas de lazer!</li>
                    <li>15 atrações!</li>
                    <li>10 piscinas para crianças e adultos!</li>
                    <li>Permitida entrada a animais!</li>
                </ul>
            </div>
        </div>



        <a href="bilhetes.php" class="destaque-bilhetes"><img src="./images/tickets-ticket-svgrepo-com.svg"
                alt="Tickets">Bilhetes Online</a>

                <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="CodeWave"
  agent-id="7608ed60-5ee5-4799-a4fb-786a5e86e2d5"
  language-code="pt"
></df-messenger>
    </section>

    <section id="timeline">
        <div class="container main-content">
            <div class="col-md-12">
                <h2 class="section-title">nossa jornada</h2>

                <ul class="timeline">

                    <li>
                        <div class="timeline-badge wow fadeIn"></div>
                        <div class="timeline-panel wow fadeInLeft">

                            <div class="timeline-header">
                                <h4>Desenho da base de dados</h4>
                            </div>

                            <div class="timeline-image">
                                <img src="images/diagrama.png" class="img-responsive" alt="">
                            </div>

                            <div class="timeline-descr">
                                <p>O início de tudo, o desenho da base de dados foi o ponto de partida crucial para o
                                    restante do projeto. Este marco inicial estabeleceu as bases sólidas da lógica da
                                    base de dados e permitiu o avanço para os próximos passos.</p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-badge wow fadeIn"></div>
                        <div class="timeline-panel wow fadeInRight">

                            <div class="timeline-header">
                                <h4>Criação do procedure</h4>
                            </div>

                            <div class="timeline-image">
                                <img src="images/procedure.png" class="img-responsive" alt="">
                            </div>

                            <div class="timeline-descr">
                                <p>Depois de termos o diagrama da base de dados finalizado, criámos o procedure em
                                    postgreSQL para posteriormente criar a base de dados com os registos do parque
                                    aquático.</p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">

                            <div class="timeline-header">
                                <h4>Elaboração do site</h4>
                            </div>

                            <div class="timeline-image">
                                <img src="images/vscode.png" class="img-responsive" alt="">
                            </div>

                            <div class="timeline-descr">
                                <p>Com a base de dados pronta no pgAdmin, elaborámos o site do parque interligado com a
                                    mesma.</p>
                            </div>
                        </div>
                    </li>

                    <li class="timeline-inverted">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">

                            <div class="timeline-header">
                                <h4>Apresentação</h4>
                            </div>

                            <div class="timeline-image">
                                <img src="images/apresentacao.jpg" class="img-responsive" alt="">
                            </div>

                            <div class="timeline-descr">
                                <p>Com o trabalho finalizado chegou a altura de o apresentar perante os júris.</p>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>

            <div class="col-md-12 load wow fadeIn">
                <a href="#" class="btn-border">Ver mais</a>
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
                        <li><a href="horarios.html">Horários</a></li>
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
                                <span><i class="fa fa-envelope-o"><a href="contact.php">CodeWave</a></i>
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