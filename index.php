<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Livrânea - Início</title>
  <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style-padrao.css" rel="stylesheet">
</head>

<body>
  <?php
  include('funcoes/header.php');
  ?>

  <div class="main-content container">
    <div class="title-section">
      <h1><strong>LIVRÂNEA</strong></h1>
      <h2>Acesso livre ao conhecimento: sua jornada de leitura começa aqui!</h2>
      <p class="description">
        <strong>Livrânea</strong> é uma plataforma desenvolvida para promover o acesso à leitura e à educação de forma inclusiva e acessível. Nosso objetivo é oferecer uma variedade de livros digitais, didáticos e historiográficos, especialmente para comunidades carentes, facilitando o aprendizado e o desenvolvimento cultural. Com uma interface intuitiva e recursos interativos, queremos transformar a leitura em um hábito prazeroso e contínuo para todos os usuários.
      </p>
    </div>

    <div class="row">
      <div class="col-md-4">
        <a href="categorias.php" class="card-link" style="text-decoration: none;">
          <div class="card" style="background-image: url(image/imagemlivro1.png)">
            <div class="card-title">CATEGORIAS DE LIVROS</div>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="dicas.php" class="card-link" style="text-decoration: none;">
          <div class="card" style="background-image: url(image/imagemlivro2.jpg)">
            <div class="card-title">DICAS DE LEITURA</div>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="sugestoes.php" class="card-link" style="text-decoration: none;">
          <div class="card" style="background-image: url(image/imagemlivro3.png)">
            <div class="card-title">SUGESTÕES DO DIA</div>
          </div>
        </a>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>