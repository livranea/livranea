<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livrânea - Registro</title>
  <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style-padrao.css" rel="stylesheet">
  <link href="css/style-login.css" rel="stylesheet">
</head>

<body>
  <?php
  require_once 'Conn.php';
  require_once 'User.php';
  include('funcoes/header.php');

  $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $createUser = new User();
    $createUser->formData = $formData;

    if ($createUser->create()) {
      echo "<script>window.location.href='login.php';</script>";
      exit;
    }
  }
  ?>

  <div class="container" style="margin-top: 100px;">
    <div class="preview-container">
      <label for="preview">
        <img id="previewImg" class="icon-top" src="image/defaultprofile.jpg" alt="Foto de Perfil">
      </label>
    </div>

    <h2><strong>Livrânea - Registro</strong></h2>

    <?php if (!empty($_SESSION['msg'])): ?>
      <div class="alert 
      <?= str_contains($_SESSION['msg'], '✅') || str_contains($_SESSION['msg'], '📧') ? 'alert-success' : 'alert-danger'; ?>">
        <?= $_SESSION['msg']; ?>
        <?php unset($_SESSION['msg']); ?>
      </div>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
      <input name="foto" class="file-input" type="file" accept="image/*" id="preview">

      <input name="nome" class="register" type="text" placeholder="Nome" required maxlength="50" />
      <input name="email" class="register" type="email" placeholder="Email" required maxlength="50" />
      <input name="usuario" class="register" type="text" placeholder="Usuário" required maxlength="20" />
      <input name="datanasc" class="register" type="date" placeholder="Data de Nascimento" required />
      <input name="senha" class="register" type="password" placeholder="Senha" required maxlength="50" minlength="6" autocomplete="off" />

      <div class="checkbox-container">
        <input type="checkbox" id="terms" required />
        <label for="terms">Concordo com os <a href="termos.php" style="font-weight: normal; text-decoration: none; color: #2c1b2e"><strong>Termos e Condições</strong></a></label>
      </div>
      <button name="registrar" class="btn-color" type="submit"><strong>Registrar</strong></button>
    </form>

    <div class="login-text">
      Já tem uma conta? <a href="login.php">Faça o Login</a>
    </div>
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