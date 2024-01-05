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
            position: relative;
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
            font-size: 50px;
            margin-bottom: 30px;
            font-weight: bold; /* Negrito */
            font-family: 'Times New Roman', serif; /* Fonte diferente, ajuste conforme necessário */
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-family: 'Times New Roman', serif; /* Fonte diferente, ajuste conforme necessário */
        }

        p {
            font-size: 20px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        nav {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #333;
            overflow: hidden;
            text-align: center;
            padding: 10px;
        }

        nav a {
            display: inline-block;
            color: white;
            padding: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <nav>
        <?php
            // Adicionar link para baixar o relatório
            echo '<p><a href="download_relatorio.php?relatorio=' . $relatorioId . '">Baixar este relatório</a></p>';
            // Link para apagar o relatório atual
            echo '<p><a href="mostrar_relatorio.php?acao=apagar&relatorio=' . $relatorioId . '">Apagar este relatório</a></p>';
            // Link para voltar para a página de relatórios
            echo '<p><a href="relatorios.php">Voltar para Relatórios</a></p>';
        ?>
    </nav>

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
                echo '<h3>Anexos:</h3>';
                foreach ($relatorio['anexos'] as $anexo) {
                    // Se $relatorio['anexos'] é uma lista de strings, $anexo será uma string
                    echo '<p><a href="' . $anexo . '" target="_blank">' . basename($anexo) . '</a></p>';
                }
            }
        ?>
    </div>
</body>
</html>
