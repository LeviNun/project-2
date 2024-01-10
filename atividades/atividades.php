<?php
include "bd_conectar.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method = "POST">
    <label for="LabelBuscar">Adicionar funcionarios </label>
    <input type="text" name = "busca" placeholder = "adicione funcionarios">
    <label for="mostrar"> </label>
    <button type="submit" name="buttonBuscar" > Buscar funcionario </button> <br>
</form>
<?php

if (!isset($_POST['busca'])) {
    session_start();
    $cpf=$_SESSION['login'];
    $sqlii = "SELECT * FROM login WHERE cpf='$cpf'";
    $sql_queryy = $mysqli->query($sqlii) or die("ERRO ao consultar! " . $mysqli->error); 
    $dadosde = $sql_queryy->fetch_assoc();
    $nomede = $dadosde['nome'];
    $chavesql = "SELECT * FROM notatividades WHERE para='$nomede'";
    $sql_query = $mysqli->query($chavesql) or die("ERRO ao consultar! " . $mysqli->error); 
    
    if($sql_query->num_rows != 0){
        while($dadosde = $sql_query->fetch_assoc()){
            ?>
            <h5> <?php echo $dadosde['projeto']?></h5>
            <?php
        }
    }
}
?>
</body>
</html>