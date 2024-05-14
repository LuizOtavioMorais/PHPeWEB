<?php
$msgFeedback = "";
if (isset ($_POST)) {
    if (!EMPTY($_POST['url-input']) && !EMPTY($_POST['titulo-input'])) {
        $diretorio = __DIR__ . '/banco-sqlite';
        $PDO = new PDO("sqlite:$diretorio");

        $dadosVideo = [
            "url" => $_POST['url-input'],
            "titulo" => $_POST['titulo-input']
        ];

        $sqlInsertVideo = "INSERT INTO videos VALUES (NULL, :url, :titulo)";
        $adicionar = $PDO->PREPARE($sqlInsertVideo);

        if ($adicionar->execute($dadosVideo) === false){
            header('Location: /index.php?sucesso=0');
        }
        else{
            header('Location: /index.php?sucesso=1');
        }
    }
    else {
        $msgFeedback = "Houve um ERRO ao adicionar o video";
    }


}
