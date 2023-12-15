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

// Inicializar variável de status
$status = '';
$uploadStatus = '';

// Processar o envio do formulário de status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_form'])) {
    // Obter o status do formulário
    $novoStatus = $_POST['status'];

    // Atualizar o status no banco de dados
    try {
        $conexao = new Conexao();
        $conn = $conexao->connect();

        // Atualizar o status do usuário
        $sql = "UPDATE login SET status = :status WHERE cpf = :cpf";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $novoStatus);
        $stmt->bindParam(':cpf', $login);
        $stmt->execute();

        $status = 'Status atualizado com sucesso.';
    } catch (Exception $e) {
        echo "DEBUG: Erro de conexão: " . $e->getMessage();
        exit();
    } finally {
        // Fechar a conexão com o banco de dados
        $conn = null;
    }
}

// Processar o envio do formulário de foto de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photo_form'])) {
    // Diretório onde as fotos de perfil serão armazenadas
    $photoDir = 'uploads/profile_photos/';

    // Nome único para o arquivo de destino
    $photoFileName = $login . '_' . time() . '_' . basename($_FILES['photo']['name']);
    $photoPath = $photoDir . $photoFileName;

    // Verificar se o arquivo é uma imagem real
    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check !== false) {
        // Tentar mover o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            $uploadStatus = 'Foto de perfil atualizada com sucesso.';
        } else {
            $uploadStatus = 'Erro ao fazer o upload da foto de perfil.';
        }
    } else {
        $uploadStatus = 'O arquivo não é uma imagem válida.';
    }
}

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333; /* Texto em tom de cinza escuro */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa; /* Fundo em tom de cinza claro */
        }

        nav {
            background-color: #343a40; /* Azul acinzentado escuro */
            overflow: hidden;
            text-align: center;
            width: 100%;
            position: absolute;
            top: 0;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .content {
            text-align: center;
            margin-top: 20px;
            background-color: #fff; /* Fundo branco */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #007bff;
        }

        #statusForm, #photoForm {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #statusForm textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #statusForm input[type="submit"], #photoForm input[type="submit"] {
            border: none;
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #statusForm input[type="submit"]:hover, #photoForm input[type="submit"]:hover {
            background-color: #218838;
        }

        #statusDisplay, #photoDisplay {
            margin-top: 20px;
        }

        #photoDisplay img {
            max-width: 300px; /* Defina o tamanho máximo desejado para a imagem */
            height: auto;
        }
    </style>
</head>
<body>

<!-- Conteúdo da Página -->
<div class="content">
     <!-- Exibir a foto de perfil se estiver definida -->
     <div id="photoDisplay">
        <?php
        if (isset($photoFileName)) {
            echo '<img src="' . htmlspecialchars($photoPath) . '" alt="Foto de Perfil">';
        } else {
            echo '<p>Nenhuma foto de perfil disponível.</p>';
        }
        ?>
    </div>
    <h2>Perfil</h2>

    <!-- Exibir informações do usuário -->
    <p><strong>Login:</strong> <?php echo $usuario['login']; ?></p>
    <p><strong>CPF:</strong> <?php echo $usuario['cpf']; ?></p>
    <p><strong>Perfil:</strong> <?php echo $usuario['perfil']; ?></p>

    <!-- Adicionar campo de status -->
    <h3>Status</h3>
    <div id="statusForm">
        <?php echo '<p>' . $status . '</p>'; ?>

        <!-- Exibir formulário de status -->
        <form action="perfil.php" method="post" id="statusForm">
            <label for="status">Status:</label><br>
            <textarea id="status" name="status" rows="4" cols="50"><?php echo htmlspecialchars($usuario['status']); ?></textarea><br>
            <input type="submit" value="Atualizar Status" name="status_form">
        </form>
    </div>

    <!-- Exibir o status se estiver definido -->
    <div id="statusDisplay">
        <?php
        if (isset($usuario['status'])) {
            echo '<p>' . nl2br(htmlspecialchars($usuario['status'])) . '</p>';
        } else {
            echo '<p>Nenhum status disponível.</p>';
        }
        ?>
    </div>

    <!-- Adicionar campo de foto de perfil -->
    <h3>Foto de Perfil</h3>
    <div id="photoForm">
        <?php echo '<p>' . $uploadStatus . '</p>'; ?>

        <!-- Exibir formulário de foto de perfil -->
        <form action="perfil.php" method="post" id="photoForm" enctype="multipart/form-data">
            <label for="photo">Escolher uma foto:</label><br>
            <input type="file" name="photo" id="photo"><br>
            <input type="submit" value="Atualizar Foto de Perfil" name="photo_form">
        </form>
    </div>

   
</div>

<nav>
<a href = "https://sergipetec.org.br"<div id="sergipeTec">Sergipe<span style="color: #2ecc71;">Tec</span></div></a>
  <a href="perfil.php">Perfil</a>
    <a href="relatorios.php">Relatórios</a>
    <a href="projetos.php">Projetos</a>
    <a href="ger_atividades.php">Gerenciar atividades</a>
    <a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a> 
</nav>
</nav>

</body>
</html>
