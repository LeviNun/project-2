<<<<<<< Updated upstream
<?php
include "bd_conectar.php";
=======
<?php 
include '..\<projetos/projj.php';
require_once "..\banodedados/bd_conectar.php";
session_start(); 
>>>>>>> Stashed changes

if (!isset($_POST['busca'])) {
    session_start();
    $cpf=$_SESSION['login'];
    $sqlii = "SELECT * FROM login WHERE cpf='$cpf'";
    $sql_queryy = $mysqli->query($sqlii) or die("ERRO ao consultar! " . $mysqli->error); 
    $dadosde = $sql_queryy->fetch_assoc();
    $nomede = $dadosde['cpf'];
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