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
    <meta charset="UTF-8">
    <title>Atribuir Distintivo</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style-padrao.css">
    <link rel="stylesheet" href="css/style-login.css">
</head>

<body>
    <?php include('funcoes/header.php'); ?>

    <?php
    require_once('User.php');   // depois da Conn

    $user = new User();

    // Carregar distintivos (com fallback)
    $distintivos = $user->getDistintivos();
    if (!is_array($distintivos)) {
        $distintivos = [];
    }

    // Processar formulário
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $usuarioId = $_POST['usuario_id'] ?? null;
        $distintivoId = $_POST['distintivo_id'] ?? null;

        if ($usuarioId && $distintivoId) {
            $resultado = $user->atribuirDistintivo($usuarioId, $distintivoId);
            $msg = $resultado["msg"] ?? "Erro ao processar.";
        } else {
            $msg = "Preencha todos os campos!";
        }
    }
    ?>
    <div class="container" style="margin-top: 80px; max-width:600px;">
        <h2><strong>Atribuir Distintivo</strong></h2>
        <form method="POST">
            <div class="mb-3">
                <label for="usuario_id" class="form-label">ID do Usuário</label>
                <input type="number" name="usuario_id" id="usuario_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <?php if (!empty($msg)): ?>
                    <div class="alert alert-info"><?= $msg ?></div>
                <?php endif; ?>
                <label for="distintivo_id" class="form-label">Distintivo</label>
                <select name="distintivo_id" id="distintivo_id" class="form-control" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($distintivos as $d): ?>
                        <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-color">Atribuir</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>