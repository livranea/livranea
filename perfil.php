<?php
include_once('session.php');

require_once 'User.php';
require_once 'Conn.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Livrânea - Perfil</title>
    <link rel="shortcut icon" type="image/x-icon" href="image/livrâneaICON.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style-padrao.css" rel="stylesheet">
    <link href="css/style-perfil.css" rel="stylesheet">
</head>

<body>
    <?php
    include_once("funcoes/header.php");
    ?>
    <div class="title-section container" style="margin-top: 50px;">
        <h1>PERFIL</h1>
        <div class="linha"></div>

        <?php if (!empty($_SESSION['msg'])): ?>
            <div class="alert 
                <?= str_contains($_SESSION['msg'], '✅') || str_contains($_SESSION['msg'], '📧') ? 'alert-success' : 'alert-danger'; ?>">
                <?= $_SESSION['msg']; ?>
                <?php unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <div class="perfil-box">
            <img src="<?= htmlspecialchars($_SESSION['foto']) ?>" alt="foto" class="perfil-foto">


            <div class="perfil-info">
                <h3><strong><?= htmlspecialchars($_SESSION['nome']) ?></strong></h3>
                <p><strong>@<?= htmlspecialchars($_SESSION['usuario']) ?></strong></p>

                <p>Distintivos:</p>
                <div class="distintivos" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:5px;">
                    <?php
                    $user = new User();
                    $distUsuario = $user->getDistintivosUsuario($_SESSION['id']); // novo método que pega só os do usuário

                    if (!empty($distUsuario)) {
                        foreach ($distUsuario as $d) {
                            echo '<div class="dist-card" style="text-align:center; font-size:12px;">';
                            if (!empty($d['icone'])) {
                                echo "<img src='{$d['icone']}' alt='{$d['nome']}' width='40' style='display:block; margin:auto 0 5px;'>";
                            }
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div>
                <a class="btn-color" style="text-decoration: none;" href="editar.php">Gerenciar Conta</a>
            </div>
        </div>
        <div class="biografia">
            <h2>Biografia</h2>
            <p><?= htmlspecialchars($_SESSION['sobremim']) ?></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>