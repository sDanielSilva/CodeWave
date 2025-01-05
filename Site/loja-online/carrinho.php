<?php
// Inicia a sessão
session_start();


?>
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
    <link rel="stylesheet" type="text/css" href="../css/owl.carousel.css" />
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

    <!-- Script para limpar o carrinho -->
    <script>
        function limparCarrinho() {
            // Exibe uma mensagem de confirmação
            var confirmacao = confirm("Tem a certeza que deseja limpar o carrinho? Esta ação não pode ser desfeita.");
            if (confirmacao) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'limpar_carrinho.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log('Carrinho limpo com sucesso!');
                        // Recarrega a página para refletir as mudanças
                        window.location.reload();
                    } else {
                        console.error('Erro ao limpar carrinho.');
                    }
                };
                // Envia a solicitação para limpar o carrinho
                xhr.send();
            }
        }
    </script>

    <script>
        function atualizarQuantidadeCarrinho(indice, novaQuantidade) {
            $.ajax({
                type: "POST",
                url: "atualizar_quantidade_carrinho.php",
                data: {
                    indice: indice,
                    novaQuantidade: novaQuantidade
                },
                dataType: "json",
                success: function (response) {
                    // Atualizar o resumo do carrinho com os novos totais
                    $('#totalProdutos').text(response.totalProdutos);
                    $('#totalValor').text(response.totalValor);
                }
            });
        }

        // Função para atualizar o total quando a quantidade é alterada
        function atualizarTotal(indice, preco, isRental, isAlojamento, horas) {

            console.log(isRental);
            var input = document.getElementById('quantidadeInput_' + indice);
            var novaQuantidade = parseInt(input.value);
            var isRental = input.dataset.isRental === 'true';
            var isAlojamento = input.dataset.isAlojamento === 'true';
            var horas = parseFloat(input.dataset.horas);
            var dias = parseFloat(input.dataset.dias);
            if (novaQuantidade < 1 || isNaN(novaQuantidade)) {
                novaQuantidade = 1;
            }
            // Atualizar a quantidade no carrinho
            atualizarQuantidadeCarrinho(indice, novaQuantidade);
            var novoTotal;
            if (isRental) {
                novoTotal = novaQuantidade * preco * horas;
            } else if (isAlojamento) {
                novoTotal = novaQuantidade * preco * dias;
            } else {
                novoTotal = novaQuantidade * preco;
            }
            // Formatando o novo total com vírgula em vez de ponto
            var totalFormatado = novoTotal.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ' €';

            // Atualizar o total do produto na linha da tabela
            document.getElementById('total_' + indice).innerHTML = totalFormatado;

            // Recalcular e atualizar o resumo do carrinho
            atualizarResumoCarrinho();
        }


        // Função para atualizar o resumo do carrinho
        function atualizarResumoCarrinho() {
            $.ajax({
                type: "GET",
                url: "atualizar_resumo_carrinho.php",
                dataType: "json",
                success: function (response) {
                    if (response.totalProdutos > 0) {
                        // Atualizar o resumo do carrinho com os novos totais
                        document.getElementById('totalProdutos').innerHTML = response.totalProdutos;
                        document.getElementById('totalValor').innerHTML = response.totalValor;
                    } else {
                        document.getElementById('totalProdutos').innerHTML = '0';
                        document.getElementById('totalValor').innerHTML = '00,00';
                        document.getElementById('proceder_checkout').style.display = 'none';
                    }
                }
            });
        }



        // Em seguida, na sua função incrementQuantity, você pode acessar essas informações
        function incrementQuantity(indice, preco) {

            var input = document.getElementById('quantidadeInput_' + indice);
            var quantidade = parseInt(input.value);
            var isRental = input.dataset.isRental === 'true';
            var isAlojamento = input.dataset.isAlojamento === 'true';
            var horas = parseFloat(input.dataset.horas);
            if (!isNaN(quantidade)) {
                input.value = quantidade + 1;
                var isRental = input.dataset.isRental === 'true';
                var isAlojamento = input.dataset.isAlojamento === 'true';
                var horas = parseFloat(input.dataset.horas);
                atualizarTotal(indice, preco, isRental, isAlojamento, horas);
            }
            contar_produtos_carrinho();
        }


        // Função para decrementar a quantidade
        function decrementQuantity(indice, preco) {
            var input = document.getElementById('quantidadeInput_' + indice);
            var quantidade = parseInt(input.value);
            var isRental = input.dataset.isRental === 'true';
            var isAlojamento = input.dataset.isAlojamento === 'true';
            var horas = parseFloat(input.dataset.horas);
            if (!isNaN(quantidade) && quantidade > 1) {
                input.value = quantidade - 1;
                var isRental = input.dataset.isRental === 'true';
                var isAlojamento = input.dataset.isAlojamento === 'true';
                var horas = parseFloat(input.dataset.horas);
                atualizarTotal(indice, preco, isRental, isAlojamento, horas);

            }
            contar_produtos_carrinho();
        }

        // Função para remover um item do carrinho
        function removerItemCarrinho(indice) {
            // Exibe uma mensagem de confirmação
            var confirmacao = confirm("Tem certeza que deseja remover este item do carrinho?");
            if (confirmacao) {
                atualizarResumoCarrinho();
                document.getElementById('linha_' + indice).remove();
                atualizarResumoCarrinho();
                $.ajax({
                    type: "POST",
                    url: "remover_item_carrinho.php",
                    data: {
                        remover_indice: indice
                    },
                    dataType: "json",
                    success: function (response) {
                        // Atualiza o resumo do carrinho com os novos totais
                        $('#totalProdutos').text(response.totalProdutos);
                        $('#totalValor').text(response.totalValor);
                        // Remove a linha correspondente da tabela
                        $('#linha_' + indice).remove();
                    }
                });
            }
            contar_produtos_carrinho();
        }
    </script>

    <section id="produtos_slider">
        <div class="demo">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="testimonial-slider" class="owl-carousel">
                            <?php require 'assets/php/sliderProdutosAleatorios.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Adicione os scripts do Owl Carousel -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#testimonial-slider").owlCarousel({
                items: 4,
                itemsDesktop: [1000, 3],
                itemsDesktopSmall: [980, 2],
                itemsTablet: [768, 2],
                itemsMobile: [650, 1],
                pagination: true,
                navigation: false,
                slideSpeed: 1000,
                autoPlay: true
            });
        });

        function redirectToCategory(productId) {
            var url = 'produtos.php#' + productId;
            window.location.href = url;
        }
    </script>


    <!-- Seção do carrinho -->
    <section class="main" id="carrinho">
        <div class="container">
            <div class="row" id="itensCarrinho">
                <!-- Tabela de itens do carrinho -->
                <div class="col-md-8">
                    <div class="bg-light p-3 rounded">
                        <h1 class="h1"><strong>Carrinho de compras</strong></h1>
                        <table class="table" id="tabelaCarrinho">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome do Artigo</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Se houver produtos no carrinho
                                if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                                    foreach ($_SESSION['carrinho'] as $indice => $produto) {
                                        // Certifique-se de que $produto é um array antes de tentar acessar seus elementos
                                        if (is_array($produto)) {
                                            // Recupera os dados do produto
                                            $nome = $produto['nome'];
                                            $preco = $produto['preco'];
                                            $imagem = $produto['imagem'];
                                            $quantidade = $produto['quantidade'];



                                            // Exibe os detalhes do produto em uma linha da tabela
                                            echo "<tr id='linha_$indice'>";
                                            echo "<td><img src='$imagem' alt='$nome' style='max-width: 100px; max-height: 100px;'></td>";
                                            echo "<td>$nome</td>";


                                            if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                                echo "<td>$preco</td>";
                                                echo "<td>$quantidade </td>";
                                            } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                                $dias = floatval($produto['dias']) + 1;  // Supondo que você tenha a quantidade de dias disponível
                                                echo "<td>$preco € x $dias (dias)</td>";  // Exibe o preço e a quantidade de dias
                                                echo "<td>$quantidade </td>";
                                            } else {
                                                echo "<td>$preco €</td>";
                                                $isRental = isset($produto['isRental']) && $produto['isRental'] === "true" ? 'true' : 'false';
                                                $horas = isset($produto['horas']) ? $produto['horas'] : '0';
                                                echo "<td>
                                                        <div class='input-group' style='width: 150px;'>
                                                            <button class='btn btn-outline-secondary' type='button' onclick='decrementQuantity($indice, $preco, )'>-</button>
                                                            <input id='quantidadeInput_$indice' name='quantidade[$indice]' type='number' class='form-control' value='$quantidade' min='1' onchange='atualizarTotal($indice, $preco, $isRental, $horas)' data-is-rental='$isRental' data-horas='$horas'>
                                                            <button class='btn btn-outline-secondary' type='button' onclick='incrementQuantity($indice, $preco, $isRental, $horas)'>+</button>
                                                        </div>
                                                      </td>";
                                            }

                                            // Coluna de quantidade com botões de incremento e decremento
                                            if (isset($produto['isRental']) && $produto['isRental'] === "true" && isset($produto['horas'])) {
                                                $preco = floatval($produto['preco']);
                                                $horas = floatval($produto['horas']);
                                                echo "<td id='total_$indice'>" . number_format($preco * $horas * $quantidade, 2, ',', '') . " €</td>";
                                            } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                                echo "<td id='total_$indice'>" . $produto['totalPrice'] . "</td>";  // Exibe o preço total armazenado na sessão
                                            } else {
                                                echo "<td id='total_$indice'>" . number_format($preco * $quantidade, 2, ',', '') . " €</td>";
                                            }                                            // Exibe o total multiplicando o preço pela quantidade
                                            echo "<td><button class='btn btn-danger' onclick='removerItemCarrinho($indice)'><i style='font-size: 10px;'></i>X</button></td>";
                                            echo "</tr>";
                                        } else {
                                            // Se os dados do produto não estiverem em um formato esperado, imprime uma mensagem de erro
                                            echo "<tr><td colspan='5'>Erro: Dados do produto em um formato inválido.</td></tr>";
                                        }
                                    }
                                } else {
                                    // Se não houver produtos no carrinho, exibe uma mensagem indicando isso
                                    echo "<tr id='nenhum_produto'><td colspan='5'>Nenhum produto no carrinho.</td></tr>";
                                }

                                ?>
                            </tbody>
                        </table>
                        <!-- Botão para limpar o carrinho -->
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-danger" onclick="limparCarrinho()"><i class="fa fa-fw fa-trash"
                                        style="font-size: 20px;"></i>Limpar Carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumo do carrinho -->
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded" id="resumoCarrinho">
                        <h1 class="h1"><strong>Resumo</strong></h1>
                        <?php if (isset($_SESSION['user_name'])):
                            $redirect_url = 'entrega.php'; ?>
                        <?php else:
                            $redirect_url = 'login.html'; ?>
                        <?php endif; ?>

                        <?php
                        // Função para calcular o total do carrinho
                        
                        function calcularTotalCarrinho($carrinho)
                        {
                            $totalProdutos = 0; // Inicializa o contador de produtos
                            $total = 0;
                            foreach ($carrinho as $produto) {
                                $quantidade = intval($produto['quantidade']);
                                $totalProdutos += $quantidade; // Incrementa o contador de produtos
                                if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                    // Se o produto é um alojamento, usa o preço total armazenado na sessão
                                    $total += floatval(str_replace("€", "", $produto['totalPrice']));
                                } else if (isset($produto['isRental']) && $produto['isRental'] === "true" && isset($produto['horas'])) {
                                    $preco = floatval($produto['preco']);
                                    $horas = floatval($produto['horas']);
                                    $total += $preco * $horas * $quantidade;
                                } else {
                                    $preco = floatval($produto['preco']);
                                    $total += $preco * $quantidade;
                                }
                            }
                            return array('totalProdutos' => $totalProdutos, 'totalValor' => number_format($total, 2, ',', ''));
                        }



                        // Se houver produtos no carrinho
                        if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                            $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);
                            echo "<p>Total de Produtos: <span id='totalProdutos'>" . $resumoCarrinho['totalProdutos'] . "</span></p>";
                            echo "<p>Total: <span id='totalValor'>" . $resumoCarrinho['totalValor'] . "</span> €</p>";
                            echo "<div class='mt-3'>";
                            echo "<a href='$redirect_url'><button id='proceder_checkout' class='btn btn-primary' style='background-color: #3bc0d8; border-color: #3bc0d8;'>Proceder ao Checkout <i class='fas fa-arrow-right'></i></button></a>";
                            echo "</div>";
                        } else {
                            // Se não houver produtos no carrinho, exibe uma mensagem indicando isso
                            echo "<p id='nenhum_produto'>Nenhum produto no carrinho.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br>
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
    <script src="../js/owl.carousel.min.js"></script>
    <!-- End Script -->
</body>

</html>