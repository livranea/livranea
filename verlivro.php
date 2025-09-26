<?php
include_once('session.php');
require_once 'User.php';

$user = new User();
$livro = null;

if (isset($_GET['id'])) {
    $livro = $user->getLivroById($_GET['id']);
}

if (!$livro) {
    echo "<p>Livro não encontrado.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Livrânea - <?php echo htmlspecialchars($livro['nome']); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style-padrao.css">
    <link rel="stylesheet" href="css/style-livro.css">
</head>

<body>
    <?php include('funcoes/header.php'); ?>

    <div class="container livro-container">
        <div class="row align-items-start">
            <div class="col-md-4 text-center">
                <img src="<?php echo !empty($livro['capa']) ? $livro['capa'] : 'image/capa-padrao.png'; ?>"
                    alt="<?php echo htmlspecialchars($livro['nome']); ?>"
                    class="livro-capa">
            </div>
            <div class="col-md-8 livro-detalhes title-section">
                <h1><?php echo htmlspecialchars($livro['nome']); ?></h1>
                <h2><?php echo htmlspecialchars($livro['autor']); ?></h2>

                <p><strong>Sinopse:</strong><br><?php echo nl2br(htmlspecialchars($livro['sinopse'])); ?></p>

                <p><strong>Número de páginas:</strong> <?php echo htmlspecialchars($livro['paginas']); ?></p>
                <p><strong>Categoria:</strong> <?php echo htmlspecialchars($livro['categoria']); ?></p>

                <br>

                <?php if (!empty($livro['arquivo'])): ?>
                    <a href="<?php echo $livro['arquivo']; ?>" class="btn-color mt-3" target="_blank">Download do Livro</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>