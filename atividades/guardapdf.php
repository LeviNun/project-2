<?php
 require_once "..\banodedados/bd_conectar.php";
 session_start();
 $nome_projeto = $_SESSION['nome_projeto'];
 $nome_setor = $_SESSION['nome_setor'];
 $arquivo = $_FILES['arquivo'];
 
  // Caminho da pasta que você deseja criar
$caminhoDaPasta = '..\documentos/'. $nome_projeto. "/" . $nome_setor;

// Verifica se a pasta não existe antes de criar
if (!file_exists($caminhoDaPasta)) {
    // Tenta criar a pasta
    if (mkdir($caminhoDaPasta, 0777, true)) {
        echo 'Pasta criada com sucesso!';
    } else {
        echo 'Erro ao criar a pasta.';
    }
} else {
    echo 'A pasta já existe.';
}
if($arquivo !== null){
    preg_match("/\.(pdf){1}$/i", $arquivo["name"], $ext);
    if($ext == true){
        $nome_arquivo = md5(uniqid(time())) .".".$ext[1];
        $caminho_aquivo ="..\documentos/". $nome_projeto. "/" . $nome_setor ."/" . $nome_arquivo;
        $caminho_arquivo = $caminhoDaPasta . "/" . $nome_arquivo;
        move_uploaded_file($arquivo["tmp_name"], $caminho_aquivo);
    }
}
?>