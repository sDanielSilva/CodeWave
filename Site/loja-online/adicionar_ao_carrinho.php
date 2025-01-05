<?php
// Inicia a sessão
session_start();

var_dump($_POST);

// Verifica se os dados do produto foram recebidos via POST
if (isset($_POST['nome']) && isset($_POST['preco']) && isset($_POST['imagem']) && isset($_POST['quantidade']) && isset($_POST['id_produto'])) {
    // Recupera os dados do produto
    $produto = array(
        'nome' => $_POST['nome'],
        'preco' => $_POST['preco'],
        'imagem' => $_POST['imagem'],
        'quantidade' => $_POST['quantidade'],
        'id_produto' => $_POST['id_produto'],
        'isRental' => isset($_POST['isRental']) ? $_POST['isRental'] : "false",
        'isAlojamento' => isset($_POST['isAlojamento']) ? $_POST['isAlojamento'] : "false",
        'horas' => isset($_POST['horas']) ? $_POST['horas'] : "0",
        'hora_inicio' => isset($_POST['hora_inicio']) ? $_POST['hora_inicio'] : null,
        'hora_fim' => isset($_POST['hora_fim']) ? $_POST['hora_fim'] : null,
        'totalPrice' => isset($_POST['totalPrice']) ? $_POST['totalPrice'] : "0",
        'dias' => isset($_POST['dias']) ? $_POST['dias'] : "0",
        'data_inicio' => isset($_POST['data_inicio']) ? $_POST['data_inicio'] : '',
        'data_fim' => isset($_POST['data_fim']) ? $_POST['data_fim'] : ''
    );

    // Verifica se o produto é um aluguer
    if ($produto['isRental'] === "true" && isset($_POST['horas'])) {
        $produto['preco'] = $produto['preco'] . "€ (por hora) x " . $_POST['horas'];
        $preco = floatval(str_replace("€ (por hora) x ", "", $produto['preco']));
        $produto['total'] = $preco * $_POST['horas'] * $_POST['quantidade'];
    } elseif ($produto['isAlojamento'] === "true") {
        // Se o produto é um alojamento, usa o preço total calculado anteriormente
        $produto['total'] = $produto['totalPrice'];
    }

    // Verifica se o produto já está no carrinho
    $produtoExistenteIndex = -1;
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
        foreach ($_SESSION['carrinho'] as $index => $item) {
            if ($item['nome'] === $produto['nome']) {
                $produtoExistenteIndex = $index;
                break;
            }
        }
    }

    // Se o produto já estiver no carrinho, aumenta a quantidade
    if ($produtoExistenteIndex !== -1) {
        $_SESSION['carrinho'][$produtoExistenteIndex]['quantidade'] += $produto['quantidade'];
        // Atualiza o total se o produto for um alojamento
        if ($produto['isAlojamento'] === "true") {
            $_SESSION['carrinho'][$produtoExistenteIndex]['totalPrice'] = $produto['totalPrice'];
        }
    } else {
        // Caso contrário, adiciona um novo item ao carrinho
        $_SESSION['carrinho'][] = $produto;
    }

    // Retorna uma resposta de sucesso
    echo "Produto adicionado ao carrinho com sucesso!";
} else {
    // Retorna uma mensagem de erro se os dados do produto não forem recebidos
    echo "Erro: Dados do produto não recebidos.";
}
