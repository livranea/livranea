<?php
include_once('session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Livrânea - Nova Senha</title>
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

  <?php
  require_once 'Conn.php';
  require_once 'User.php';

  $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $senhaAtual = $_POST['senha_atual'];
    $novaSenha = $_POST['nova_senha'];

    $user = new User();
    $dados = $user->getUser($id);

    if ($dados && password_verify($senhaAtual, $dados['senha'])) {
      if ($user->novaSenha($id, $novaSenha)) {
        $_SESSION['msg'] = "✅ Senha alterada com sucesso.";
        header("Location: perfil.php");
        exit;
      } else {
      $_SESSION['msg'] = "❌ Erro ao alterar senha.";
      header("Location: perfil.php");
      exit;
      }
    } else {
      $_SESSION['msg'] = "❌ Senha atual incorreta.";
    }
  }
  ?>
  <div class="container" style="margin-top: 100px;">
    <h2><strong>Nova Senha</strong></h2>

    <?php if (!empty($_SESSION['msg'])): ?>
      <div class="alert 
                <?= str_contains($_SESSION['msg'], '✅') || str_contains($_SESSION['msg'], '📧') ? 'alert-success' : 'alert-danger'; ?>">
        <?= $_SESSION['msg']; ?>
        <?php unset($_SESSION['msg']); ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST">
      <input name="id" type="hidden" value="<?= htmlspecialchars($_SESSION['id']) ?>" required />
      <input name="senha_atual" class="register" type="password" placeholder="Senha antiga..." required />
      <input name="nova_senha" class="register" type="password" placeholder="Senha nova..." required />
      <button type="submit" class="btn-color"><strong>Alterar Senha</strong></button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>