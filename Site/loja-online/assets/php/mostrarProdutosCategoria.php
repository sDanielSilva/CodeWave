<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Estabelece conexão com a base de dados
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : 'todos';
    $nome_categoria = isset($_GET['nome_categoria']) ? $_GET['nome_categoria'] : 'Todos';

    // Query para recuperar os produtos da categoria selecionada
    $query = "SELECT p.nome, p.preco, p.imagem, p.id_produto 
              FROM produto p
              INNER JOIN categoria c ON p.id_categoria = c.id_categoria";
    
    if ($id_categoria !== 'todos') {
        $query .= " WHERE c.id_categoria = :id_categoria";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_categoria', $id_categoria);
    } else {
        $stmt = $db->prepare($query);
    }

    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Gera o HTML dos produtos
    foreach ($produtos as $produto) {
        echo '
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="' . $produto['imagem'] . '">
                    <img src="' . $produto['imagem'] . '" class="rounded-circle img-fluid border">
                </a>
                <h5 class="text-center mt-3 mb-3">' . $produto['nome'] . '<br>' . number_format($produto['preco'], 2, ',', '.') . '€</h5>
                <div class="text-center">
                    <div class="btn-group">
                        <a class="btn btn-success me-2" onclick="adicionarAoCarrinho(\'' . addslashes($produto['nome']) . '\', \'' . addslashes($produto['preco']) . '\', \'' . addslashes($produto['imagem']) . '\', \'quantidadeInput_' . addslashes($produto['nome']) . '\', \'' . addslashes($produto['id_produto']) . '\')">Adicionar ao carrinho</a>
                        <div class="input-group" style="width: 134px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity(\'quantidadeInput_' . addslashes($produto['nome']) . '\')">-</button>
                            <input id="quantidadeInput_' . addslashes($produto['nome']) . '" type="number" class="form-control" value="1" min="1">
                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity(\'quantidadeInput_' . addslashes($produto['nome']) . '\')">+</button>
                        </div>
                    </div>
                </div>
            </div>';
    }

    $db = null;
} catch (PDOException $e) {
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Função para atualizar o número de produtos visíveis
            function atualizarNumeroProdutosVisiveis() {
                var numeroProdutosVisiveis = $('.container.py-5 .col-12:visible').length;
                $('.col-lg-6.m-auto h1').text('<?php echo htmlspecialchars($nome_categoria); ?> (' + numeroProdutosVisiveis + ')');
            }

            // Função de pesquisa
            function realizarPesquisa(searchText) {
                searchText = searchText.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                // Seleciona todos os elementos com a classe .col-12 dentro da seção de categorias
                $('.container.py-5 .col-12').each(function () {
                    // Remove acentos e caracteres especiais do texto do produto
                    var produtoText = $(this).find('h5').text().normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                    // Mostra ou oculta o produto com base na pesquisa (ignorando maiúsculas e minúsculas)
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
                // Verifica se o browser suporta SpeechRecognition
                if (!('webkitSpeechRecognition' in window || 'SpeechRecognition' in window)) {
                    alert("O seu browser não suporta reconhecimento de voz. Tente usar o Google Chrome.");
                    return;
                }

                // Configura o objeto de reconhecimento de fala
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

                    // Insere a transcrição no campo de pesquisa
                    $('#searchInput').val(transcript);
                    realizarPesquisa(transcript);
                });

                // Inicia o reconhecimento de fala ao clicar no botão de microfone
                $('#microphoneBtn').on('click', function () {
                    recognition.start();
                });
            }

            // Chama a função para configurar o reconhecimento de voz
            iniciarReconhecimentoDeVoz();
            atualizarNumeroProdutosVisiveis();
        });
    </script>

    <script>
        function adicionarAoCarrinho(nome, preco, imagem, quantidadeInputId, idProduto) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'adicionar_ao_carrinho.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
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

            // Alteração: seleciona o valor do elemento de entrada de quantidade
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
