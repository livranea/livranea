<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Livrânea - Fale Conosco</title>
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
    <div class="container2" style="margin-top: 50px;">
        <div class="title-section form-section">
            <h1>FALE CONOSCO!</h1>

            <?php if (!empty($_SESSION['msg'])): ?>
                <div class="alert 
                    <?= str_contains($_SESSION['msg'], '✅') ? 'alert-success' : 'alert-danger'; ?>">
                    <?= $_SESSION['msg']; ?>
                    <?php unset($_SESSION['msg']); ?>
                </div>
            <?php endif; ?>

            <form action="funcoes/enviarcontato.php" method="post">
                <div class="form-group">
                    <label for="nome">NOME</label>
                    <input type="text" id="nome" name="nome" required />
                </div>
                <div class="form-group">
                    <label for="email">E-MAIL</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="form-group">
                    <label for="assunto">ASSUNTO</label>
                    <select id="assunto" name="assunto" required>
                        <option value="">Selecione...</option>
                        <option value="Problema com conta">Problema com conta</option>
                        <option value="Sugestão">Sugestão</option>
                        <option value="Erro no site">Erro no site</option>
                        <option value="Parcerias">Parcerias</option>
                        <option value="Outros">Outros</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mensagem">MENSAGEM</label>
                    <textarea id="mensagem" name="mensagem" required></textarea>
                </div>
                <button type="submit" class="btn-color">Enviar</button>
            </form>
        </div>

        <div class="info-section">
            <h2>CONTATO</h2>
            <p>livranea@gmail.com</p>
            <h2>WHATSAPP</h2>
            <p>(99) 1234-5678</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>