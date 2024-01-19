<?php
session_start();

// Verificar se o parâmetro relatorio está definido e é um número inteiro
if (isset($_GET['relatorio']) && is_string($_GET['relatorio'])) {
    $relatorioId = $_GET['relatorio'];

    // Verificar se o identificador do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioId])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioId], true);
    } else {
        echo '<p>Relatório não encontrado.</p>';
        exit(); // Encerre a execução para evitar a exibição do restante da página
    }
} else {
    echo '<p>Parâmetro de relatório inválido.</p>';
    exit(); // Encerre a execução para evitar a exibição do restante da página
}

// Adicionar condição para apagar relatório
if (isset($_GET['acao']) && $_GET['acao'] === 'apagar' && isset($_GET['relatorio'])) {
    // Verificar se o identificador do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioId])) {
        // Apagar o relatório específico
        unset($_SESSION['relatorios'][$relatorioId]);

        // Redirecionar de volta para a página de relatórios após apagar o relatório
        header("Location: relatorios.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Relatório - SergipeTec</title>
    <link rel="stylesheet" href="pasta_de_estilos/mostrar.css">
</head>
<body class="body">
    <nav class="nav">
        <?php
            // Adicionar link para baixar o relatório
            echo '<p><a href="download_relatorio.php?relatorio=' . $relatorioId . '" >Baixar este relatório</a></p>';
            // Link para apagar o relatório atual
            echo '<p><a href="mostrar_relatorio.php?acao=apagar&relatorio=' . $relatorioId . '">Apagar este relatório</a></p>';
            // Link para voltar para a página de relatórios
            echo '<p><a href="relatorios.php">Voltar para Relatórios</a></p>';
            echo '<p><a href="relatorios.php">Enviar relatorio</a></p>';
        ?>
    </nav>

    <!-- Conteúdo da Página -->
    <div class="content">
        <h1>SergipeTec</h1>
        <h2>Relatório</h2>
        <?php
            // Exibir detalhes do relatório
            if (isset($relatorio['titulo'])) {
                echo '<h2 class="h2">' . $relatorio['titulo'] . '</h2>';
            }

            if (isset($relatorio['observacao'])) {
                echo '<p class="p"><strong>Observação:</strong> ' . $relatorio['observacao'] . '</p>';
            }

            if (isset($relatorio['metas'])) {
                echo '<p class="p"><strong>Metas:</strong> ' . $relatorio['metas'] . '</p>';
            }
            
            if (isset($relatorio['comentarios'])) {
                echo '<p class="p"><strong>Comentários:</strong> ' . $relatorio['comentarios'] . '</p>';
            }
            
            if (isset($relatorio['anexos'])) {
                echo '<h3>Anexos:</h3>';
                foreach ($relatorio['anexos'] as $anexo) {
                    // Se $relatorio['anexos'] é uma lista de strings, $anexo será uma string
                    echo '<p class="p"><a href="' . $anexo . '" target="_blank">' . basename($anexo) . '</a></p>';
                }
            }
        ?>
    </div>
</body>
</html>
