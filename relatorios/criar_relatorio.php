<?php include 'criarel.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/criar_relatorio.css">
    <title>Criar Relatório - SergipeTec</title>
<<<<<<< HEAD
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            text-align: center;
            width: 100%;
            position: fixed;
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
            margin-top: 70px; /* Ajuste para evitar sobreposição com a barra de navegação */
        }

        h2,
        h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        #sergipeTec {
            color: #8e44ad;
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
        #formCriarRelatorio textarea,
        #formCriarRelatorio input[type="date"],
        #formCriarRelatorio input[type="number"],
        #formCriarRelatorio input[type="file"] {
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

        /* Adiciona regras de estilo para a barra de navegação em dispositivos pequenos */
        @media screen and (max-width: 600px) {
            nav a {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
=======
  
>>>>>>> 4d0124dcf69368868606ef6bc2fd08fa9d1cf521
</head>

<body>

    <!-- Conteúdo da Página -->
    <div class="content">
        <div id="sergipeTec">SergipeTec</div>
        <h2>Criar Relatório</h2>

        <!-- Formulário de Criação de Relatório -->
        <form id="formCriarRelatorio" action="criar_relatorio.php" method="post" enctype="multipart/form-data">
            <label for="projeto">Informações do Projeto:</label>
            <table>
                <tr>
                    <td><label for="nome_projeto">Nome do Projeto:</label></td>
                    <td><input type="text" id="nome_projeto" name="nome_projeto" required></td>
                </tr>
                <tr>
                    <td><label for="data_projeto">Data do Projeto:</label></td>
                    <td><input type="date" id="data_projeto" name="data_projeto" required></td>
                </tr>
                <tr>
                    <td><label for="conclusao_projeto">Porcentagem de Conclusão:</label></td>
                    <td><input type="number" id="conclusao_projeto" name="conclusao_projeto" min="0" max="100"
                            required></td>
                </tr>
            </table>

            <label for="titulo">Título do Relatório:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="observacao">Observação:</label>
            <textarea id="observacao" name="observacao" required></textarea>

            <!-- Meta 1 -->
            <label for="meta1">Meta 1:</label>
            <textarea id="meta1" name="metas[]" required></textarea>

            <!-- Comentários da Meta 1 -->
            <label for="prazo1">Prazo Meta 1:</label>
            <textarea id="prazo1" name="prazos[]" required></textarea>

            <label for="andamento1">Andamento Meta 1:</label>
            <textarea id="andamento1" name="andamentos[]" required></textarea>

<<<<<<< HEAD
            <label for="objetivo1">Objetivo Meta 1:</label>
            <textarea id="objetivo1" name="objetivos[]" required></textarea>
=======
    <label for="comentarios">Comentários:</label>
    <textarea id="comentarios" name="comentarios" required></textarea>
    <label for="anexos">Anexos:</label>
    <input type="file" id="anexos" name="anexos[]" multiple> <br> <br>
>>>>>>> 4d0124dcf69368868606ef6bc2fd08fa9d1cf521

            <!-- Meta 2 -->
            <label for="meta2">Meta 2:</label>
            <textarea id="meta2" name="metas[]" required></textarea>

            <!-- Comentários da Meta 2 -->
            <label for="prazo2">Prazo Meta 2:</label>
            <textarea id="prazo2" name="prazos[]" required></textarea>

            <label for="andamento2">Andamento Meta 2:</label>
            <textarea id="andamento2" name="andamentos[]" required></textarea>

            <label for="objetivo2">Objetivo Meta 2:</label>
            <textarea id="objetivo2" name="objetivos[]" required></textarea>

            <!-- Meta 3 -->
            <label for="meta3">Meta 3:</label>
            <textarea id="meta3" name="metas[]" required></textarea>

            <!-- Comentários da Meta 3 -->
            <label for="prazo3">Prazo Meta 3:</label>
            <textarea id="prazo3" name="prazos[]" required></textarea>

            <label for="andamento3">Andamento Meta 3:</label>
            <textarea id="andamento3" name="andamentos[]" required></textarea>

            <label for="objetivo3">Objetivo Meta 3:</label>
            <textarea id="objetivo3" name="objetivos[]" required></textarea>

            <label for="comentarios">Comentários Gerais:</label>
            <textarea id="comentarios" name="comentarios" required></textarea>

            <label for="anexos">Anexos:</label>
            <input type="file" id="anexos" name="anexos[]" multiple>

            <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
        </form>
    </div>

    <nav>
        <a href="..\perfil/perfil.php">Perfil</a>
        <a href="relatorios.php">Relatórios</a>
        <a href="..\atividades/atividades.php">Atividades</a>
    </nav>

</body>

</html>
