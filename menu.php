<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XERECA</title>
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
            text-align: left;
            width: 100%;
            position: absolute;
            top: 0;
        }

        nav a {
            display: inline;
            color: white;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-size: 30px;
        }

        nav a:hover {
            background-color: #c82333;
        }
        nav img{
            text-align: left;
            height: 100px; /* Altura da imagem ajustável conforme necessário */
            margin-right: 50px;
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
<!-- Formulário de Personalização -->
<form id="formPersonalizar">
    <label for="corFundo">Cor de Fundo:</label>
    <input type="color" id="corFundo" name="corFundo" value="#f8f9fa">
    <input type="submit" value="Trocar Cor">
</form>

<!-- Conteúdo da Página -->
<div class="content">
    <h1>Sistema de Gestão</h1>
    <h1>Ainda em Desenvolvimento</h1>
</div>

<nav>
    <a href="https://sergipetec.org.br/" title="Sergipetec" rel="home">
        <img data-interchange="[http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png, (default)], [http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec600x280.png, (retina)]" alt="" class="hideie" data-uuid="62ab370c-836f-46ab-4978-ee131e86227d" src="http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png">
        <noscript><img src='http://sergipetec.org.br/wp-content/uploads/2016/04/sergipetec300x140.png' alt='Sergipetec'></noscript>
    </a>
    <a href="perfil.php">Perfil</a>
    <a href="https://www.youtube.com/watch?v=WgntYmo7Uho">ouça</a>
    <a href="relatorios.php">Relatórios</a>
    <a href="projetos.php">Projetos</a>
    <a href="ger_atividades.php">Gerenciar atividades</a>
    <a href="https://www.instagram.com/levinxs_14/">cnpjotopow?</a>
</nav>

<!-- Script de Personalização -->
<script>
    document.getElementById('formPersonalizar').addEventListener('submit', function (event) {
        event.preventDefault();

        // Trocar cor de fundo da página
        var corFundo = document.getElementById('corFundo').value;
        document.body.style.backgroundColor = corFundo;

        // Trocar cor da mensagem
        var h1 = document.querySelector('h1');
        h1.style.color = h1.style.color === '#343a40' ? '#c82333' : '#343a40';
    });
</script>

</body>
</html>
