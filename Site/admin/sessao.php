<?php
session_start();

// Verifica se os dados do utilizador estão na sessão
if(!isset($_SESSION['userf_name']) || !isset($_SESSION['userf_img'])) {
    // Se os dados do utilizador não estiverem na sessão, redireciona para a página de login
    header("Location: login.html");
    exit();
}
?>
