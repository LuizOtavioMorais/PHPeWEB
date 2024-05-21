<?php
$diretorio = __DIR__ . '/banco-sqlite';
$PDO = new PDO("sqlite:$diretorio");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id !== false) {
    $sqlremove = "DELETE FROM videos WHERE id = :id";
    $statement = $PDO->prepare($sqlremove);
    $statement->bindValue('id', $id, PDO::PARAM_INT);

    if($statement->execute()){
        echo "Deu tudo certo";
        header ('Location: index.php?sucesso=3');
    }
    else {
    header ('Location: index.php?sucesso=4');
}}



//if ($statement->execute === false){
//    header ('Location: index.php?sucesso=0');
//}
//
//else {
//    header ('Location: index.php?sucesso=1');
//}}
