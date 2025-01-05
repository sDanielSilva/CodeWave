<?php
// Inicia a sessão
session_start();


// Verifica se todos os produtos no carrinho são alugueres
$allRentals = true;
foreach ($_SESSION['carrinho'] as $produto) {
    if (!(isset($produto['isRental']) && $produto['isRental'] === "true") && !(isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true")) {
        $allRentals = false;
        break;
    }
}

// Se todos os produtos no carrinho são alugueres, redireciona para o pagamento.php
if ($allRentals) {
    header("Location: pagamento.php");
    exit;
}

// Lista de sintaxes específicas
$bilhete_sintaxes = [
    "Bilhete completo júnior",
    "Bilhete completo normal",
    "Bilhete completo sénior",
    "Bilhete manhã júnior",
    "Bilhete manhã normal",
    "Bilhete manhã sénior",
    "Bilhete tarde júnior",
    "Bilhete tarde normal",
    "Bilhete tarde sénior"
];

$allBilhetes = true;
foreach ($_SESSION['carrinho'] as $produto) {
    $produtoNome = $produto['nome'];
    $produtoIsBilhete = false;

    // Verifica se o nome do produto contém alguma das sintaxes específicas
    foreach ($bilhete_sintaxes as $sintaxe) {
        if (strpos($produtoNome, $sintaxe) !== false) {
            $produtoIsBilhete = true;
            break;
        }
    }

    // Se o produto não for um bilhete, altera a flag para false
    if (!$produtoIsBilhete) {
        $allBilhetes = false;
        break;
    }
}

// Se todos os produtos no carrinho forem bilhetes, redireciona para pagamento.php
if ($allBilhetes) {
    header("Location: pagamento.php");
    exit;
}

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

    <script>
        function mostrarFormularioMorada() {
            document.getElementById("formularioMorada").style.display = "block";
            document.getElementById("metodo_envio").style.display = "block";
        }

        function ocultarFormularioMorada() {
            document.getElementById("formularioMorada").style.display = "none";
            document.getElementById("metodo_envio").style.display = "none";

            // Adicionar a morada à URL sem redirecionar
            var novaURL = "pagamento.php?morada_entrega=R. Cmte. Pinho e Freitas 28, 3750-127 Águeda&opcao_entrega=Levantamento no parque&metodo_envio=";

            // Mudar o href do botão para a nova URL
            document.getElementById("redirecionar_pagamento").setAttribute("href", novaURL);
        }

        var moradaGuardada = false; // Variável para controlar se a morada foi guardada

        function verificarSelecao() {
            // Verificar se o radio button de entrega na morada está selecionado
            var moradaChecked = document.getElementById("morada").checked;

            // Verificar se o radio button de entrega no parque está selecionado
            var parqueChecked = document.getElementById("parque").checked;

            // Se nenhum dos radio buttons estiver selecionado, exibir mensagem de erro
            if (!moradaChecked && !parqueChecked) {
                alert("Por favor, selecione uma opção de entrega.");
                return false;
            }

            // Se o radio button de entrega na morada estiver selecionado,
            // é necessário preencher o input da morada de entrega e selecionar a transportadora
            if (moradaChecked) {
                var moradaEntrega = document.getElementById("morada_entrega").value.trim();
                if (moradaEntrega === "") {
                    alert("Por favor, preencha o campo da morada de entrega.");
                    return false;
                }

                // Verificar se o radio button da transportadora está selecionado
                var transportadoraChecked = document.getElementById("transportadora_codewave").checked;
                if (!transportadoraChecked) {
                    alert("Por favor, selecione uma transportadora.");
                    return false;
                }

                // Verificar se a morada foi guardada
                if (!moradaGuardada) {
                    alert("Por favor, guarde a morada antes de prosseguir.");
                    return false;
                }
            }

            // Se tudo estiver correto, retornar true para permitir o envio do formulário
            return true;
        }

        function adicionarDadosAoPagamento() {
            // Pegar a morada de entrega do campo de input
            var moradaEntrega = document.getElementById("morada_entrega").value.trim();

            // Verificar se o campo de morada está vazio
            if (moradaEntrega === "") {
                // Se estiver vazio, exibir uma mensagem de erro e retornar false para evitar o comportamento padrão do link
                alert("Por favor, preencha o campo de morada antes de guardar a mesma.");
                return false;
            }

            // Definir a opção de entrega com base na morada
            var opcaoEntrega = "Entrega numa morada";

            var metodoEnvio = "Transportadora CodeWave";

            // Adicionar a morada à URL sem redirecionar
            var novaURL = "pagamento.php?morada_entrega=" + encodeURIComponent(moradaEntrega) + "&opcao_entrega=" + encodeURIComponent(opcaoEntrega) + "&metodo_envio=" + encodeURIComponent(metodoEnvio);

            // Mudar o href do botão para a nova URL
            document.getElementById("redirecionar_pagamento").setAttribute("href", novaURL);

            // Exibir um alerta para informar o utilizador que a morada foi guardada com sucesso
            alert("Morada " + moradaEntrega + " guardada com sucesso!");

            // Atualizar a variável que indica se a morada foi guardada
            moradaGuardada = true;

            // Retornar false para evitar o comportamento padrão de redirecionamento do link
            return false;
        }
    </script>

    <!-- Seção do carrinho -->
    <section class="main" id="carrinho">
        <div class="container">
            <br>
            <br>
            <div class="row" id="itensCarrinho">
                <div class="col-md-8">
                    <div class="bg-light p-3 rounded">
                        <h1 class="h1"><strong>Entrega</strong></h1>
                        <br>
                        <h3>Selecione uma das seguintes opções de entrega:</h3>

                        <input type="radio" id="morada" name="encomenda" value="MORADA"
                            onclick="mostrarFormularioMorada()">
                        <label class="me-5" for="morada">&nbsp;Receber a encomenda numa morada</label>
                        <input type="radio" id="parque" name="encomenda" value="PARQUE"
                            onclick="ocultarFormularioMorada()">
                        <label for="parque">&nbsp;Levantar a encomenda no parque</label>

                        <!-- Formulário de morada -->
                        <div id="formularioMorada" style="display: none;">
                            <br>
                            <h3>Dados da morada:</h3>
                            <form>
                                <input type="text" id="morada_entrega" name="morada_entrega" style='width: 600px;'>
                                <button id="guardar_morada" onclick="return adicionarDadosAoPagamento()"
                                    style='background-color: green;'>Guardar Morada</button>
                            </form>
                        </div>

                        <div id="metodo_envio" style="display: none;">
                            <br>
                            <h3>Método de envio:</h3>
                            <input type="radio" id="transportadora_codewave" name="envio" value="codewave"
                                onclick="mostrarFormularioMorada()">
                            <label for="transportadora_codewave">&nbsp;Transportadora CodeWave - entrega
                                entre 2 a 3 dias úteis (gratuito)</label><br>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href='carrinho.php'><button class='btn btn-secondary'><i class='fas fa-arrow-left'></i>
                                    Carrinho</button></a>
                            <a id="redirecionar_pagamento" href='pagamento.php'
                                onclick="return verificarSelecao();"><button class='btn btn-secondary'
                                    style='background-color: #3bc0d8; border-color: #3bc0d8;'>Seguinte <i
                                        class='fas fa-arrow-right'></i></button></a>
                        </div>
                    </div>
                </div>
                <!-- Resumo do carrinho -->
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded">
                        <h1 class="h1"><strong>Resumo</strong></h1>
                        <?php
                        // Função para calcular o total do carrinho
                        function calcularTotalCarrinho($carrinho)
                        {
                            $totalProdutos = 0; // Inicializa o contador de produtos
                            $total = 0;
                            foreach ($carrinho as $produto) {
                                $quantidade = intval($produto['quantidade']);
                                $totalProdutos += $quantidade; // Incrementa o contador de produtos
                                $preco = floatval($produto['preco']);
                                if (isset($produto['isRental']) && $produto['isRental'] === "true" && isset($produto['horas'])) {
                                    $horas = floatval($produto['horas']);
                                    $total += $preco * $horas * $quantidade;
                                } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                    $total += floatval($produto['totalPrice']);
                                } else {
                                    $total += $preco * $quantidade;
                                }
                            }
                            return array('totalProdutos' => $totalProdutos, 'totalValor' => number_format($total, 2, ',', ''));
                        }
                        ?>

                        <?php
                        // Se houver produtos no carrinho
                        if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                            $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);
                            echo "<p>Total de Produtos: " . $resumoCarrinho['totalProdutos'] . "</p>";
                            echo "<p>Total: " . $resumoCarrinho['totalValor'] . " €</p>";
                        } else {
                            // Se não houver produtos no carrinho, exibe uma mensagem indicando isso
                            echo "<p>Nenhum produto no carrinho.</p>";
                        }
                        ?>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="bg-light p-3 rounded">
                            <h1 class="h1"><strong>Detalhes</strong></h1>
                            <?php
                            // Se houver produtos no carrinho
                            if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                                foreach ($_SESSION['carrinho'] as $produto) {
                                    // Certifique-se de que $produto é um array antes de tentar acessar seus elementos
                                    if (is_array($produto)) {
                                        // Recupera os dados do produto
                                        $nome = $produto['nome'];
                                        $preco = $produto['preco'];
                                        $imagem = $produto['imagem'];
                                        $quantidade = $produto['quantidade']; // Corrigido para acessar a quantidade corretamente
                            
                                        // Verifica se o produto é um aluguer
                                        if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                            // Exibe um aviso se o produto é um aluguer
                                            echo "<p><strong>Aviso:</strong> O produto '$nome' é apenas para aluguer e deve ser levantado junto de um funcionário, no parque.</p>";
                                        } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                            // Exibe um aviso se o produto é um aluguer
                                            echo "<p><strong>Aviso:</strong> O produto '$nome' é apenas uma reserva de alojamento e deve ser levantada junto de um funcionário, no parque.</p>";
                                        }

                                        // Exibe os detalhes do produto em parágrafos separados
                                        echo "<div class='row mb-3'>";
                                        echo "<div class='col-md-3'>";
                                        echo "<img src='$imagem' alt='$nome' style='width: 90px; height: 90px;'>";
                                        echo "</div>";
                                        echo "<div class='col-md-9'>";
                                        echo "<strong>&nbsp;&nbsp;&nbsp;Nome:</strong> $nome<br>";
                                        echo "<strong>&nbsp;&nbsp;&nbsp;Quantidade:</strong> $quantidade<br>";
                                        // Verifica se o produto é um aluguer
                                        if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                            // Se for um aluguer, exibe as horas e calcula o total
                                            $horas = $produto['horas'];
                                            echo "<strong>&nbsp;&nbsp;&nbsp;Horas:</strong> $horas<br>";
                                            echo "<strong>&nbsp;&nbsp;&nbsp;Total:</strong> " . number_format(floatval($preco) * floatval($quantidade) * floatval($horas), 2, ',', '') . " €";
                                        } else if (isset($produto['isAlojamento']) && $produto['isAlojamento'] === "true") {
                                            $dias = $produto['dias'] + 1;
                                            $total = $produto['totalPrice'];
                                            echo "<strong>&nbsp;&nbsp;&nbsp;Dias:</strong> $dias<br>";
                                            echo "<strong>&nbsp;&nbsp;&nbsp;Total:</strong> " . $total;
                                        } else {
                                            // Se não for um aluguer, exibe o total normalmente
                                            echo "<strong>&nbsp;&nbsp;&nbsp;Total:</strong> " . number_format(floatval($preco) * floatval($quantidade), 2, ',', '') . " €";
                                        }
                                        echo "</div>";
                                        echo "</div>";
                                    } else {
                                        // Se os dados do produto não estiverem em um formato esperado, imprime uma mensagem de erro
                                        echo "<p>Erro: Dados do produto em um formato inválido.</p>";
                                    }
                                }
                            } else {
                                // Se não houver produtos no carrinho, exibe uma mensagem indicando isso
                                echo "<p>Nenhum produto no carrinho.</p>";
                            }
                            ?>
                        </div>
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
    <!-- End Script -->
</body>

</html>