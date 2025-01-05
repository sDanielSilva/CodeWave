<?php
session_start(); // Inicia a sessão
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <link rel="stylesheet" href="css/bilhetes.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
                                    <li><a href="mapa.php">Mapa do Parque</a></li>
                                    <li><a href="contact.php">Contactos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown" role="presentation">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Serviços
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
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Eventos e
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
        <df-messenger intent="WELCOME" chat-title="CodeWave" agent-id="7608ed60-5ee5-4799-a4fb-786a5e86e2d5"
            language-code="pt"></df-messenger>
        </div>
    </header>

    <section class="main" id="pages" style="height: 220px">
        <div class="page-title overlay">
            <img src="https://www.slidesplash.com/static/assets/images/banners/banner-precos.png" alt="">
        </div>
    </section>

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

    <script>
        function adicionarAoCarrinho(nome, preco, imagem, quantidade, idProduto) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'loja-online/adicionar_ao_carrinho.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    setTimeout(function () {
                        var mensagem = `${nome} (preço ${preco} €) foi adicionado ao carrinho com a quantidade ${quantidade} (subtotal ${preco * quantidade} €)`;
                        document.getElementById('modalCorpo').textContent = mensagem;
                        $('#modalMensagem').modal('show'); // Mostra a janela modal
                    }, 200);
                } else {
                    console.error('Erro ao adicionar produto ao carrinho.');
                }
            };

            // Passa todos os parâmetros necessários para adicionar o produto ao carrinho
            xhr.send('nome=' + encodeURIComponent(nome) + '&preco=' + encodeURIComponent(preco) + '&imagem=' + encodeURIComponent(imagem) + '&quantidade=' + encodeURIComponent(quantidade) + '&id_produto=' + encodeURIComponent(idProduto));
        }
    </script>

    <div id="modalMensagem" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"
                        style="margin-bottom: -30px;">
                        <span aria-label="Close"><i class="fa fa-times" style="font-size: 20px;"></i></span>
                    </button>
                    <h5 class="modal-title">Bilhete Adicionado</h5>
                </div>
                <div class="modal-body" id="modalCorpo"></div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            <a href="loja-online/carrinho.php" class="btn btn-primary btn-block">Ver carrinho</a>
                        </div>
                        <br>
                        <div class="col">
                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Continuar a
                                comprar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require "bilhetes/precoBilhetes.php"; ?>
    <script>
        function verificarData() {
            var dataSelecionada = document.getElementById('selected-date').value;
            var dataAtual = new Date().toISOString().split('T')[0]; // Obtém a data atual no formato 'YYYY-MM-DD'
            var selecionar_data = document.querySelector('input[name=data]')

            if (dataSelecionada < dataAtual) {
                document.getElementById('error-message').innerText = 'Por favor, selecione uma data igual ou posterior à data atual.';
                document.getElementById('error-message').style.display = 'block';
                selecionar_data.scrollIntoView({ behavior: 'smooth', block: 'center' });
                selecionar_data.style.border = '1px solid red';
                document.getElementById('selected-date').value = ''; // Limpa o valor do input de data
                return false; // Retorna false para indicar que a data não é válida
            }

            document.getElementById('error-message').style.display = 'none';
            return true; // Retorna true para indicar que a data é válida
        }

        function verificarSelecao() {
            var faixa_etaria_selecionada = document.querySelector('input[name=faixa_etaria]:checked');
            var horario_selecionado = document.querySelector('input[name=horario]:checked');
            var data_selecionada = document.querySelector('input[name=data]').value;
            var selecionar_data = document.querySelector('input[name=data]')
            var selecionar_junior = document.querySelector('input[value=junior]')
            var selecionar_normal = document.querySelector('input[value=normal]')
            var selecionar_senior = document.querySelector('input[value=senior]')

            if (data_selecionada === '') {
                document.getElementById('error-message').innerText = 'Por favor, selecione a data antes de escolher o tipo de bilhete que pretende.';
                document.getElementById('error-message').style.display = 'block';
                selecionar_data.scrollIntoView({ behavior: 'smooth', block: 'center' });
                selecionar_data.style.border = '1px solid red';

                // Verifica se a faixa etária está selecionada antes de desmarcá-la
                if (faixa_etaria_selecionada) {
                    faixa_etaria_selecionada.checked = false;
                }

                // Verifica se o horário está selecionado antes de desmarcá-lo
                if (horario_selecionado) {
                    horario_selecionado.checked = false;
                }
                return;
            }

            if (!faixa_etaria_selecionada && horario_selecionado) {
                document.getElementById('error-message').innerText = 'Por favor, selecione a faixa etária antes de selecionar o horário do mesmo.';
                document.getElementById('error-message').style.display = 'block';
                horario_selecionado.checked = false;
                selecionar_junior.scrollIntoView({ behavior: 'smooth', block: 'center' });
                selecionar_junior.style.border = '1px solid red';
                selecionar_normal.style.border = '1px solid red';
                selecionar_senior.style.border = '1px solid red';
                return;
            }
            document.getElementById('error-message').style.display = 'none';
        }

        function formatarData(data) {
            // Obtem o dia, mês e ano da data
            var dia = data.getDate();
            var mes = data.getMonth() + 1; // Adiciona 1 ao mês, pois janeiro é 0
            var ano = data.getFullYear();

            // Formata o dia e mês para ter dois dígitos
            dia = (dia < 10) ? '0' + dia : dia;
            mes = (mes < 10) ? '0' + mes : mes;

            // Retorna a data formatada no formato "dia-mes-ano"
            return dia + '-' + mes + '-' + ano;
        }

        function Disponibilidade() {
            // Obtem os valores da faixa etária e do horário
            var faixa_etaria = document.querySelector('input[name="faixa_etaria"]:checked').value;
            var horario = document.querySelector('input[name="horario"]:checked').value;

            // Determina o id_produto com base nas condições fornecidas
            var id_produto;
            if (faixa_etaria === 'junior' && horario === 'completo') {
                id_produto = 15;
            } else if (faixa_etaria === 'normal' && horario === 'completo') {
                id_produto = 16;
            } else if (faixa_etaria === 'senior' && horario === 'completo') {
                id_produto = 17;
            } else if (faixa_etaria === 'junior' && horario === 'manha') {
                id_produto = 18;
            } else if (faixa_etaria === 'normal' && horario === 'manha') {
                id_produto = 19;
            } else if (faixa_etaria === 'senior' && horario === 'manha') {
                id_produto = 20;
            } else if (faixa_etaria === 'junior' && horario === 'tarde') {
                id_produto = 21;
            } else if (faixa_etaria === 'normal' && horario === 'tarde') {
                id_produto = 22;
            } else if (faixa_etaria === 'senior' && horario === 'tarde') {
                id_produto = 23;
            }

            // Obtem a data selecionada
            var dataSelecionada = new Date(document.getElementById('selected-date').value);
            var data_inicio = dataSelecionada.toISOString().split('T')[0]; // Convertendo para formato YYYY-MM-DD

            // Faz a requisição AJAX para o PHP
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'bilhetes/get_disponibilidadeBilhetes.php', true); 
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        console.error('Erro: ' + response.error);
                    } else {
                        console.log('Disponibilidade: ' + response.disponibilidade);
                        document.getElementById('disponibilidade').innerText = 'Disponibilidade: ' + response.disponibilidade;
                        verificarSelecaoDisponibilidade(response.disponibilidade);
                    }
                }
            };

            xhr.send('id_produto=' + id_produto + '&data_inicio=' + data_inicio);
        }

        function desabilitarEventosClique(elemento) {
            // Remove todos os manipuladores de eventos de clique
            elemento.removeAttribute('onclick');
            elemento.onclick = null;
        }


        // Função para verificar a seleção da disponibilidade
        function verificarSelecaoDisponibilidade() {
            var quantidade = parseInt(document.getElementById('qtd').value, 10);
            var disponibilidade = parseInt(document.getElementById('disponibilidade').innerText.split(': ')[1], 10);
            var botaoAdicionar = document.getElementById('botao_adicionar');
            if (quantidade > disponibilidade) {
                // Desabilita todos os eventos de clique no link
                desabilitarEventosClique(botaoAdicionar);
  
                botaoAdicionar.style.backgroundColor = 'red';
                botaoAdicionar.style.borderColor = 'red';
                botaoAdicionar.style.cursor = 'not-allowed';
            } else {
                atualizarPreco();
     
                botaoAdicionar.style.backgroundColor = 'green';
                botaoAdicionar.style.borderColor = 'green';
                botaoAdicionar.style.cursor = 'pointer';
            }
        }
        // Função para atualizar o preço
        function atualizarPreco() {
            var preco = 0;
            var faixa_etaria = document.querySelector('input[name=faixa_etaria]:checked').value;
            var horario = document.querySelector('input[name=horario]:checked').value;
            var dataSelecionada = new Date(document.getElementById('selected-date').value);
            var total = 0;
            var nome = '';
            var imagem = '';
            var id_produto = 0;

            // Verifica se a dataSelecionada é válida
            if (isNaN(dataSelecionada.getTime())) {
                document.getElementById('error-message').innerText = 'Por favor, selecione uma data válida.';
                document.getElementById('error-message').style.display = 'block';
                return;
            }

            document.getElementById('error-message').style.display = 'none';

            // Formata a data no formato "dia-mes-ano"
            var dataFormatada = formatarData(dataSelecionada);

            if (faixa_etaria === 'junior' && horario === 'completo') {
                preco = <?php echo $produto15['preco']; ?>;
                nome = '<?php echo $produto15['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto15['imagem']; ?>';
                id_produto = <?php echo $produto15['id_produto']; ?>;
            } else if (faixa_etaria === 'normal' && horario === 'completo') {
                preco = <?php echo $produto16['preco']; ?>;
                nome = '<?php echo $produto16['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto16['imagem']; ?>';
                id_produto = <?php echo $produto16['id_produto']; ?>;
            } else if (faixa_etaria === 'senior' && horario === 'completo') {
                preco = <?php echo $produto17['preco']; ?>;
                nome = '<?php echo $produto17['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto17['imagem']; ?>';
                id_produto = <?php echo $produto17['id_produto']; ?>;
            } else if (faixa_etaria === 'junior' && horario === 'manha') {
                preco = <?php echo $produto18['preco']; ?>;
                nome = '<?php echo $produto18['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto18['imagem']; ?>';
                id_produto = <?php echo $produto18['id_produto']; ?>;
            } else if (faixa_etaria === 'normal' && horario === 'manha') {
                preco = <?php echo $produto19['preco']; ?>;
                nome = '<?php echo $produto19['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto19['imagem']; ?>';
                id_produto = <?php echo $produto19['id_produto']; ?>;
            } else if (faixa_etaria === 'senior' && horario === 'manha') {
                preco = <?php echo $produto20['preco']; ?>;
                nome = '<?php echo $produto20['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto20['imagem']; ?>';
                id_produto = <?php echo $produto20['id_produto']; ?>;
            } else if (faixa_etaria === 'junior' && horario === 'tarde') {
                preco = <?php echo $produto21['preco']; ?>;
                nome = '<?php echo $produto21['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto21['imagem']; ?>';
                id_produto = <?php echo $produto21['id_produto']; ?>;
            } else if (faixa_etaria === 'normal' && horario === 'tarde') {
                preco = <?php echo $produto22['preco']; ?>;
                nome = '<?php echo $produto22['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto22['imagem']; ?>';
                id_produto = <?php echo $produto22['id_produto']; ?>;
            } else if (faixa_etaria === 'senior' && horario === 'tarde') {
                preco = <?php echo $produto23['preco']; ?>;
                nome = '<?php echo $produto23['nome']; ?>';
                nome += " (" + dataFormatada + ")";
                imagem = '<?php echo $produto23['imagem']; ?>';
                id_produto = <?php echo $produto23['id_produto']; ?>;
            }

            var qtd = document.querySelector('input[name=qtd]').value;

            preco = parseFloat(preco);
            total = preco * qtd;

            document.getElementById('preco-bilhete').textContent = "Preço do bilhete: " + preco.toFixed(2) + " €";

            document.getElementById('total-bilhete').textContent = "Total do bilhete: " + total.toFixed(2) + " €";;

            var botao_add = document.getElementById('botao_adicionar');
            botao_add.setAttribute('onclick', 'adicionarAoCarrinho(\'' + nome + '\', ' + preco + ', \'' + imagem + '\', ' + qtd + ', ' + id_produto + ')');
        }
    </script>

    <section id="bilhetes">
        <!-- Escolher o tipo de bilhete -->
        <div class="container">
            <div class="container text-center mt-5 btn-container">
                <br>
                <div id="error-message" style="color: red; margin-bottom: 10px"></div>
                <!-- Escolher a data -->
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3 text-center">
                        <p class="lead mt-3">Selecione a data:</p>
                        <input id="selected-date" name="data" class="form-control" type="date"
                            placeholder="Selecione a data" onchange="verificarData()">
                    </div>
                </div>
                <p class="lead mt-3">Selecione a faixa etária do seu bilhete:</p>
                <div class="btn-group-spaced" id="tipo_bilhete">
                    <input type="radio" id="junior" name="faixa_etaria" value="junior" onchange="atualizarPreco();"
                        onclick="Disponibilidade();verificarSelecao()">
                    <label for="junior" style="cursor: pointer;">Júnior (0 até 17 anos)</label>

                    <input type="radio" id="normal" name="faixa_etaria" value="normal" style="margin-left: 40px;"
                        onchange="Disponibilidade();atualizarPreco()" onclick="verificarSelecao()">
                    <label for="normal" style="cursor: pointer;">Normal (18 até 65 anos)</label>

                    <input type="radio" id="senior" name="faixa_etaria" value="senior" style="margin-left: 40px;"
                        onchange="Disponibilidade();atualizarPreco()" onclick="verificarSelecao()">
                    <label for="senior" style="cursor: pointer;">Sénior (> 65 anos)</label>
                </div>
                <br>
                <p class="lead mt-5">Selecione o horário do seu bilhete:</p>
                <div class="btn-group-spaced">
                    <input type="radio" id="manha" name="horario" value="manha"
                        onchange="Disponibilidade();atualizarPreco()" onclick="verificarSelecao()">
                    <label for="manha" style="cursor: pointer;">Manhã</label>

                    <input type="radio" id="tarde" name="horario" value="tarde" style="margin-left: 40px;"
                        onchange="Disponibilidade();atualizarPreco()" onclick="verificarSelecao()">
                    <label for="tarde" style="cursor: pointer;">Tarde</label>

                    <input type="radio" id="completo" name="horario" value="completo" style="margin-left: 40px;"
                        onchange="Disponibilidade();atualizarPreco()" onclick="verificarSelecao()">
                    <label for="completo" style="cursor: pointer;">Completo</label>
                </div>
                <br>
                <div id="disponibilidade"></div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-md-6 text-center">
                        <p id="preco-bilhete" class="lead">Preço do bilhete: 0.00 €</p>
                    </div>
                </div>
                <p class="lead mt-5">Selecione a quantidade do seu bilhete:</p>
                <div class="text-center mt-5 justify-content-center">
                    <div class="input-group" style="width: 180px;display: flex;">
                        <button style='background-color: #3bc0d8; border-color: #3bc0d8; height: 40px; width: 40px'
                            type="button"
                            onclick="decrementQuantity('qtd'); verificarSelecaoDisponibilidade();">-</button>
                        <input id="qtd" name="qtd" type="number" class="form-control" value="1" min="1"
                            style="flex: 1; width: 80px; height: 40px" onchange="verificarSelecaoDisponibilidade()">
                        <button style='background-color: #3bc0d8; border-color: #3bc0d8; height: 40px; width: 40px'
                            type="button"
                            onclick="incrementQuantity('qtd'); verificarSelecaoDisponibilidade();">+</button>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-md-6 text-center">
                        <p id="total-bilhete" class="lead">Total do bilhete: 0.00 €</p>
                    </div>
                </div>

                <a id="botao_adicionar" class="btn btn-adicionar" style="background-color: green; border-color: green;"
                    onclick="
                    var faixa_etaria_selecionada = document.querySelector('input[name=faixa_etaria]:checked');
                    var horario_selecionado = document.querySelector('input[name=horario]:checked');
                    var data_selecionada = document.querySelector('input[name=data]').value;
                    var selecionar_data = document.querySelector('input[name=data]')
                    var selecionar_junior = document.querySelector('input[value=junior]')
                    var selecionar_normal = document.querySelector('input[value=normal]')
                    var selecionar_senior = document.querySelector('input[value=senior]')
                    var selecionar_manha = document.querySelector('input[value=manha]')
                    var selecionar_tarde = document.querySelector('input[value=tarde]')
                    var selecionar_completo = document.querySelector('input[value=completo]')

                    if (data_selecionada === '') {
                        document.getElementById('error-message').innerText = 'Por favor, selecione a data antes de escolher o tipo de bilhete que pretende.';
                        document.getElementById('error-message').style.display = 'block';
                        selecionar_data.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        selecionar_data.style.border = '1px solid red';
                        return;
                    }

                    if (!faixa_etaria_selecionada || !horario_selecionado) {
                        document.getElementById('error-message').innerText = 'Por favor, selecione a faixa etária e o horário antes de adicionar o bilhete ao carrinho.';
                        document.getElementById('error-message').style.display = 'block';
                        selecionar_junior.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        selecionar_junior.style.border = '1px solid red';
                        selecionar_normal.style.border = '1px solid red';
                        selecionar_senior.style.border = '1px solid red';
                        selecionar_manha.style.border = '1px solid red';
                        selecionar_tarde.style.border = '1px solid red';
                        selecionar_completo.style.border = '1px solid red';
                        return;
                    }
                    "> Adicionar ao carrinho <i class="fa fa-fw fa-check" style="font-size: 20px;"></i>
                </a>
                <br>
                <br>
                <br>
                <?php
                $comprarLink = isset($_SESSION['user_id']) ? 'loja-online/carrinho.php' : 'bilhetes/login.html';
                ?>
                <div class="text-center mt-3">
                    <a class="btn btn-lg" href="<?php echo $comprarLink; ?>">Ver carrinho
                        <i class="fa fa-fw fa-cart-arrow-down"
                            style='font-size: 25px;background-color: #3bc0d8; border-color: #3bc0d8;'></i>
                    </a>
                </div>
                <br>
                <br>
                <br>
                <br>
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
                                <span><i class="fa fa-envelope-o"><a href="contact.php"
                                            style="hover: color: #f69504;">CodeWave</a></i>
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