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

// Se todos os produtos no carrinho são alugueres, oculta a pergunta e as opções de resposta
if ($allRentals) {
    echo "<style>#questionDiv { display: none; }</style>";
    echo "<script>window.onload = function() { mostrarFormularioDadosFaturacaoNao(); }</script>";
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
    echo "<style>#questionDiv { display: none; }</style>";
    echo "<script>window.onload = function() { mostrarFormularioDadosFaturacaoNao(); }</script>";
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
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
                <a class="navbar-brand" href="../../Site/index.php"><img src="assets/img/logo2.png" style="margin-left: -50px;height: 50px" alt="logo" /></a>
            </div>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php require "assets/php/mostrarCategorias.php"; ?>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
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
                            <i class="fa fa-fw fa-user text-dark me-5" style="font-size: 25px;"><span class="arrow">&#9660;</span></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                        </a>
                        <div class="dropdown-content">
                            <?php if (isset($_SESSION['user_name'])) : ?>
                                <a href="perfil.php"><?php echo $_SESSION['user_name']; ?></a>
                                <a href="./fecharSessao.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                            <?php else : ?>
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


        <a href="../../Site/bilhetes.php" class="destaque-bilhetes"><img src="./assets/img/tickets-ticket-svgrepo-com.svg" alt="Tickets">Bilhetes Online</a>


        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="CodeWave"
  agent-id="7608ed60-5ee5-4799-a4fb-786a5e86e2d5"
  language-code="pt"
></df-messenger>
    </section>

    <script>
        function mostrarFormularioDadosFaturacaoSim() {
            var morada_entrega = "<?php echo isset($_GET['morada_entrega']) ? $_GET['morada_entrega'] : ''; ?>";
            var opcao_entrega = "<?php echo isset($_GET['opcao_entrega']) ? $_GET['opcao_entrega'] : ''; ?>";
            var metodo_envio = "<?php echo isset($_GET['metodo_envio']) ? $_GET['metodo_envio'] : ''; ?>";
            var totalCarrinhoString = document.getElementById("totalValor").innerText;

            document.getElementById("formularioDadosFaturacaoSim").style.display = "block";
            document.getElementById("formularioDadosFaturacaoNao").style.display = "none";
            document.getElementById("metodo_pagamento").style.display = "block";

            var mbwayChecked = document.getElementById("mbway").checked;
            var cartaoCreditoChecked = document.getElementById("cartao_credito").checked;
            var multibancoChecked = document.getElementById("multibanco").checked;

            // Inicializar a variável novaURL com os parâmetros existentes do URL
            var novaURL = "confirmacao.php";

            // Adicionar os parâmetros existentes do URL à novaURL
            novaURL += "?morada_entrega=" + encodeURIComponent(morada_entrega);
            novaURL += "&opcao_entrega=" + encodeURIComponent(opcao_entrega);
            novaURL += "&metodo_envio=" + encodeURIComponent(metodo_envio);
            novaURL += "&morada_faturacao=";

            // Se o método de pagamento MBWay estiver selecionado, adicionar o parâmetro ao URL
            if (mbwayChecked) {
                novaURL += "&metodo_pagamento=MB WAY";
                novaURL += "&valor_total=" + encodeURIComponent(totalCarrinhoString);
            }

            if (cartaoCreditoChecked) {
                novaURL += "&metodo_pagamento=Cartão de Crédito";
                novaURL += "&valor_total=" + encodeURIComponent(totalCarrinhoString);
            }

            if (multibancoChecked) {
                novaURL += "&metodo_pagamento=Multibanco";
                novaURL += "&valor_total=" + encodeURIComponent(totalCarrinhoString);
            }

            // Mudar o href do botão para a nova URL
            document.getElementById("redirecionar_confirmacao").setAttribute("href", novaURL);
        }


        function mostrarFormularioDadosFaturacaoNao() {
            var morada_entrega = "<?php echo isset($_GET['morada_entrega']) ? $_GET['morada_entrega'] : ''; ?>";
            var opcao_entrega = "<?php echo isset($_GET['opcao_entrega']) ? $_GET['opcao_entrega'] : ''; ?>";
            var metodo_envio = "<?php echo isset($_GET['metodo_envio']) ? $_GET['metodo_envio'] : ''; ?>";
            var totalCarrinhoString = document.getElementById("totalValor").innerText;

            document.getElementById("formularioDadosFaturacaoNao").style.display = "block";
            document.getElementById("formularioDadosFaturacaoSim").style.display = "none";
            document.getElementById("metodo_pagamento").style.display = "block";

            var mbwayChecked = document.getElementById("mbway").checked;
            var cartaoCreditoChecked = document.getElementById("cartao_credito").checked;
            var multibancoChecked = document.getElementById("multibanco").checked;

            // Inicializar a variável novaURL com os parâmetros existentes do URL
            var novaURL = "confirmacao.php";

            var morada_faturacao = document.getElementById("dados_faturacao_nao").value.trim();

            // Adicionar os parâmetros existentes do URL à novaURL
            novaURL += "?morada_entrega=" + encodeURIComponent(morada_entrega);
            novaURL += "&opcao_entrega=" + encodeURIComponent(opcao_entrega);
            novaURL += "&metodo_envio=" + encodeURIComponent(metodo_envio);
            novaURL += "&morada_faturacao=" + encodeURIComponent(morada_faturacao);

            // Se o método de pagamento MBWay estiver selecionado, adicionar o parâmetro ao URL
            if (mbwayChecked) {
                novaURL += "&metodo_pagamento=MB WAY";
                novaURL += "&valor_total=" + encodeURIComponent(totalCarrinhoString);
            }

            if (cartaoCreditoChecked) {
                novaURL += "&metodo_pagamento=Cartão de Crédito";
                novaURL += "&valor_total=" + encodeURIComponent(totalCarrinhoString);
            }

            if (multibancoChecked) {
                novaURL += "&metodo_pagamento=Multibanco";
                novaURL += "&valor_total=" + encodeURIComponent(totalCarrinhoString);
            }

            // Mudar o href do botão para a nova URL
            document.getElementById("redirecionar_confirmacao").setAttribute("href", novaURL);
        }

        function mostrar_dados_mbway() {
            document.getElementById("pagamento_mbway").style.display = "block";
            document.getElementById("pagamento_cartao_credito").style.display = "none";
            mostrarFormularioDadosFaturacaoSim();
            mostrarFormularioDadosFaturacaoNao();

            var simChecked = document.getElementById("sim").checked;
            var naoChecked = document.getElementById("nao").checked;

            // Se a opção de faturação "Sim" estiver selecionada, verificar se o campo está preenchido
            if (simChecked) {
                document.getElementById("formularioDadosFaturacaoSim").style.display = "block";
                document.getElementById("formularioDadosFaturacaoNao").style.display = "none";
            } else {
                document.getElementById("formularioDadosFaturacaoSim").style.display = "none";
                document.getElementById("formularioDadosFaturacaoNao").style.display = "block";
            }
        }

        function mostrar_dados_cartao_credito() {
            document.getElementById("pagamento_cartao_credito").style.display = "block";
            document.getElementById("pagamento_mbway").style.display = "none";
            mostrarFormularioDadosFaturacaoSim();
            mostrarFormularioDadosFaturacaoNao();

            var simChecked = document.getElementById("sim").checked;
            var naoChecked = document.getElementById("nao").checked;

            // Se a opção de faturação "Sim" estiver selecionada, verificar se o campo está preenchido
            if (simChecked) {
                document.getElementById("formularioDadosFaturacaoSim").style.display = "block";
                document.getElementById("formularioDadosFaturacaoNao").style.display = "none";
            } else {
                document.getElementById("formularioDadosFaturacaoSim").style.display = "none";
                document.getElementById("formularioDadosFaturacaoNao").style.display = "block";
            }
        }

        function mostrar_dados_multibanco() {
            document.getElementById("pagamento_mbway").style.display = "none";
            document.getElementById("pagamento_cartao_credito").style.display = "none";
            mostrarFormularioDadosFaturacaoSim();
            mostrarFormularioDadosFaturacaoNao();

            var simChecked = document.getElementById("sim").checked;
            var naoChecked = document.getElementById("nao").checked;

            // Se a opção de faturação "Sim" estiver selecionada, verificar se o campo está preenchido
            if (simChecked) {
                document.getElementById("formularioDadosFaturacaoSim").style.display = "block";
                document.getElementById("formularioDadosFaturacaoNao").style.display = "none";
            } else {
                document.getElementById("formularioDadosFaturacaoSim").style.display = "none";
                document.getElementById("formularioDadosFaturacaoNao").style.display = "block";
            }
        }

        function verificarSelecao() {
            // Verificar se a opção de faturação está selecionada
            var simChecked = document.getElementById("sim").checked;
            var naoChecked = document.getElementById("nao").checked;

            <?php
            // Se todos os produtos no carrinho são alugueres, pule a verificação de seleção de morada de faturação
            if (!$allRentals && !$allBilhetes) {
            ?>
                if (!simChecked && !naoChecked) {
                    alert("Por favor, selecione uma opção para a morada de faturação.");
                    return false;
                }
            <?php
            }
            ?>

            // Se a opção de faturação "Sim" estiver selecionada, verificar se o campo está preenchido
            if (simChecked) {
                var dadosFaturacaoSim = document.getElementById("dados_faturacao_sim").value.trim();
                if (dadosFaturacaoSim === "") {
                    alert("Por favor, preencha o campo de morada de faturação.");
                    return false;
                }
            }

            // Se a opção de faturação "Não" estiver selecionada, verificar se o campo está preenchido
            if (naoChecked) {
                var dadosFaturacaoNao = document.getElementById("dados_faturacao_nao").value.trim();
                if (dadosFaturacaoNao === "") {
                    alert("Por favor, preencha o campo de morada de faturação.");
                    return false;
                }
            }

            // Verificar se o método de pagamento foi selecionado
            var mbwayChecked = document.getElementById("mbway").checked;
            var cartaoCreditoChecked = document.getElementById("cartao_credito").checked;
            var multibancoChecked = document.getElementById("multibanco").checked;

            if (!mbwayChecked && !cartaoCreditoChecked && !multibancoChecked) {
                alert("Por favor, selecione um método de pagamento.");
                return false;
            }

            // Se o método de pagamento for MB WAY, verificar se os campos estão preenchidos
            if (mbwayChecked) {
                var indicativoMbway = document.getElementById("indicativo_mbway").value.trim();
                var numeroMbway = document.getElementById("numero_mbway").value.trim();
                if (indicativoMbway === "" || numeroMbway === "") {
                    alert("Por favor, preencha todos os campos do MB WAY.");
                    return false;
                }
            }

            // Se o método de pagamento for Cartão de Crédito, verificar se os campos estão preenchidos
            if (cartaoCreditoChecked) {
                var nomeCartaoCredito = document.getElementById("nome_cartao_credito").value.trim();
                var numeroCartaoCredito = document.getElementById("numero_cartao_credito").value.trim();
                var mesValidadeCartaoCredito = document.getElementById("mes_validade_cartao_credito").value.trim();
                var anoValidadeCartaoCredito = document.getElementById("ano_validade_cartao_credito").value.trim();
                var cvvCartaoCredito = document.getElementById("cvv_cartao_credito").value.trim();

                // Verificar se todos os campos foram preenchidos
                if (nomeCartaoCredito === "" || numeroCartaoCredito === "" || cvvCartaoCredito === "") {
                    alert("Por favor, preencha todos os campos do Cartão de Crédito.");
                    return false;
                }

                // Verificar se o número do cartão tem 16 dígitos
                if (numeroCartaoCredito.length !== 16) {
                    alert("O número do cartão de crédito deve conter exatamente 16 dígitos.");
                    return false;
                }

                // Verificar se o CVV tem 3 dígitos
                if (cvvCartaoCredito.length !== 3) {
                    alert("O CVV do cartão de crédito deve conter exatamente 3 dígitos.");
                    return false;
                }

                // Verificar se tanto o mês quanto o ano da validade foram selecionados
                if (mesValidadeCartaoCredito === "" || anoValidadeCartaoCredito === "") {
                    alert("Por favor, selecione o mês e o ano da validade do cartão de crédito.");
                    return false;
                }
            }

            // Se tudo estiver correto, retornar true para permitir o envio do formulário
            return true;
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
                        <h1 class="h1"><strong>Pagamento</strong></h1>
                        <br>


                        <div id="questionDiv">
                            <h3 id="question">Morada de faturação igual à morada de entrega?</h3>

                            <input type="radio" id="sim" name="faturacao" value="SIM" onclick="mostrarFormularioDadosFaturacaoSim()">
                            <label class="me-5" for="sim"> Sim</label>
                            <input type="radio" id="nao" name="faturacao" value="NAO" onclick="mostrarFormularioDadosFaturacaoNao()">
                            <label for="nao"> Não, novos dados de faturação</label>

                        </div>



                        <!-- Formulário de morada -->
                        <div id="formularioDadosFaturacaoSim" style="display: none;">
                            <br>
                            <h3>Morada de faturação:</h3>
                            <form>
                                <input type="text" id="dados_faturacao_sim" name="dados_faturacao_sim" value="<?php echo isset($_GET['morada_entrega']) ? $_GET['morada_entrega'] : ''; ?>" style='width: 600px;'>
                            </form>
                        </div>

                        <div id="formularioDadosFaturacaoNao" style="display: none;">
                            <br>
                            <h3>Morada de faturação:</h3>
                            <form>
                                <input type="text" id="dados_faturacao_nao" name="dados_faturacao_nao" style='width: 600px;'>
                            </form>
                        </div>

                        <div id="metodo_pagamento" style="display: none;">
                            <br>
                            <h3>Selecione o método de pagamento:</h3>
                            <input type="radio" id="mbway" name="pagamento" value="MBWAY" onclick="mostrar_dados_mbway()">
                            <label class="me-2" for="mbway">&nbsp;MB WAY</label><img src="assets/img/mbway.png" style="width: 80px; height: 50px;" alt="">
                            <input class="ms-5" type="radio" id="cartao_credito" name="pagamento" value="CARTAO_CREDITO" onclick="mostrar_dados_cartao_credito()">
                            <label class="me-2" for="cartao_credito">&nbsp;Cartão de Crédito</label><img src="assets/img/cartao_credito.png" style="width: 100px; height: 50px;" alt="">
                            <input class="ms-5" type="radio" id="multibanco" name="pagamento" value="MULTIBANCO" onclick="mostrar_dados_multibanco()">
                            <label class="me-2" for="multibanco">&nbsp;Multibanco</label><img src="assets/img/multibanco.png" style="width: 50px; height: 50px;" alt="">
                        </div>

                        <div id="pagamento_mbway" style="display: none;">
                            <br>
                            <form>
                                <div style="display: flex; flex-direction: row;">
                                    <div style="margin-right: 50px;">
                                        <h3>Indicativo:</h3>
                                        <input type="text" id="indicativo_mbway" name="indicativo_mbway" value="+351" style='width: 120px;'>
                                    </div>
                                    <div>
                                        <h3>Número de telemóvel:</h3>
                                        <input type="text" id="numero_mbway" name="numero_mbway" style='width: 270px;' value="<?php echo $_SESSION['user_num_telemovel']; ?>">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="pagamento_cartao_credito" style="display: none;">
                            <br>
                            <form>
                                <div style="display: flex; flex-direction: row;">
                                    <div style="margin-right: 25px;">
                                        <h3>Nome no cartão:</h3>
                                        <input type="text" id="nome_cartao_credito" name="nome_cartao_credito" style='width: 200px;' value="<?php echo $_SESSION['user_name']; ?>">
                                    </div>
                                    <div style="margin-right: 25px;">
                                        <h3>Número do cartão:</h3>
                                        <input type="number" id="numero_cartao_credito" name="numero_cartao_credito" style='width: 230px;'>
                                    </div>
                                    <div style="margin-right: 25px;">
                                        <h3>Validade:</h3>
                                        <select id="mes_validade_cartao_credito" name="mes_validade_cartao_credito" style='width: 70px; height: 33px;'>
                                            <option value="">Mês</option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                        <select id="ano_validade_cartao_credito" name="ano_validade_cartao_credito" style='width: 70px; height: 33px;'>
                                            <option value="">Ano</option>
                                            <?php
                                            $anoAtual = date("Y");
                                            for ($i = $anoAtual; $i <= $anoAtual + 10; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <h3>CVC/CVV:</h3>
                                        <input type="number" id="cvv_cartao_credito" name="cvv_cartao_credito" style='width: 130px;'>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href='entrega.php'><button class='btn btn-secondary'><i class='fas fa-arrow-left'></i>
                                    Retroceder</button></a>
                            <a id="redirecionar_confirmacao" href='confirmacao.php' onclick="return verificarSelecao();"><button class='btn btn-secondary' style='background-color: #3bc0d8; border-color: #3bc0d8;'>Seguinte <i class='fas fa-arrow-right'></i></button></a>
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
                            echo "<p>Total: <span id='totalValor'>" . $resumoCarrinho['totalValor'] . "</span> €</p>";
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

                                        if (isset($produto['isRental']) && $produto['isRental'] === "true") {
                                            // Exibe um aviso se o produto é um aluguer
                                            echo "<p><strong>Aviso:</strong> O produto '$nome' é apenas para aluguer e deve ser levantado no parque.</p>";
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
                                            $dias = $produto['dias']+1;
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
                            <a class="text-decoration-none"
                                href="../contact.php">codewaveptw@gmail.com</a>
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