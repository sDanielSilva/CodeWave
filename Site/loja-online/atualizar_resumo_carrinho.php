<?php
// Inicia a sessão
session_start();

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

// Verifica se há produtos no carrinho
if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    // Calcula o resumo do carrinho
    $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);
    // Retorna o resumo do carrinho em formato JSON
    echo json_encode($resumoCarrinho);
} else {
    // Se não houver produtos no carrinho, retorna um objeto vazio
    echo json_encode(array());
}
