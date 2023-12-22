<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se foi enviado um arquivo
    if (isset($_FILES['arquivo']) && isset($_POST['projeto_nome'])) {
        $arquivo_nome = $_FILES['arquivo']['name'];
        $arquivo_temp = $_FILES['arquivo']['tmp_name'];
        $projeto_nome = $_POST['projeto_nome'];

        // Criar a pasta do projeto se não existir
        $projeto_pasta = 'uploads/' . strtolower(str_replace(' ', '_', $projeto_nome));
        if (!file_exists($projeto_pasta)) {
            mkdir($projeto_pasta, 0777, true);
        }

        // Mover o arquivo para a pasta do projeto
        $destino = $projeto_pasta . '/' . $arquivo_nome;
        move_uploaded_file($arquivo_temp, $destino);

        echo "Upload bem-sucedido! O arquivo está em: $destino";
    } else {
        echo "Erro ao enviar o arquivo. Certifique-se de escolher um arquivo e informar o nome do projeto.";
    }
}

function obterProjetos() {
    // Simulação: substitua isso com lógica real para obter os projetos
    return ['uploads'];
}
var_dump 'arquios/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Pastas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #gerenciador {
            width: 300px;
            margin: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        #pastas {
            list-style-type: none;
            padding: 0;
        }

        .pasta {
            cursor: pointer;
            margin-bottom: 5px;
        }

        .pasta:hover {
            background-color: #f0f0f0;
        }

        #conteudo-pasta {
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>
</head>
<body>

<div>
    <h2>Formulário de Upload de Relatórios</h2>

    <form action="projetos.php" method="post" enctype="multipart/form-data">
        <label for="projeto_nome">Nome do Projeto:</label>
        <input type="text"  name="projeto_nome">
            <?php
            $projetos = obterProjetos();
            foreach ($projetos as $projeto) {
                echo "<option value=\"$projeto\">$projeto</option>";
            }
            ?>
        </select>
        <br>
        <label for="arquivo">Selecione um arquivo PDF:</label>
        <input type="file" name="arquivo" accept=".pdf" required>
        <br>
        <input type="submit" value="Enviar Relatório">
    </form>
</div>


</body>
</html>
