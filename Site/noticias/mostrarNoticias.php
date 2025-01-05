<?php
// Conexão com a base de dados
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}

// Consulta SQL para obter todas as notícias
$sql = "SELECT * FROM public.noticias";

try {
    // Prepara e executa a consulta
    $stmt = $conn->query($sql);

    // Verifica se existem notícias
    if ($stmt->rowCount() > 0) {
        // Itera os resultados e exibe cada notícia dentro de um retângulo
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-3 mb-4">';
            echo '<div class="news-rectangle" onclick="expandRectangle(this)">';
            echo '<img src="' . $row['imagem_capa'] . '" alt="Imagem de Capa">';
            echo '<br>';
            echo '<br>';
            echo '<h5>' . htmlspecialchars($row['titulo_noticia']) . '</h5>';
            echo '<br>';
            echo '<p>' . htmlspecialchars($row['descricao_noticia']) . '</p>';
            echo '<br>';
            echo '<div class="news-footer">' . htmlspecialchars($row['data_hora']) . ' | ' . htmlspecialchars($row['funcionario_criador']) . '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-info" role="alert">Não foram encontradas notícias.</div>';
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger" role="alert">Erro na consulta: ' . $e->getMessage() . '</div>';
}
?>

<!-- Modal de Notícia -->
<div id="newsModal" class="modal">
    <div class="modal-content">
        <span class="botao_fechar" aria-label="Close" onclick="closeModal()">
            <i class="fa fa-times" style="font-size: 20px;"></i>
        </span>
        <div id="modalContent"></div>
    </div>
</div>

<script>
    // Abre o modal quando o retângulo é clicado
    function expandRectangle(rectangle) {
        // Obtém o conteúdo do retângulo clicado
        var content = rectangle.innerHTML;

        // Atualiza o conteúdo do modal com o conteúdo do retângulo clicado
        document.getElementById('modalContent').innerHTML = content;

        // Exibe o modal
        document.getElementById('newsModal').style.display = 'flex';
        // Desabilita o scroll da página principal
        document.body.style.overflow = 'hidden';
    }

    // Fecha o modal quando clicar no botão de fechar
    function closeModal() {
        // Oculta o modal
        document.getElementById('newsModal').style.display = 'none';
        // Habilita novamente o scroll da página principal
        document.body.style.overflowY = 'auto';
        document.body.style.overflowX = 'hidden';
    }

    // Fecha o modal quando clicar fora do conteúdo do modal
    window.onclick = function (event) {
        var modal = document.getElementById('newsModal');
        if (event.target == modal) {
            // Oculta o modal
            modal.style.display = "none";
            // Habilita novamente o scroll da página principal
            document.body.style.overflowY = 'auto';
            document.body.style.overflowX = 'hidden';
        }
    }
</script>