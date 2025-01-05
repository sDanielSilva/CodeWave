<?php
require_once "db_config.php";

try {
    $query =
        "SELECT id_funcionario, img, nome, password, email FROM funcionario ORDER BY id_funcionario ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id_funcionario"]) . "</td>";
            echo "<td><img src='" .
                htmlspecialchars($row["img"]) .
                "' width='50px' height='50px' style='border-radius: 50%;'></td>";
            echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
            echo "<td>
            <div class='input-group'>
              <input type='password' class='form-control password-field' value='" .
                htmlspecialchars($row["password"]) .
                "' disabled style='width: 30px;'>
              <div class='input-group-append'>
                <button class='btn btn-outline-secondary toggle-password' type='button'>
                  <i class='fas fa-eye-slash'></i>
                </button>
              </div>
            </div>
          </td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>
            <button class='btn btn-warning text-white btn-sm' onclick='editarFuncionario(" . htmlspecialchars($row['id_funcionario']) . ", \"" . htmlspecialchars($row['nome']) . "\", \"" . htmlspecialchars($row['password']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['img']) . "\")'>Editar</button>
          
                    <button class='btn btn-danger btn-sm' onclick='apagarFuncionario(" .
                htmlspecialchars($row["id_funcionario"]) .
                ")'>Apagar</button>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum Funcionário encontrado.</td></tr>";
    }
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>