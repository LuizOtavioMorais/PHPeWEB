<?php
$diretorio = __DIR__ . '/banco-sqlite';
$PDO = new PDO("sqlite:$diretorio");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$titulo = filter_input(INPUT_POST, 'titulo-input', FILTER_SANITIZE_STRING);
$url = filter_input(INPUT_POST, 'url-input', FILTER_VALIDATE_URL);

if ($id !== false && !empty($titulo) && !empty($url)){
$sqledit = "UPDATE videos SET titulo = :titulo, url = :url WHERE id = :id;";
$statement = $PDO->prepare($sqledit);
    $statement->bindvalue(':titulo', $titulo, PDO::PARAM_STR);
    $statement->bindvalue(':url', $url, PDO::PARAM_STR);
    $statement->bindvalue(':id', $id, PDO::PARAM_INT);

if ($statement->execute() === true){
    header('Location: ./index.php?sucesso=1');
    exit();
}
else {
    header('Location: ./index.php?sucesso=0');
    exit();

}
}
else {
    header('Location: ./index.php?sucesso=0');
    exit();
}