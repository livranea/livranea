<?php
include_once('session.php');
require_once 'User.php';

$user = new User();

$ids = [1, 4, 8, 10];

$livros = [];
foreach ($ids as $id) {
    $livro = $user->getLivroById($id);
    if ($livro) {
        $livros[] = $livro;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Livrânea - Sugestões do Dia</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style-padrao.css">
    <link rel="stylesheet" href="css/style-livro.css">

</head>

<body>
    <?php include('funcoes/header.php'); ?>

    <div class="container sugestoes-container title-section">
        <h1 class="text-center mb-4">SUGESTÕES DO DIA</h1>
        <div class="row">
            <?php foreach ($livros as $livro): ?>
                <div class="col-md-3 mb-4">
                    <div class="livro-card">
                        <img src="<?php echo !empty($livro['capa']) ? $livro['capa'] : 'image/capa-padrao.png'; ?>"
                            alt="<?php echo htmlspecialchars($livro['nome']); ?>"
                            class="livro-capa2">
                        <div class="livro-info">
                            <h5><strong><?php echo htmlspecialchars($livro['nome']); ?></strong></h5>
                            <p><strong>Autor:</strong> <?php echo htmlspecialchars($livro['autor']); ?></p>
                            <p><strong>Categoria:</strong> <?php echo htmlspecialchars($livro['categoria']); ?></p>
                            <div class="btn-wrapper">
                                <a href="verlivro.php?id=<?php echo $livro['id']; ?>" class="btn btn-color w-100">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>