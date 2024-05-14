<?php
//O QUE ACONTECE AQUI?,  CADA VEZ MAIS É ADICIONADO VIDEOS AO BANCO DE DADOS,
// QUE VIRA UMA LISTA NESSA PAGINA, E ELES SAO EXIBIDOS NA LISTA DESORNADA ATRAVES DO
//FOREACH QUE NAVEGA PELA LISTA EXPONDO SUA URL E SEU TITULO NOS DEVIDOS LUGARES.
$diretorio = __DIR__ . '/banco-sqlite';
$PDO = new PDO("sqlite:$diretorio");
$listaDeVideos = $PDO->query("SELECT * FROM videos;")->fetchall(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="index.php"></a>

            <div class="cabecalho__icones">
                <a href="./pages/enviar-video.html" class="cabecalho__videos"></a>
                <a href="./pages/login.html" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>
    <ul class="videos__container" alt="videos alura">
    <!--  DENTRO DE UMA LISTA DESRODANADA ESTA O FOREACH, ELE
   É FECHADO NO FINAL COM ABERTURAS PHP-->
    <?php foreach($listaDeVideos as $video):?>
     <?php   if (str_starts_with($video['url'], 'http')):?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src=<?php echo $video['url'];?>
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?php echo $video['titulo']; ?></h3>
                <div class="acoes-video">
                    <a href="./telaeditar.php?id=<?= $video['id']; ?>">Editar</a>
                    <a href="./remover-video.php?id=<?= $video['id']; ?>">Excluir</a>
                </div>
            </div>
        </li>
        <?php endif; ?>
        <?php endforeach;?>

    </ul>
</body>

</html>