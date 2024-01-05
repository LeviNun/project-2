<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['setores'])) {
        $setorSelecionado = $_POST['setores'];
        echo "Você selecionou o setor: $setorSelecionado";
    } else {
        echo "Nenhum setor selecionado.";
    }
}
?>
