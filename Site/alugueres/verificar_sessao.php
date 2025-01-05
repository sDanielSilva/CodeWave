<?php
session_start(); 

if (isset($_SESSION['user_id'])) {
    echo 'logado';
} else {
    echo 'deslogado';
}
?>
