<?php
session_start(); // Inicia a sessão, se ainda não estiver iniciada

// Encerra a sessão
session_destroy();

// Redireciona para a página de login após o logout
header("Location: login.html");
exit();
?>