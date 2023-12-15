<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Atividades</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        nav {
            background-color: #343a40; /* Azul acinzentado escuro */
            overflow: hidden;
            text-align: left;
            width: 100%;
            position: absolute;
            top: 0;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 10px; /* Adicionado para separar do canto superior */
        }

        nav a {
            display: inline-block;
            color: #fff; /* Texto branco */
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #495057; /* Azul acinzentado mais escuro ao passar o mouse */
            color: #fff;
        }


        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

<?php

$atividades = [];

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo de atividade não está vazio
    if (!empty($_POST['atividade'])) {
        // Adiciona a atividade ao array
        $atividade = $_POST['atividade'];
        
        // Adiciona a avaliação, se fornecida
        $avaliacao = (!empty($_POST['avaliacao'])) ? $_POST['avaliacao'] : 'Não avaliado';

        $atividades[] = [
            'atividade' => $atividade,
            'avaliacao' => $avaliacao,
        ];
    }
}

// Salva as atividades em um documento (formato simples)
$documento = "Atividades:\n";
foreach ($atividades as $item) {
    $documento .= "Atividade: {$item['atividade']}\nAvaliação: {$item['avaliacao']}\n\n";
}

// Salva o documento em um arquivo (pode ser adaptado para um banco de dados)
file_put_contents('atividades.txt', $documento);

// Simula o envio das atividades (pode ser adaptado para enviar por e-mail, etc.)
function enviarAtividades($atividades) {
    // Implemente a lógica de envio aqui
    echo "Atividades enviadas com sucesso!";
}

?>

    <h2>Lista de Atividades</h2>
    <ul>
        <?php
        // Exibe a lista de atividades
        foreach ($atividades as $item) {
            echo "<li>{$item['atividade']} - Avaliação: {$item['avaliacao']}</li>";
        }
        ?>
    </ul>
</div>

<div>
    <h2>Adicionar Atividade</h2>

    <form method="post" action="">
        <label for="atividade">Atividade:</label>
        <input type="text" name="atividade" required>

        <label for="avaliacao">Avaliação:</label>
        <input type="text" name="avaliacao">

        <button type="submit">Adicionar</button>
    </form>

    <!-- Adiciona um link para baixar o arquivo com as atividades -->
    <?php if (!empty($atividades)) : ?>
        <h2>Download das Atividades</h2>
        <p><a href="atividades.txt" download>Download do arquivo de atividades</a></p>
    <?php endif; ?>

    <form method="post" action="">
        <button type="submit" name="enviar" value="1">Enviar Atividades</button>
    </form>
</div>
<nav>
  <a href = "https://sergipetec.org.br"<div id="sergipeTec">Sergipe<span style="color: #2ecc71;">Tec</span></div></a>
  <a href="perfil.php">Perfil</a>
  <a href = "https://www.youtube.com/watch?v=WgntYmo7Uho">ouça</a>
    <a href="relatorios.php">Relatórios</a>
    <a href="projetos.php">Projetos</a>
    <a href="ger_atividades.php">Gerenciar atividades</a>
    <a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a> 
</nav>
</body>
</html>