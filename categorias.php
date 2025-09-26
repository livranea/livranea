<?php
include_once('session.php');
require_once 'User.php';

$user = new User();

// Definir limite por página
$limite = 8;

// Página atual (default = 1)
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
if ($pagina < 1) $pagina = 1;

// Calcular offset
$offset = ($pagina - 1) * $limite;

// Inicializar variáveis
$livros = [];
$totalLivros = 0;
$totalPaginas = 1;

// Caso seja pesquisa
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $termo = $_GET['search'];
    $livros = $user->pesquisarLivros($termo, $limite, $offset);
    $totalLivros = $user->contarLivrosPesquisa($termo);
}
// Caso seja categoria
elseif (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $livros = $user->getLivrosCategoriaPaginado($categoria, $limite, $offset);
    $totalLivros = $user->contarLivrosCategoria($categoria);
}
// Caso seja todos os livros
else {
    $livros = $user->getLivrosPaginados($limite, $offset);
    $totalLivros = $user->contarLivros();
}

$totalPaginas = ceil($totalLivros / $limite);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Livrânea - Categorias</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-padrao.css" rel="stylesheet">
    <link href="css/style-livro.css" rel="stylesheet">
</head>

<body>
    <?php include('funcoes/header.php'); ?>

    <div class="container mt-5 title-section">
        <h1 style="margin-bottom: 25px">CATEGORIAS DE LIVROS</h1>
        <div class="row">
            <div class="col-md-6">
                <a href="?categoria=Literatura Clássica" class="btn btn-custom w-100 mb-2">📖 Literatura Clássica</a>
                <a href="?categoria=Autoajuda" class="btn btn-custom w-100 mb-2">💡 Autoajuda</a>
                <a href="?categoria=Tecnologia" class="btn btn-custom w-100 mb-2">💻 Tecnologia</a>
            </div>
            <div class="col-md-6">
                <a href="?categoria=Livros Didáticos" class="btn btn-custom w-100 mb-2">📒 Livros Didáticos</a>
                <a href="?categoria=História e Cultura" class="btn btn-custom w-100 mb-2">🌍 História e Cultura</a>
                <a href="?categoria=Infantojuvenil" class="btn btn-custom w-100 mb-2">🧸 Infantojuvenil</a>
            </div>
        </div>

        <h2 class="mt-5"><strong>Resultados</strong></h2>
        <div class="row">
            <?php if (!empty($livros)): ?>
                <?php foreach ($livros as $livro): ?>
                    <div class="col-md-3 text-center mb-4">
                        <div class="h-100">
                            <a href="verlivro.php?id=<?php echo $livro['id']; ?>">
                                <img src="<?php echo $livro['capa']; ?>"
                                    alt="<?php echo htmlspecialchars($livro['nome']); ?>"
                                    style="width:150px; height:220px; object-fit:cover; border-radius:8px; margin-bottom: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
                            </a>
                            <p style="margin-bottom: -2px;"><strong><?php echo htmlspecialchars($livro['nome']); ?></strong></p>
                            <p><?php echo htmlspecialchars($livro['autor']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum livro encontrado.</p>
            <?php endif; ?>
        </div>

        <!-- PAGINAÇÃO -->
        <?php if ($totalPaginas > 1): ?>
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">
                        <?php if ($pagina > 1): ?>
                            <li class="page-item">
                                <a class="btn-paginacao" href="?<?= http_build_query(array_merge($_GET, ["pagina" => $pagina - 1])); ?>">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                                <a class="btn-paginacao <?= $i == $pagina ? 'active' : '' ?>"
                                    href="?<?= http_build_query(array_merge($_GET, ["pagina" => $i])); ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($pagina < $totalPaginas): ?>
                            <li class="page-item">
                                <a class="btn-paginacao" href="?<?= http_build_query(array_merge($_GET, ["pagina" => $pagina + 1])); ?>">Próxima</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>