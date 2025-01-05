<?php
session_start(); // Certifique-se de que a sessão foi iniciada

// Script para remover um item do carrinho
if (isset($_POST['remover_indice'])) {
    $indice = $_POST['remover_indice'];
    if (isset($_SESSION['carrinho'][$indice])) {
        // Remove o item do carrinho
        unset($_SESSION['carrinho'][$indice]);
        // Recalcula o resumo do carrinho
        $resumoCarrinho = calcularTotalCarrinho($_SESSION['carrinho']);
        // Retorna o resumo do carrinho como resposta JSON
        echo json_encode($resumoCarrinho);
        exit; // Termina a execução do script
    }
}
?>
