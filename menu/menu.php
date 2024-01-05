<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
require_once "bd_conectar.php";

// Obter o login do usuário da sessão
$login = $_SESSION['login'];
// Consultar o banco de dados para obter informações do usuário
try {
    $conexao = new Conexao();
    $conn = $conexao->connect();

    // Consultar informações do usuário usando o campo de login
    $sql = "SELECT * FROM login WHERE cpf = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $login);
    $stmt->execute();

    // Obter os resultados da consulta
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se a consulta retornou resultados
    if (!$usuario) {
        echo "DEBUG: Usuário não encontrado no banco de dados.";
        exit();
    }
} catch (Exception $e) {
    echo "DEBUG: Erro de conexão: " . $e->getMessage();
    exit();
} finally {
    // Fechar a conexão com o banco de dados
    $conn = null;
}
?>
    
<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylemenu.css">
    <title>TESTE</title>
</head>
<body class = "body">
<!-- Conteúdo da Página -->
<div class="content">
    <h1>Sistema de Gestão</h1>
    <h1>Ainda em Desenvolvimento</h1>
</div>

<nav class = "nav">
    <a href="https://sergipetec.org.br/" title="Sergipetec" rel="home">
        <img data-interchange="[http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png, (default)], [http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec600x280.png, (retina)]" alt="" class="hideie" data-uuid="62ab370c-836f-46ab-4978-ee131e86227d" src="http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png">
        <noscript><img src='http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png' alt='Sergipetec'></noscript>
    </a>
    <a href="..\perfil/perfil.php">Meu perfil</a>
    <?php
    if($usuario['perfil'] == 'gestor'){
    echo '<a id = "ger" href = "..\gerenciaratividades/ger_atividades.php">Gerenciar atividades</a>';
    echo '<a href="..\projetos/projetos.php">Projetos</a>';
    }else if($usuario['perfil'] == 'funcionario'){
        echo '<a id = "ger" href = "..\atividades/atividades.php">Atividades</a>';
        echo '<a href="..\relatorios/relatorios.php">Relatorios</a>';
    }
    ?>
</nav>
</body>
</html>