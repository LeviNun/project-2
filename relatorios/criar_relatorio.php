<?php include 'criarel.php'?>
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
<<<<<<< Updated upstream
=======
<script>
        function toggleMetasVisibility() {
            var meta2 = document.getElementById('meta2');
            var prazo2 = document.getElementById('prazo2');
            var andamento2 = document.getElementById('andamento2');
            var objetivo2 = document.getElementById('objetivo2');

            var meta3 = document.getElementById('meta3');
            var prazo3 = document.getElementById('prazo3');
            var andamento3 = document.getElementById('andamento3');
            var objetivo3 = document.getElementById('objetivo3');

            var checkboxMeta2 = document.getElementById('adicionar_meta2');
            var checkboxMeta3 = document.getElementById('adicionar_meta3');

            meta2.style.display = checkboxMeta2.checked ? 'block' : 'none';
            prazo2.style.display = checkboxMeta2.checked ? 'block' : 'none';
            andamento2.style.display = checkboxMeta2.checked ? 'block' : 'none';
            objetivo2.style.display = checkboxMeta2.checked ? 'block' : 'none';

            meta3.style.display = checkboxMeta3.checked ? 'block' : 'none';
            prazo3.style.display = checkboxMeta3.checked ? 'block' : 'none';
            andamento3.style.display = checkboxMeta3.checked ? 'block' : 'none';
            objetivo3.style.display = checkboxMeta3.checked ? 'block' : 'none';
        }
    </script>
>>>>>>> Stashed changes
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
    <textarea id="metas" name="metas" required></textarea>

    <label for="comentarios">Comentários:</label>
    <textarea id="comentarios" name="comentarios" required></textarea>
    <label for="anexos">Anexos:</label>
    <input type="file" id="anexos" name="anexos[]" multiple>

<<<<<<< Updated upstream
    
    <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
</form>
</div>

<nav>
    <a href="..\perfil/perfil.php">Perfil</a>
    <a href="relatorios.php">Relatórios</a>
    <a href="..\atividades/atividades.php">Atividades</a>
</nav>
=======
            <!-- Meta 2 -->
    <label for="adicionar_meta2">Adicionar Meta 2:</label>
    <input type="checkbox" id="adicionar_meta2" onclick="toggleMetasVisibility()">

        <label for="meta2">Meta 2:</label>
        <textarea id="meta2" name="metas[]"></textarea>

        <!-- Comentários da Meta 2 -->
        <label for="prazo2">Prazo Meta 2:</label>
        <textarea id="prazo2" name="prazos[]"></textarea>

        <label for="andamento2">Andamento Meta 2:</label>
        <textarea id="andamento2" name="andamentos[]"></textarea>

        <label for="objetivo2">Objetivo Meta 2:</label>
        <textarea id="objetivo2" name="objetivos[]"></textarea>
  

    <!-- Meta 3 -->
    <label for="adicionar_meta3">Adicionar Meta 3:</label>
    <input type="checkbox" id="adicionar_meta3" onclick="toggleMetasVisibility()">

        <label for="meta3">Meta 3:</label>
        <textarea id="meta3" name="metas[]"></textarea>

        <!-- Comentários da Meta 3 -->
        <label for="prazo3">Prazo Meta 3:</label>
        <textarea id="prazo3" name="prazos[]"></textarea>

        <label for="andamento3">Andamento Meta 3:</label>
        <textarea id="andamento3" name="andamentos[]"></textarea>

        <label for="objetivo3">Objetivo Meta 3:</label>
        <textarea id="objetivo3" name="objetivos[]"></textarea>

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
>>>>>>> Stashed changes

</body>
</html>