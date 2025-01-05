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
                        <input type="text" placeholder="Pesquisar produtos..." name="search" id="searchInput"
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Função para atualizar o número de produtos visíveis
            function atualizarNumeroProdutosVisiveis() {
                var numeroProdutosVisiveis = $('.container.py-5 .col-md-4:visible').length;
                $('.col-lg-6.m-auto h1').text('Produtos (' + numeroProdutosVisiveis + ')');
            }

            // Função de pesquisa
            function realizarPesquisa(searchText) {
                searchText = searchText.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                // Selecionar todos os elementos com a classe .col-12 dentro da seção de categorias
                $('.container.py-5 .col-12').each(function () {
                    // Remover acentos e caracteres especiais do texto do produto
                    var produtoText = $(this).find('h5').text().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                    // Mostrar ou ocultar o produto com base na pesquisa (ignorando maiúsculas e minúsculas)
                    $(this).toggle(produtoText.includes(searchText));
                });
                atualizarNumeroProdutosVisiveis();
            }

            // Ao digitar no campo de pesquisa
            $('#searchInput').on('input', function () {
                var searchText = $(this).val();
                realizarPesquisa(searchText);
            });

            // Função para iniciar o reconhecimento de voz
            function iniciarReconhecimentoDeVoz() {
                // Verificar se o navegador suporta SpeechRecognition
                if (!('webkitSpeechRecognition' in window || 'SpeechRecognition' in window)) {
                    alert("O seu browser não suporta reconhecimento de voz. Tente usar o Google Chrome.");
                    return;
                }

                // Configurar o objeto de reconhecimento de fala
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const recognition = new SpeechRecognition();
                recognition.interimResults = true;
                recognition.lang = 'pt-PT';

                // Evento acionado quando o resultado de reconhecimento de fala é recebido
                recognition.addEventListener('result', e => {
                    const transcript = Array.from(e.results)
                        .map(result => result[0])
                        .map(result => result.transcript)
                        .join('');

                    // Inserir a transcrição no campo de pesquisa
                    $('#searchInput').val(transcript);
                    realizarPesquisa(transcript);
                });

                // Iniciar o reconhecimento de fala ao clicar no botão de microfone
                $('#microphoneBtn').on('click', function () {
                    recognition.start();
                });
            }

            // Chamar a função para configurar o reconhecimento de voz
            iniciarReconhecimentoDeVoz();
        });
    </script>

    <script>
        function adicionarAoCarrinho(nome, preco, imagem, quantidadeInputId, idProduto) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adicionar_ao_carrinho.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log('Produto adicionado ao carrinho com sucesso!');
                    setTimeout(function () {
                        var quantidade = document.getElementById(quantidadeInputId).value;

                        var subtotal_alerta = preco * quantidade;

                        var preco_formatado = new Intl.NumberFormat('pt-PT', { style: 'currency', currency: 'EUR' }).format(preco);
                        var subtotal_alerta_formatado = new Intl.NumberFormat('pt-PT', { style: 'currency', currency: 'EUR' }).format(subtotal_alerta);

                        var confirmationMessage = `
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Preço</th>
                                        <th>Quantidade</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="${imagem}" alt="Imagem do Produto" style="max-width: 100px; max-height: 100px;"></td>
                                        <td>${nome}</td>
                                        <td>${preco_formatado}</td>
                                        <td>${quantidade}</td>
                                        <td>${subtotal_alerta_formatado}</td>
                                    </tr>
                                </tbody>
                            </table>
                        `;

                        document.getElementById('confirmationMessage').innerHTML = confirmationMessage;
                        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                        confirmationModal.show();

                        contar_produtos_carrinho();
                    }, 200);
                } else {
                    console.error('Erro ao adicionar produto ao carrinho.');
                }
            };

            // Alteração: pegar o valor do elemento de entrada de quantidade
            var quantidade = document.getElementById(quantidadeInputId).value;

            // Passa todos os parâmetros necessários para adicionar o produto ao carrinho, incluindo a quantidade
            xhr.send('nome=' + encodeURIComponent(nome) + '&preco=' + encodeURIComponent(preco) + '&imagem=' + encodeURIComponent(imagem) + '&quantidade=' + encodeURIComponent(quantidade)
                + '&id_produto=' + encodeURIComponent(idProduto));
        }
    </script>

    <script>
        function incrementQuantity(inputId) {
            var input = document.getElementById(inputId);
            var value = parseInt(input.value, 10);
            input.value = value + 1;
        }

        function decrementQuantity(inputId) {
            var input = document.getElementById(inputId);
            var value = parseInt(input.value, 10);
            if (value > 1) {
                input.value = value - 1;
            }
        }
    </script>

    <!-- Modal para confirmação de adição ao carrinho -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Produto Adicionado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body" id="confirmationMessage">
                    <!-- Mensagem de confirmação será inserida aqui -->
                </div>
                <div class="modal-footer">
                    <a href="carrinho.php"><button type="button" class="btn btn-primary">Ver carrinho</button></a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar a comprar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <?php require "assets/php/contarTodos.php"; ?>
            <div class="col-lg-6 m-auto">
                <?php echo '<h1 class="h1">Produtos (' . $count . ')</h1>'; ?>
                <p>
                    <a href="index.php">Início</a> /
                    <a href="produtos.php">Produtos</a>
                </p>
            </div>
        </div>
        <?php require "assets/php/mostrarTodos.php"; ?>
        <div class="row">
            <?php
            // Variável para armazenar os produtos agrupados por categoria
            $produtosPorCategoria = array();

            // Agrupar os produtos por categoria
            foreach ($categorias as $categoria) {
                $nomeCategoria = $categoria['nome_categoria'];
                // Adicionar o produto ao array da categoria correspondente
                $produtosPorCategoria[$nomeCategoria][] = $categoria;
            }
            ?>

            <!-- Loop para exibir os produtos agrupados por categoria -->
            <?php foreach ($produtosPorCategoria as $nomeCategoria => $produtosCategoria): ?>
                <div class="row">
                    <div class="col-12">
                        <?php
                        // Contar o número de produtos na categoria atual
                        $numeroProdutosCategoria = count($produtosCategoria);
                        echo '<h1 class="h1">' . $nomeCategoria . ' (' . $numeroProdutosCategoria . ')</h1>';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($produtosCategoria as $produto): ?>
                        <div class="col-12 col-md-4 p-5 mt-3" id="<?php echo 'produto-' . $produto['id_produto']; ?>">
                            <a href="#"><img src="<?php echo $produto['imagem']; ?>"
                                    class="rounded-circle img-fluid border"></a>
                            <h5 class="text-center mt-3 mb-3"><?php echo $produto['nome_produto']; ?>
                                <br><?php echo number_format($produto['preco'], 2, ',', '.'); ?>€
                            </h5> <!-- Adiciona o preço aqui -->
                            <div class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-success me-2"
                                        onclick="adicionarAoCarrinho('<?php echo addslashes($produto['nome_produto']); ?>', '<?php echo addslashes($produto['preco']); ?>', '<?php echo addslashes($produto['imagem']); ?>', '<?php echo 'quantidadeInput_' . addslashes($produto['nome_produto']); ?>','<?php echo addslashes($produto['id_produto']); ?>')">Adicionar
                                        ao carrinho</a>
                                    <div class="input-group" style="width: 134px;">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="decrementQuantity('<?php echo 'quantidadeInput_' . addslashes($produto['nome_produto']); ?>')">-</button>
                                        <input id="<?php echo 'quantidadeInput_' . addslashes($produto['nome_produto']); ?>"
                                            type="number" class="form-control" value="1" min="1">
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="incrementQuantity('<?php echo 'quantidadeInput_' . addslashes($produto['nome_produto']); ?>')">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- End Categories of The Month -->

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