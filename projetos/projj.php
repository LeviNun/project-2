<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o botão de criação de projeto foi pressionado
    if (isset($_POST['criar_projeto'])) {
        $nome_projeto = $_POST['nome_projeto'];
        
        // Cria uma pasta para o projeto
        if (!file_exists($nome_projeto)) {
            mkdir('projetos/' . $nome_projeto);
            echo "Projeto '$nome_projeto' criado com sucesso.";
        } else {
            echo "O projeto '$nome_projeto' já existe.";
        }
    }
}
    // Verifica se o botão de adição de setor foi pressionado
    if (isset($_POST['adicionar_setor'])) {
        $nome_projeto = $_POST['projeto'];
        $nome_setor = $_POST['nome_setor'];
        
        // Cria uma pasta para o setor dentro do projeto
        $caminho_setor = 'projetos/' . $nome_projeto . '/' . $nome_setor;
        // Exemplo de adição de mensagens de erro
        if (!file_exists($caminho_setor)) {
              if (mkdir($caminho_setor)) {
                echo "Setor '$nome_setor' adicionado ao projeto '$nome_projeto' com sucesso.";
                
                  } else {
                 echo "Erro ao criar o setor '$nome_setor' no projeto '$nome_projeto'.";
            }
                } else {
                echo "O setor '$nome_setor' já existe no projeto '$nome_projeto'.";
                        }

                         // Verifica se o botão de upload de relatório foi pressionado
    if (isset($_POST['upload_relatorio'])) {
        $nome_projeto = $_POST['projeto'];
        $nome_setor = $_POST['setor'];

        // Define o caminho para a pasta do setor
        $caminho_setor = 'projetos/' . $nome_projeto . '/' . $nome_setor . '/';
        // Verifica se o diretório do setor existe
        if (file_exists($caminho_setor)) {
            $arquivo_temporario = $_FILES["arquivo"]["tmp_name"];
           $nome_arquivo = basename($_FILES["arquivo"]["name"]);
           $caminho_destino_completo = $caminho_setor . DIRECTORY_SEPARATOR . $nome_arquivo;

    if (move_uploaded_file($arquivo_temporario, $caminho_destino_completo)) {
        echo "Arquivo '$nome_arquivo' enviado para a pasta '$pasta_destino' com sucesso.";
    } else {
        echo "Erro ao enviar o arquivo.";
    }
}
    }
}                       
      // Função para obter a lista de projetos e setores
function obterProjetosSetores() {
    $projetosSetores = array();

    // Obtém todos os projetos no diretório atual
    $projetos = glob('*', GLOB_ONLYDIR);

    foreach ($projetos as $projeto) {
        // Para cada projeto, obtém os setores no diretório do projeto
        $setores = glob($projeto . '/*', GLOB_ONLYDIR);
        $projetosSetores[$projeto] = $setores;
    }

    return $projetosSetores;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica de gerenciamento adicional pode ser adicionada aqui conforme necessário
}

?>