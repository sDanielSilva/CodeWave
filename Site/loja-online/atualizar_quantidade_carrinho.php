<?php
session_start(); // Certifique-se de que a sessão foi iniciada

// Verificar se os dados do formulário foram recebidos corretamente
if(isset($_POST['indice']) && isset($_POST['novaQuantidade'])) {
    // Obter os dados do índice e da nova quantidade
    $indice = $_POST['indice'];
    $novaQuantidade = $_POST['novaQuantidade'];

    // Atualizar a quantidade do produto no carrinho
    if(isset($_SESSION['carrinho'][$indice])) {
        $_SESSION['carrinho'][$indice]['quantidade'] = $novaQuantidade;

        // Calcular os novos totais
        $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);

        // Retornar os novos totais no formato JSON
        echo json_encode(array('totalProdutos' => $resumoCarrinho['totalProdutos'], 'totalValor' => $resumoCarrinho['totalValor']));
    } else {
        // Se o índice fornecido não existir no carrinho, retorne uma mensagem de erro
        echo json_encode(array('error' => 'Índice inválido.'));
    }
} else {
    // Se os dados do formulário não foram recebidos corretamente, retorne uma mensagem de erro
    echo json_encode(array('error' => 'Dados do formulário ausentes.'));
}
?>
