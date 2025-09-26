<?php 
    include_once('session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livrânea - Editar</title>
  <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style-padrao.css" rel="stylesheet">
  <link href="css/style-login.css" rel="stylesheet">
</head>

<body>
  <?php
  include_once('funcoes/header.php');
  ?>

  <!-- EDIT -->
  <?php
  require_once 'Conn.php';
  require_once 'User.php';

  $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $createUser = new User();
    $createUser->formData = $formData;
    $_FILES['foto'] = $_FILES['foto'] ?? null;

    if ($createUser->edit()) {
      $_SESSION['msg'] = "✅ Alteração realizada com sucesso.";
        header("Location: perfil.php");
    } else {
      $_SESSION['msg'] = "❌ Erro ao realizar alterações.";
        header("Location: editar.php");
    }
  }
  ?>
  <div class="container" style="margin-top: 100px;">
    <div class="preview-container">
      <label for="preview">
        <img id="previewImg" class="icon-top" src="<?= htmlspecialchars($_SESSION['foto']) ?>" alt="foto">
      </label>
    </div>
    <h2><strong>Gerenciar Conta</strong></h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <input type="file" id="preview" name="foto" class="file-input" accept="image/*" value="<?= htmlspecialchars($_SESSION['foto']) ?>">
      <input name="id" class="register" type="hidden" value="<?= htmlspecialchars($_SESSION['id']) ?>" required maxlength="50" />
      <input name="nome" class="register" type="text" value="<?= htmlspecialchars($_SESSION['nome']) ?>" required maxlength="50" />
      <input name="email" class="register" type="email" value="<?= htmlspecialchars($_SESSION['email']) ?>" required maxlength="50" />
      <input name="datanasc" class="register" type="date" value="<?= htmlspecialchars($_SESSION['datanasc']) ?>" required />
      <input name="usuario" class="register" type="text" value="<?= htmlspecialchars($_SESSION['usuario']) ?>" required maxlength="20" />
      <textarea name="sobremim" class="register" maxlength="150" placeholder="Sobre Mim"><?= isset($_SESSION['sobremim']) ? htmlspecialchars($_SESSION['sobremim']) : '' ?></textarea>
      <a name="novasenha" type="submit" href="novasenha.php" style="text-decoration: none; color: white; text-align: center;">Mudar Senha</a>
      <button name="novasenha" class="btn-color" type="submit" style="margin-top: 25px;"><strong>Salvar Alterações</strong></button>
      <a name="sair" type="submit" href="funcoes/sair.php" style="text-decoration: none; color: white; text-align: center;">Sair</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Mostrar um preview da foto -->
  <script>
    const input = document.getElementById("preview");
    const preview = document.getElementById("previewImg");

    input.addEventListener("change", function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function() {
          preview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>

</html>