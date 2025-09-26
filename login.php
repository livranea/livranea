<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livrânea - Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style-padrao.css" rel="stylesheet">
  <link href="css/style-login.css" rel="stylesheet">
</head>

<body>
  <?php
  include('funcoes/header.php');
  ?>

  <div class="login-wrapper">
    <div class="title-section login-info">
      <h1><strong>LIVRÂNEA</strong></h1>
      <h2>BIBLIOTECA VIRTUAL</h2>
      <p>
        Faça login ou cadastre-se para começar a explorar e descobrir novas histórias!
      </p>
    </div>

    <div class="container">
      <h2><strong>Login</strong></h2>

      <?php if (!empty($_SESSION['msg'])): ?>
        <div class="alert 
      <?= str_contains($_SESSION['msg'], '✅') || str_contains($_SESSION['msg'], '📧') ? 'alert-success' : 'alert-danger'; ?>">
          <?= $_SESSION['msg']; ?>
          <?php unset($_SESSION['msg']); ?>
        </div>
      <?php endif; ?>

      <form action="funcoes/logar.php" method="POST">
        <input class="register" type="email" name="email" placeholder="Email" required maxlength="50" />
        <input class="register" type="password" name="senha" placeholder="Senha" required maxlength="50" />
        <button class="btn-color" type="submit" name="logar">Logar</button>
      </form>
      <div class="login-text">
        Não tem uma conta? <a href="registro.php">Registre-se</a>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>