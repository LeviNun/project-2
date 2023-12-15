<?php
session_start();

// Verificar se o parâmetro relatorio está definido e é um número inteiro
if (isset($_GET['relatorio']) && filter_var($_GET['relatorio'], FILTER_VALIDATE_INT)) {
    $relatorioIndex = $_GET['relatorio'];

    // Verificar se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioIndex], true);
    } else {
        echo '<p>Relatório não encontrado.</p>';
    }
} else {
    echo '<p>Parâmetro de relatório inválido.</p>';
}

// Adicionar condição para apagar relatório
if (isset($_GET['acao']) && $_GET['acao'] === 'apagar' && isset($_GET['relatorio'])) {
    $relatorioIndex = $_GET['relatorio'];

    // Verificar se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        // Apagar o relatório específico
        unset($_SESSION['relatorios'][$relatorioIndex]);

        // Reorganizar os índices do array após a exclusão
        $_SESSION['relatorios'] = array_values($_SESSION['relatorios']);

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
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .content {
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
            margin: auto;
            margin-top: 20px;
        }

        h1, h2, p {
            color: #333; /* Cor neutra */
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #8e44ad; /* Roxo */
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #2ecc71; /* Verde */
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Conteúdo da Página -->
<div class="content">
    <h1>SergipeTec</h1>
    <h2>Relatório</h2>

    <?php
    // Exibir detalhes do relatório
    if (isset($relatorio['titulo'])) {
        echo '<h2>' . $relatorio['titulo'] . '</h2>';
    }

    if (isset($relatorio['observacao'])) {
        echo '<p><strong>Observação:</strong> ' . $relatorio['observacao'] . '</p>';
    }

    if (isset($relatorio['metas'])) {
        echo '<p><strong>Metas:</strong> ' . $relatorio['metas'] . '</p>';
    }
    if (isset($relatorio['comentarios'])) {
        echo '<p><strong>Comentários:</strong> ' . $relatorio['comentarios'] . '</p>';
    }

    if (isset($relatorio['anexos'])) {
        echo '<p><a href="mostrar_anexos.php?relatorio=' . $relatorioIndex . '">Ver anexos</a></p>';
    }
    if (isset($relatorio['anexos'])) {
        echo '<h3>Anexos:</h3>';
        foreach ($relatorio['anexos'] as $anexo) {
            // Se $relatorio['anexos'] é uma lista de strings, $anexo será uma string
            echo '<p><a href="' . $anexo . '" target="_blank">' . basename($anexo) . '</a></p>';
        }

    }
    
    // Adicionar link para baixar o relatório
    echo '<p><a href="download_relatorio.php?relatorio=' . $relatorioIndex . '">Baixar este relatório</a></p>';
     // Adicionar link para baixar o relatório
     echo '<p><a href="https://www.sejda.com/pt/html-to-pdf=' . $relatorioIndex . '">Baixar em pdf pelo sedja</a></p>';
    // Link para apagar o relatório atual
    echo '<p><a href="relatorios.php?acao=apagar&relatorio=' . $relatorioIndex . '">Apagar este relatório</a></p>';
    
    // Link para voltar para a página de relatórios
    echo '<p><a href="relatorios.php">Voltar para Relatórios</a></p>';
    ?>
</div>

</body>
</html>