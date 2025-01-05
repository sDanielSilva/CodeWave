<?php
session_start(); // Inicia a sessão, se ainda não estiver iniciada

// Encerra a sessão
session_destroy();

// Redireciona para a página de login ou outra página apropriada após o logout
header("Location: index.php");
exit();
?>
