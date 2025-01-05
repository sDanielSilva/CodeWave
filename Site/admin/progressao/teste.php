<!-- dropdown_funcionarios.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Dropdown de Funcionários</title>
</head>
<body>

    <h2>Selecione um Funcionário:</h2>

    <form id="formFuncionario">
        <select id="selectFuncionario" name="funcionario">
            <option value="">Selecione um funcionário</option>
            <?php
            // Inclui o ficheiro de configuração da base de dados
            include 'db_config.php';

            // Consulta a base de dados
            $sql = "SELECT id_funcionario, nome FROM funcionario";
            $result = $conn->query($sql);

            // Loop através dos resultados da consulta
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_funcionario'] . "'>" . $row['nome'] . "</option>";
            }
            ?>
        </select>
    </form>

    <script>
        // Função para lidar com a seleção do dropdown
        document.getElementById('selectFuncionario').addEventListener('change', function() {
            var selectedId = this.value; // Obtém o valor selecionado
            alert("ID do funcionário selecionado: " + selectedId);
            
        });
    </script>

</body>
</html>

<?php
// Fecha a conexão com a base de dados
$conn->close();
?>
