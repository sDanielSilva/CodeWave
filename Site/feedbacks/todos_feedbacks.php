<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CodeWave | Feedbacks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/1.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="col-md-4">
                <a class="navbar-brand" href="../../Site/index.php"><img src="assets/img/logo2.png"
                        style="margin-left: -50px;height: 50px" alt="logo" /></a>
            </div>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar align-self-center d-flex">
                <div class="dropdown">
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-user text-dark me-5" style="font-size: 25px;"><span
                                class="arrow">&#9660;</span></i>
                        <span
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                    </a>
                    <div class="dropdown-content">
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <a><?php echo $_SESSION['user_name']; ?></a>
                            <a href="./fecharSessao.php"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Header -->

    <section class="main" id="home">
        <div class="popup" id="popup">
            Tem alguma dúvida? Clique aqui para falar com o nosso chatbot!
        </div>

        <a href="../../Site/bilhetes.php" class="destaque-bilhetes"><img
                src="./assets/img/tickets-ticket-svgrepo-com.svg" alt="Tickets">Bilhetes Online</a>

        <script type="module">
            import Chatbot from "https://cdn.jsdelivr.net/npm/flowise-embed/dist/web.js";
            Chatbot.init({
                chatflowid: "24f2b4ef-1912-458b-a864-b23b35a03632",
                apiHost: "http://127.0.0.1:3000",
            });
        </script>
    </section>

    <section class="main" id="feedback">
        <div class="container">
            <br>
            <br>
            <div class="col-md-12">
                <div class="bg-light p-3 rounded">
                    <div class="bg-light rounded d-flex justify-content-between align-items-center">
                        <h1 class="h1"><strong>Feedbacks</strong></h1>
                        <a href='dar_feedback.php'><button type="button" class="btn btn-primary"
                                style='background-color: #3bc0d8; border-color: #3bc0d8;'><i
                                    class='fas fa-arrow-left'></i> Voltar</button></a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome do utilizador</th>
                                    <th>Data</th>
                                    <th style="width: 60%;">Descrição</th>
                                    <th>Avaliação</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaFeedbacks">
                                <?php include 'mostrarTodosFeedbacks.php';
                                foreach ($feedbacks as $feedback) {
                                    echo '<tr>';
                                    echo '<td>' . $feedback['nome_utilizador'] . '</td>';
                                    echo '<td>' . $feedback['data_formatada'] . '</td>';
                                    echo '<td>' . $feedback['descricao'] . '</td>';
                                    echo '<td>';
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $feedback['avaliacao']) {
                                            echo '<i class="fas fa-star"></i>';
                                        } else {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                    }
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        if (empty($feedbacks)) {
                            echo "<p class='text-center'>Nenhum feedback encontrado.</p>";
                        }
                        ?>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </section>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">CodeWave</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            R. Cmte. Pinho e Freitas 28, 3750-127 Águeda
                        </li>
                        <br>
                        <div class="localizacao">
                            <button class="btn_loc" id="btn_loc">Iniciar navegação</button>
                        </div>
                        <br>
                        <br>
                        <img src="assets/img/localizacao.png" alt="" style="width: 400px">
                        <br>
                        <br>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">(+351) 123456789</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none"
                                href="mailto:codewaveptw@gmail.com">codewaveptw@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Navegação</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="../../Site/index.php">Página Inicial</a></li>
                        <li><a class="text-decoration-none" href="../../Site/horarios.html">Horários</a></li>
                        <li><a class="text-decoration-none" href="../../Site/bilhetes.php">Bilhetes</a></li>
                        <li><a class="text-decoration-none" href="../../Site/alugueres.html">Alugueres</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Informação Extra</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="../../Site/contact.html">Contactos</a></li>
                        <li><a class="text-decoration-none" href="../../Site/about.html">Sobre Nós</a></li>
                        <li><a class="text-decoration-none" href="../../Site/restauracao.html">Restauração</a></li>
                        <li><a class="text-decoration-none" href="../../Site/alojamento.html">Alojamento</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                    class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                    class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.tiktok.com/"><i class="fab fa-tiktok fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Endereço de Email</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail"
                            placeholder="Endereço de Email">
                        <div class="input-group-text btn-success text-light">Subscrever</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-center text-light">
                            Copyright &copy; 2024
                            <a rel="sponsored" href="" target="_blank">CodeWave</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/script.js"></script>
    <!-- End Script -->
</body>

</html>