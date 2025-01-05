<?php
session_start();

if(isset($_SESSION['user_id'])) {
    echo 'sessao_iniciada';
} else {
    echo 'sessao_nao_iniciada';
}
?>
