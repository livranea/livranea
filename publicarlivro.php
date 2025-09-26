<?php
include_once('session.php');
if ($_SESSION['email'] !== "livranea@gmail.com") {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Livrânea - Cadastro de Livro</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-padrao.css" rel="stylesheet">
    <link href="css/style-login.css" rel="stylesheet">
</head>

<body>
    <?php include('funcoes/header.php'); ?>

    <?php
    require_once 'User.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User();
        if ($user->cadastrarLivro($_POST, $_FILES)) {
            echo "<script>alert('Livro cadastrado com sucesso!'); window.location.href='categorias.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar o livro.');</script>";
        }
    }
    ?>

    <div class="container" style="margin-top: 100px; max-width:600px;">
        <h2><strong>Cadastrar Livro</strong></h2>
        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Área da capa -->
            <label class="capa-container" for="capa">
                <span class="capa-placeholder">Definir capa...</span>
                <img id="previewImg" alt="Preview da capa">
            </label>
            <input type="file" name="capa" id="capa" class="capa-input" accept="image/*" onchange="previewCapa(event)">

            <input class="register" type="text" name="nome" placeholder="Nome do Livro..." required>
            <input class="register" type="text" name="autor" placeholder="Nome do Autor..." required>
            <input class="register" type="number" name="paginas" placeholder="Número de Páginas..." required>
            <select name="categoria" class="form-control register" required>
                <option value="">Categoria...</option>
                <option value="Literatura Clássica">Literatura Clássica</option>
                <option value="Autoajuda">Autoajuda</option>
                <option value="Tecnologia">Tecnologia</option>
                <option value="Livros Didáticos">Livros Didáticos</option>
                <option value="História e Cultura">História e Cultura</option>
                <option value="Infantojuvenil">Infantojuvenil</option>
            </select>
            <textarea class="register" name="sinopse" placeholder="Sinopse do livro" rows="5" required></textarea>

            <h2><strong>Arquivo do Livro</strong></h2>
            <input class="register" type="file" name="arquivo" accept=".pdf,.epub" required>
            <button type="submit" class="btn btn-color mt-3">Salvar Livro</button>
        </form>
    </div>

    <script>
        function previewCapa(event) {
            const img = document.getElementById('previewImg');
            const placeholder = document.querySelector('.capa-placeholder');
            let reader = new FileReader();
            reader.onload = function() {
                img.style.display = "block";
                img.src = reader.result;
                placeholder.style.display = "none";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>