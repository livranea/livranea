<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livrânea - Autenticação</title>
</head>

<body>
    <?php
    session_start();

    if (!empty($_POST) && (empty($_POST['email']) || empty($_POST['senha']))) {
        echo "<script>alert('Não foi possível realizar o login.'); window.location.href='../login.php';</script>";
    } else {
        // Toda a validação do usuário
        $email_escape = addslashes($_POST['email']);
        $senha_escape = addslashes($_POST['senha']);

        require '../Conn.php';
        require '../User.php';
        $user = new User();
        $buscar = $user->logar($email_escape);

        if ($buscar) {
            extract($buscar);
            if (password_verify($senha_escape, $senha)) {
                // Se a senha estiver certa.
                $_SESSION['id'] = $id;
                $_SESSION['nome'] = $nome;
                $_SESSION['foto'] = $foto;
                $_SESSION['usuario'] = $usuario;
                $_SESSION['sobremim'] = $sobremim;
                $_SESSION['email'] = $email;
                $_SESSION['datanasc'] = $datanasc;

                header("Location: ../index.php");
            } else {
                // Se a senha estiver errada.
                $_SESSION['msg'] = "❌ A senha está incorreta.";
                header("Location: ../login.php");
                exit;
            }
        } else {
            // Se não existir OU se o email não estiver confirmado
            $_SESSION['msg'] = $_SESSION['msg'] ?? "❌ Não foi possível realizar o login.";
            header("Location: ../login.php");
            exit;
        }
    }
    ?>
</body>

</html>