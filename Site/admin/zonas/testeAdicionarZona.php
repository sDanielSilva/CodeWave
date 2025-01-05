<?php
require_once 'vendor/autoload.php'; // Inclui o autoload do Composer
require_once 'db_config.php';
require_once 'adicionarZona.php';

use PHPUnit\Framework\TestCase;

class SeuTeste extends TestCase {
    public function testInserirZona() {
        // Simula uma requisição POST com dados válidos
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['nomeZona'] = "Zona de Teste";

        // Captura a saída da execução do código
        ob_start();
        include 'adicionarZona.php';
        $output = ob_get_clean();

        // Verifica se a inserção foi bem-sucedida
        $this->assertStringContainsString("Location:", $output);

    }

    public function testInserirZonaSemNome() {
        // Simula uma requisição POST sem o campo 'nomeZona'
        $_SERVER["REQUEST_METHOD"] = "POST";
        unset($_POST['nomeZona']);

        // Captura a saída da execução do código
        ob_start();
        include 'adicionarZona.php';
        $output = ob_get_clean();

        // Verifica se a resposta contém o redirecionamento com o parâmetro de erro
        $this->assertStringContainsString("error=empty_field", $output);
    }
}
?>
