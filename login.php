<?php 

$dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);
if(!empty($dados["entrar"])){
   if(!empty($dados["login"]) && !empty($dados["senha"])){
    require_once "bd_Login.php";
    $slog = new login();
    $slog->login($dados['login'],$dados['senha']);
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SergipeTec - Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .title-container h1 {
            color: #8e44ad; /* Roxo */
            margin: 0;
        }

        .title-container h2 {
            color: #2ecc71; /* Verde */
            margin-top: 5px;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container a {
            text-decoration: none;
            color: #333;
            margin-right: 10px;
        }

        .login-container input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="title-container">
    <h1>SergipeTec</h1>
    <h2>Sergipe Parque Tecnológico</h2>
</div>

<div class="login-container">
    <h2>Login</h2>
    <form action="#" method="POST">
        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>
        <a href="novologin.php">Não tenho cadastro</a>
        <input type="submit" name="entrar" value="Entrar">
    </form>
</div>

</body>
</html>
