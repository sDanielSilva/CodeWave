<!DOCTYPE html>
<html lang="en">

<head>
    <title>CodeWave | Loja Online</title>
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
    <!--

-->
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

            <?php require "assets/php/mostrarCategorias.php"; ?>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex">
                        <li class="nav-item ms-2 me-3">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <div class="dropdown">
                            <li class="nav-item ms-5 me-3" id="produtos">
                                <a class="nav-link" href="#">Produtos <span class="arrow">&#9660;</span></a>
                            </li>
                            <div class="dropdown-content">
                                <a href="produtos.php">Ver Todos</a>
                                <hr>
                                <?php

                                foreach ($categorias as $categoria):
                                    ?>
                                    <a
                                        href="pagina_categoria.php?id_categoria=<?php echo $categoria['id_categoria']; ?>&nome_categoria=<?php echo urlencode($categoria['nome']); ?>">
                                        <?php echo $categoria['nome']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <li class="nav-item ms-5">
                            <a class="nav-link" href="index.php#novidades">Novidades</a>
                        </li>
                    </ul>
                </div>

                <div class="navbar align-self-center d-flex">
                    <div class="search-containerme-1 me-1" id="pesquisa">
                        <input type="text" placeholder="Pesquisar produto..." name="search" id="searchInput"
                            style="padding-right: 20px;">
                        <button id="microphoneBtn" class="botao-falar"
                            style="font-size: 23px; position: absolute; border: none; background: none; margin-left: -27px; margin-top: -1px;">
                            <i class="fa fa-microphone"></i>
                        </button>
                    </div>
                    <a class="nav-icon d-none d-lg-inline me-3" href="#" data-bs-toggle="modal"
                        data-bs-target="#templatemo_search">
                    </a>
                    <a class="nav-icon position-relative text-decoration-none me-5" href="carrinho.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1" style="font-size: 25px;"></i>
                        <span id="cartItemCount"
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"
                            style="margin-left: 10px;"></span>
                    </a>
                    <script>
                        // Função para atualizar o resumo do carrinho
                        function contar_produtos_carrinho() {
                            $.ajax({
                                type: "GET",
                                url: "atualizar_resumo_carrinho.php",
                                dataType: "json",
                                success: function (response) {
                                    if (response.totalProdutos > 0) {
                                        // Atualizar o resumo do carrinho com os novos totais
                                        document.getElementById('cartItemCount').innerText = response.totalProdutos;
                                    } else {
                                        document.getElementById('cartItemCount').innerText = '0';
                                    }
                                }
                            });
                        }

                        // Chamar a função assim que a página for carregada
                        document.addEventListener('DOMContentLoaded', function () {
                            contar_produtos_carrinho();
                        });
                    </script>

                    <div class="dropdown">
                        <a class="nav-icon position-relative text-decoration-none" href="#">
                            <i class="fa fa-fw fa-user text-dark me-5" style="font-size: 25px;"><span
                                    class="arrow">&#9660;</span></i>
                            <span
                                class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                        </a>
                        <div class="dropdown-content">
                            <?php if (isset($_SESSION['user_name'])): ?>
                                <a href="perfil.php"><?php echo $_SESSION['user_name']; ?></a>
                                <a href="./fecharSessao.php"><i
                                        class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                            <?php else: ?>
                                <a href="login.html">Login</a>
                                <a href="criar-conta.html">Criar conta</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </nav>
    <!-- Close Header -->

    <section class="main" id="home">


        <a href="../../Site/bilhetes.php" class="destaque-bilhetes"><img
                src="./assets/img/tickets-ticket-svgrepo-com.svg" alt="Tickets">Bilhetes Online</a>


                <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="CodeWave"
  agent-id="7608ed60-5ee5-4799-a4fb-786a5e86e2d5"
  language-code="pt"
></df-messenger>
    </section>

    <?php
    $id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : 'todos';
    $nome_categoria = isset($_GET['nome_categoria']) ? $_GET['nome_categoria'] : 'Todos';
    ?>

    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1"><?php echo htmlspecialchars($nome_categoria); ?></h1>
                <p>
                    <a href="index.php">Início</a> /
                    <a href="produtos.php">Produtos</a> /
                    <a
                        href="pagina_categoria.php?id_categoria=<?php echo htmlspecialchars($id_categoria); ?>&nome_categoria=<?php echo urlencode($nome_categoria); ?>"><?php echo htmlspecialchars($nome_categoria); ?></a>
                </p>
            </div>
        </div>
        <div class="row produtos">
            <!-- Os produtos serão carregados aqui dinamicamente -->
            <?php require "assets/php/mostrarProdutosCategoria.php"; ?>
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
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="../contact.php">codewaveptw@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Navegação</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="../../Site/index.php">Página Inicial</a></li>
                        <li><a class="text-decoration-none" href="../../Site/horarios.php">Horários</a></li>
                        <li><a class="text-decoration-none" href="../../Site/bilhetes.php">Bilhetes</a></li>
                        <li><a class="text-decoration-none" href="../../Site/alugueres.php">Alugueres</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Informação Extra</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="../../Site/contact.php">Contactos</a></li>
                        <li><a class="text-decoration-none" href="../../Site/about.php">Sobre Nós</a></li>
                        <li><a class="text-decoration-none" href="../../Site/restauracao.php">Restauração</a></li>
                        <li><a class="text-decoration-none" href="../../Site/alojamento.php">Alojamento</a></li>
                    </ul>
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
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.tiktok.com/"><i
                                    class="fab fa-tiktok fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="w-100 bg-black py-5">
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