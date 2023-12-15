<?php
session_start();

// Adicionar condição para criar relatório
if (isset($_POST['criar_relatorio_form'])) {
    // Redirecionar para a página de criação de relatório
    header("Location: criar_relatorio.php");
    exit();
}

// Adicionar condição para apagar relatório
if (isset($_GET['acao']) && $_GET['acao'] === 'apagar' && isset($_GET['relatorio'])) {
    $relatorioIndex = $_GET['relatorio'];

    // Verificar se o índice do relatório existe na sessão
    if (isset($_SESSION['relatorios'][$relatorioIndex])) {
        // Apagar o relatório
        unset($_SESSION['relatorios'][$relatorioIndex]);

        // Reorganizar os índices do array após a exclusão
        $_SESSION['relatorios'] = array_values($_SESSION['relatorios']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
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
    </style>
</head>
<body>

<!-- Conteúdo da Página -->
<div class="content">
    <h2>Relatórios</h2>

    <?php
    // Verificar se há relatórios na variável de sessão
    if (isset($_SESSION['relatorios']) && !empty($_SESSION['relatorios'])) {
        // Exibir lista de relatórios disponíveis com links para mostrar e apagar cada um
        echo '<p>Há relatórios disponíveis. Escolha um abaixo para mostrar ou apagar:</p>';
        foreach ($_SESSION['relatorios'] as $index => $relatorio) {
            echo '<p>';
            echo '<a href="mostrar_relatorio.php?relatorio='.$index.'">Relatório '.($index + 1).'</a>';
            echo ' | ';
            echo '<a href="relatorios.php?acao=apagar&relatorio=' . $index . '">Apagar</a>';
            echo '</p>';
        }
    } else {
        echo '<p>Nenhum relatório disponível.</p>';
    }
    ?>

    <!-- Adicionar opção para criar relatório -->
    <h3>Criar Relatório</h3>
    <form action="relatorios.php" method="post">
        <input type="submit" value="Criar Relatório" name="criar_relatorio_form">
    </form>
</div>

<nav>
<a href="https://sergipetec.org.br/" title="Sergipetec" rel="home">
				<img data-interchange="[http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png, (default)], [http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec600x280.png, (retina)]" alt="" class="hideie" data-uuid="62ab370c-836f-46ab-4978-ee131e86227d" src="http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png">
				<noscript><img src='http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png' alt='Sergipetec'></noscript>
            </a>
    <h2> SISTEMA DE GESTAO <h2>
    <a href = "https://sergipetec.org.br"<div id="sergipeTec">Sergipe<span style="color: #2ecc71;">Tec</span></div></a>
  <a href="perfil.php">Perfil</a>
  <a href="menu.php">menu</a>
    <a href="relatorios.php">Relatórios</a>
    <a href="projetos.php">Projetos</a>
    <a href="ger_atividades.php">Gerenciar atividades</a>
    <a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a> 
</nav>

</body>
</html>
