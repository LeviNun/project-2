
<?php 
$dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);
if(!empty($dados["entrar"])){
   if(!empty($dados["login"]) && !empty($dados["senha"]) && isset($dados["cpf"])){
    require_once "bd_novologin.php";
    $slog = new Novologin();
    $slog->novologin($dados['login'],$dados['senha'],$dados['cpf'],$dados['nome'],$dados['perfil']);
   }
   
}
//testando conexao

//$con= new Conexao();

//$conectado= $con->connect()

?>
<!DOCTYPE html>
<html lang="PT-br">
<head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylenovologin.css">
    <title>SergipeTec - Login</title>

</head>
<body class ="body">

<div class="title-container">
    <h1>SergipeTec</h1>
    <h2>Sergipe Parque Tecnológico</h2>
</div>

<div class="login-container">
    <h2 class ="cancelar">Cadastro</h2>
    <form action="#" method="POST">

        <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        </div>

        <div>
        <label for="cpf">CPF:</label>
        <input class = "input" maxlength="14" pattern="[\d.-]{14}" type="text" id="cpf" name="cpf" required>
        </div>

        <div>
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        </div>

        <div>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        </div>

        <div>
        <label for="perfil">Perfil:</label>
        <select name = "perfil">
            <Option>funcionario</Option>
            <option>gestor</option>
        </select required><br><br>
        </div>

        <div>
        <i class="bi bi-eye-fill" id="btn-senha" onclick="mostrarSenha()"></i>
        <a class = "cancelar" href="..\login/login.php">Cancelar</a>
        <input class ="button" type="submit" name="entrar" value="entrar">
        </div>
        
    </form>
    
</div>

</body>
</html>


</body>
</html>
