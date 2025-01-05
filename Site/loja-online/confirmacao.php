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

    <!-- Seção do carrinho -->
    <section class="main" id="carrinho">
        <div class="container">
            <br>
            <br>
            <div class="row" id="itensCarrinho">
                <div class="col-md-12">
                    <div class="bg-light p-3 rounded">
                        <h1 class="h1"><strong>Confirmação</strong></h1>
                        <h4>Por favor, antes de finalizar a sua encomenda reveja todos os detalhes e confirme se todos
                            os dados estão corretos.</h4>
                    </div>
                    <br>
                </div>
                <!-- Tabela de itens do carrinho -->
                <div class="col-md-12">
                    <div class="bg-light p-3 rounded">
                        <h1 class="h1"><strong>Detalhes do pedido</strong></h1>
                        <table class="table" id="tabelaCarrinho">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome do Artigo</th>
                                    <th>Preço</th>
                                    <th>Quantidade</th>
                                    <th>Subtotal</th>
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
                                            $quantidade = $produto['quantidade']; // Corrigido para acessar a quantidade corretamente
                                            $id_produto = $produto['id_produto'];

                                            // Verifica se o produto é um aluguer
                                            if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                                // Se for um aluguer, calcula o subtotal com base nas horas
                                                $horas = $produto['horas'];
                                                $subtotal_produto = number_format(floatval($preco) * floatval($quantidade) * floatval($horas), 2, '.', '');
                                            } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                                $total = $produto['totalPrice'];
                                                $subtotal_produto = $total;
                                            } else {
                                                // Se não for um aluguer, calcula o subtotal normalmente
                                                $subtotal_produto = number_format(floatval($preco) * floatval($quantidade), 2, '.', '');
                                            }

                                            // Exibe os detalhes do produto em uma linha da tabela
                                            echo "<tr id='linha_$indice'>";
                                            echo "<td><img src='$imagem' alt='$nome' style='max-width: 100px; max-height: 100px;'></td>";
                                            echo "<td>$nome</td>";
                                            if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                                echo "<td>$preco</td>";
                                            } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                                $dias = floatval($produto['dias']) + 1;
                                                echo "<td>$preco € x $dias (dias)</td>";
                                            } else {
                                                echo "<td>$preco €</td>";
                                            }
                                            echo "<td>$quantidade</td>";
                                            if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                                echo "<td id='total_$indice'>$subtotal_produto</td>";
                                            } else {
                                                echo "<td id='total_$indice'>$subtotal_produto €</td>";
                                            }
                                            // Exibe o total multiplicando o preço pela quantidade
                                            echo "</tr>";

                                            // Adiciona uma linha na tabela Compra_Detalhe para este produto
                                            echo "<input type='hidden' name='quantidade[]' value='$quantidade'>";
                                            echo "<input type='hidden' name='subtotal_produto[]' value='$subtotal_produto'>";
                                            echo "<input type='hidden' name='id_produto[]' value='$id_produto'>";
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
                        <?php if (isset($_SESSION['user_name'])):
                            $redirect_url = 'entrega.php'; ?>
                        <?php else:
                            $redirect_url = 'login.html'; ?>
                        <?php endif; ?>

                        <div style="margin-left: 820px;width:300px;text-align: justify;">
                            <?php
                            function calcularTotalCarrinho($carrinho)
                            {
                                $totalProdutos = 0; // Inicializa o contador de produtos
                                $subtotal = 0;
                                $custosEnvio = 0; // Alterado para 0
                                $totalValor = 0; // Inicializa o totalValor
                            
                                // Se houver produtos no carrinho, calcule o subtotal
                                // Se houver produtos no carrinho, calcule o subtotal
                                if (isset($carrinho) && is_array($carrinho) && count($carrinho) > 0) {
                                    foreach ($carrinho as $produto) {
                                        $quantidade = intval($produto['quantidade']);
                                        $totalProdutos += $quantidade; // Incrementa o contador de produtos
                                        $preco = floatval($produto['preco']);

                                        // Verifica se o produto é um aluguer
                                        if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                            // Se for um aluguer, calcula o subtotal com base nas horas
                                            $horas = floatval($produto['horas']);
                                            $subtotal += $preco * $quantidade * $horas;
                                        } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                            $total = floatval($produto['totalPrice']);
                                            $subtotal += $total;
                                        } else {
                                            // Se não for um aluguer, calcula o subtotal normalmente
                                            $subtotal += $preco * $quantidade;
                                        }
                                    }
                                }


                                // Verificar se o valor total está presente na URL
                                if (isset($_GET['valor_total'])) {
                                    $totalValor = floatval(str_replace(',', '.', $_GET['valor_total'])); // Convertendo para float
                                }

                                // Calculando o IVA com base no subtotal
                                $iva = $totalValor * 0.23;

                                return array(
                                    'totalProdutos' => $totalProdutos,
                                    'subTotal' => number_format($subtotal, 2, ',', '') . ' €',
                                    'custosEnvio' => number_format($custosEnvio, 2, ',', '') . ' €',
                                    'iva' => number_format($iva, 2, ',', '') . ' €',
                                    'totalValor' => number_format($totalValor, 2, ',', '') . ' €',
                                    'total' => number_format($totalValor, 2, ',', '') . ' €'
                                );
                            }

                            // Se houver produtos no carrinho
                            if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                                $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);
                                echo "<p>Total de Produtos: <span style='float:right;' id='totalProdutos'>" . $resumoCarrinho['totalProdutos'] . "</span></p>";
                                echo "<p>Subtotal: <span style='float:right;' id='subTotal'>" . $resumoCarrinho['subTotal'] . "</span></p>";
                                echo "<p>Custos de envio: <span style='float:right;' id='custosEnvio'>" . $resumoCarrinho['custosEnvio'] . "</span></p>";
                                echo "<p>IVA (23%): <span style='float:right;' id='iva'>" . $resumoCarrinho['iva'] . "</span</p>";
                                echo "<p><strong>Total</strong>: <span style='float:right;' id='totalValor'>" . $resumoCarrinho['total'] . "</span></p>"; // Alterado para exibir o total
                            
                                // Campos ocultos para finalizar encomenda
                                echo "<input type='hidden' name='morada_entrega' value=\"" . (isset($_GET['morada_entrega']) ? $_GET['morada_entrega'] : '') . "\">";
                                echo "<input type='hidden' name='id_utilizador' value=\"" . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '') . "\">";
                                echo "<input type='hidden' name='preco_total' value='" . str_replace(',', '.', $resumoCarrinho['total']) . "'>";
                                echo "<input type='hidden' name='tipo_pagamento' value=\"" . (isset($_GET['metodo_pagamento']) ? $_GET['metodo_pagamento'] : '') . "\">";
                                echo "<input type='hidden' name='data_hora' value='" . date('Y-m-d') . "'>";
                            } else {
                                // Se não houver produtos no carrinho, exibe uma mensagem indicando isso
                                echo "<p id='nenhum_produto'>Nenhum produto no carrinho.</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                </div>

                <?php
                // Função para obter parâmetros da URL
                function getParametroURL($parametro)
                {
                    return isset($_GET[$parametro]) ? htmlspecialchars($_GET[$parametro]) : '';
                }

                // Dados de entrega
                $nomeUtilizadorEntrega = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
                $numTelemovelEntrega = isset($_SESSION['user_num_telemovel']) ? $_SESSION['user_num_telemovel'] : '';
                $opcaoEntrega = getParametroURL('opcao_entrega');
                $moradaEntrega = getParametroURL('morada_entrega');

                // Dados de faturação
                $nomeUtilizadorFaturacao = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
                $numTelemovelFaturacao = isset($_SESSION['user_num_telemovel']) ? $_SESSION['user_num_telemovel'] : '';

                // Verificar se o utilizador selecionou a opção de morada de faturação igual à de entrega
                if (empty(getParametroURL('morada_faturacao'))) {
                    $moradaFaturacao = $moradaEntrega;
                } else {
                    $moradaFaturacao = getParametroURL('morada_faturacao');
                }

                // Método de envio
                if (empty(getParametroURL('metodo_envio'))) {
                    $metodoEnvio = "Envio para o parque";
                } else {
                    $metodoEnvio = getParametroURL('metodo_envio');
                }

                // Método de pagamento
                $metodoPagamento = getParametroURL('metodo_pagamento');
                ?>

                <div class="col-md-3">
                    <div class="bg-light p-3 rounded">
                        <h4><strong>Dados de entrega</strong></h4>
                        <p><strong>Nome:</strong> <?php echo $nomeUtilizadorEntrega; ?></p>
                        <p><strong>Número de Telemóvel:</strong> <?php echo $numTelemovelEntrega; ?></p>
                        <p><strong>Opção de Entrega:</strong> <?php echo $opcaoEntrega; ?></p>
                        <p><strong>Morada de Entrega:</strong> <?php echo $moradaEntrega; ?></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="bg-light p-3 rounded">
                        <h4><strong>Dados de faturação</strong></h4>
                        <p><strong>Nome:</strong> <?php echo $nomeUtilizadorFaturacao; ?></p>
                        <p><strong>Número de Telemóvel:</strong> <?php echo $numTelemovelFaturacao; ?></p>
                        <p><strong>Morada de Faturação:</strong> <?php echo $moradaFaturacao; ?></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="bg-light p-3 rounded">
                        <h4><strong>Método de envio</strong></h4>
                        <p><?php echo $metodoEnvio; ?></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="bg-light p-3 rounded">
                        <h4><strong>Método de pagamento</strong></h4>
                        <p><?php echo $metodoPagamento; ?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <br>
                    <div class="d-flex justify-content-between mt-3">
                        <button class='btn btn-secondary' onclick="window.history.back();"><i
                                class='fas fa-arrow-left'></i>
                            Retroceder</button>
                        <form method="post" action="finalizar_encomenda.php">
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
                                        $quantidade = $produto['quantidade']; // Corrigido para acessar a quantidade corretamente
                                        $id_produto = $produto['id_produto'];
                                        $subtotal_produto = number_format(floatval($preco) * $quantidade, 2, '.', '');

                                        // Adiciona uma linha na tabela Compra_Detalhe para este produto
                                        echo "<input type='hidden' name='quantidade[]' value='$quantidade'>";
                                        echo "<input type='hidden' name='subtotal_produto[]' value='$subtotal_produto'>";
                                        echo "<input type='hidden' name='id_produto[]' value='$id_produto'>";
                                    } else {
                                        // Se os dados do produto não estiverem em um formato esperado, imprime uma mensagem de erro
                                        echo "<tr><td colspan='5'>Erro: Dados do produto em um formato inválido.</td></tr>";
                                    }
                                }
                            }

                            // Se houver produtos no carrinho
                            if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                                $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);

                                // Campos ocultos para finalizar encomenda
                                echo "<input type='hidden' name='morada_entrega' value=\"" . (isset($_GET['morada_entrega']) ? $_GET['morada_entrega'] : '') . "\">";
                                echo "<input type='hidden' name='id_utilizador' value=\"" . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '') . "\">";
                                echo "<input type='hidden' name='preco_total' value='" . floatval(str_replace(',', '.', $resumoCarrinho['total'])) . "'>";
                                echo "<input type='hidden' name='tipo_pagamento' value=\"" . (isset($_GET['metodo_pagamento']) ? $_GET['metodo_pagamento'] : '') . "\">";
                                echo "<input type='hidden' name='data_hora' value='" . date('Y-m-d') . "'>";
                            }
                            ?>
                            <button type="submit" class='btn btn-secondary'
                                style='background-color: #3bc0d8; border-color: #3bc0d8;'>Finalizar encomenda <i
                                    class='fas fa-arrow-right'></i></button>
                        </form>
                    </div>
                    <br>
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
    <!-- End Script -->
</body>

</html>