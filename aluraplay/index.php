<?php
$diretorio = __DIR__ . '/banco-sqlite';
$PDO = new PDO("sqlite:$diretorio");
$listaDeVideos = $PDO->query("SELECT * FROM videos;")->fetchAll(PDO::FETCH_ASSOC);

$msgfeedback = '';

$sucesso = filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_INT);

if ($sucesso !== null && $sucesso !== false) {
    switch ($sucesso) {
        case 1:
            $msgfeedback = 'Vídeo EDITADO com SUCESSO';
            break;
        case 0:
            $msgfeedback = 'Houve um erro ao editar o vídeo';
            break;
        case 3:
            $msgfeedback = 'Vídeo removido com SUCESSO';
            break;
        case 4:
            $msgfeedback = 'Erro ao remover video';
            break;
        default:
            $msgfeedback = 'ID desconhecido';
    }
}
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
    <p><?php echo $msgfeedback; ?></p>
    <?php foreach($listaDeVideos as $video): ?>
        <?php if (str_starts_with($video['url'], 'http')): ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?php echo $video['url']; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video['titulo']; ?></h3>
                    <div class="acoes-video">
                        <a href="<?php echo './telaeditar.php?id=' . $video['id']; ?>">Editar</a>
                        <a href="<?php echo './remover-video.php?id=' . $video['id']; ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>

</ul>
</body>

</html>
