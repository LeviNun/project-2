<?php include 'criarel.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pasta_de_estilos/criar_relatorio.css">
    <title>Criar Relatório - SergipeTec</title>
  
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
    <textarea id="metas" name="metas" required></textarea>

    <label for="comentarios">Comentários:</label>
    <textarea id="comentarios" name="comentarios" required></textarea>
    <label for="anexos">Anexos:</label>
    <input type="file" id="anexos" name="anexos[]" multiple> <br> <br>

    
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