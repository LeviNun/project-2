<?php
session_start();

// Adicionar condição para criar relatório
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['criar_relatorio_form'])) {
    // Obter dados do formulário
    $titulo = $_POST['titulo'];
    $observacao = $_POST['observacao'];
    $metas = $_POST['metas'];
    $comentarios = $_POST['comentarios'];
    // Array para armazenar os caminhos dos arquivos anexados
    $anexos = array();

    // Diretório onde os anexos serão armazenados
    $anexos_dir = 'uploads/';

    // Limitar o número máximo de arquivos para 10
    $max_files = 10;

    // Tratar o upload dos arquivos
    for ($i = 0; $i < $max_files; $i++) {
        // Verificar se o arquivo foi enviado
        if (!empty($_FILES['anexos']['name'][$i])) {
            $filename = $_FILES['anexos']['name'][$i];
            $anexo_path = $anexos_dir . basename($filename);

            if (move_uploaded_file($_FILES['anexos']['tmp_name'][$i], $anexo_path)) {
                $anexos[] = $anexo_path;
            } else {
                echo "Erro ao realizar upload do arquivo {$filename}.";
            }
        }
    }

    // Restante do código permanece inalterado
    // ...

    // Relatório com informações e caminhos dos anexos
    $relatorio = array(
        'titulo' => $titulo,
        'observacao' => $observacao,
        'metas' => $metas,
        'comentarios' => $comentarios,
        'anexos' => $anexos  // Armazenar os caminhos dos anexos
    );

    // Armazenar o array do relatório na variável de sessão
    $_SESSION['relatorios'][] = json_encode($relatorio);

    // Redirecionar de volta para a página de relatórios após criar o relatório
    header("Location: relatorios.php");
    exit();
}
?>
<?php

if (isset($_GET['relatorio']) && filter_var($_GET['relatorio'], FILTER_VALIDATE_INT)) {
    $relatorioIndex = $_GET['relatorio'];

    // Verificar se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        $relatorio = json_decode($_SESSION['relatorios'][$relatorioIndex], true);

        // Exibir os anexos e fornecer links para download
        if (isset($relatorio['anexos']) && is_array($relatorio['anexos']) && count($relatorio['anexos']) > 0) {
            echo '<h3>Anexos:</h3>';
            foreach ($relatorio['anexos'] as $index => $anexo) {
                echo '<p><a href="download_anexo.php?relatorio=' . $relatorioIndex . '&anexo=' . $index . '">Download Anexo ' . ($index + 1) . '</a></p>';
            }
        } else {
            echo '<p>Nenhum anexo disponível.</p>';
        }
    } else {
        echo '<p>Relatório não encontrado.</p>';
    }
} else {
    echo '<p>Parâmetro de relatório inválido.</p>';
}
?>

<!-- Restante do código permanece inalterado -->



<!-- Restante do código permanece inalterado -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Relatório - SergipeTec</title>
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

        nav {
            background-color: #333;
            overflow: hidden;
            text-align: center;
            width: 100%;
            position: absolute;
            top: 0;
        }

        nav a {
            display: inline-block;
            color: white;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #c82333;
        }

        .content {
            text-align: center;
            margin-top: 20px;
        }

        h2, h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333; /* Cor neutra */
        }

        #sergipeTec {
            color: #8e44ad; /* Roxo */
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #formCriarRelatorio {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: auto;
        }

        #formCriarRelatorio label {
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }

        #formCriarRelatorio input[type="text"],
        #formCriarRelatorio textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #formCriarRelatorio input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #formCriarRelatorio input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<!-- Conteúdo da Página -->
<div class="content">
    <div id="sergipeTec">SergipeTec</div>
    <h2>Criar Relatório</h2>

   <!-- Restante do código permanece inalterado -->

<<!-- Formulário de Criação de Relatório -->
<form id="formCriarRelatorio" action="criar_relatorio.php" method="post" enctype="multipart/form-data">


    <label for="titulo">Título do Relatório:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="observacao">Observação:</label>
    <textarea id="observacao" name="observacao" required></textarea>

    <label for="metas">Metas:</label>
    <!-- Adicionar campo de escolha de cor -->
    <input type="color" id="cor_metas" name="cor_metas">
    <textarea id="metas" name="metas" required></textarea>

    <label for="comentarios">Comentários:</label>
    <textarea id="comentarios" name="comentarios" required></textarea>
    <label for="anexos">Anexos:</label>
    <input type="file" id="anexos" name="anexos[]" multiple>

    
    <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
</form>
</div>

<nav>
    <a href="perfil.php">Perfil</a>
    <a href="relatorios.php">Relatórios</a>
    <a href="projetos.php">Projetos</a>
</nav>

</body>
</html>