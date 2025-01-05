<?php
require_once 'db_config.php';
// Dados do formulário
$nome = $_POST['nome'];
$id_cargo = $_POST['cargo']; // Agora 'cargo' é o ID do cargo
$local = $_POST['local'];
$idade = $_POST['idade'];
$data_inicio = $_POST['data_inicio'];
$salario = str_replace(',', '.', str_replace('€', '', $_POST['salario']));

// Consulta SQL para atualizar o registro na tabela funcionario
$sql = "UPDATE public.funcionario f SET nome = :nome WHERE f.nome = :nome";
$stmt = $db->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->execute();

// Consulta SQL para atualizar o registo na tabela progressao
$sql = "UPDATE public.progressao p SET id_cargo = :id_cargo, local = :local, idade = :idade, ano_inicio = :data_inicio, salario = :salario WHERE p.id_funcionario = (SELECT id_funcionario FROM public.funcionario WHERE nome = :nome)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':id_cargo', $id_cargo);
$stmt->bindParam(':local', $local);
$stmt->bindParam(':idade', $idade);
$stmt->bindParam(':data_inicio', $data_inicio);
$stmt->bindParam(':salario', $salario);
$stmt->execute();
?>
