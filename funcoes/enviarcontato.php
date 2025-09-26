<?php
session_start();
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $assunto = trim($_POST['assunto']);
    $mensagem = trim($_POST['mensagem']);

    // 1. Validação básica
    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        $_SESSION['msg'] = "❌ Preencha todos os campos.";
        header("Location: ../contato.php");
        exit;
    }

    // 2. Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = "❌ E-mail inválido.";
        header("Location: ../contato.php");
        exit;
    }

    // 3. Validar domínio (MX record)
    $dominio = substr(strrchr($email, "@"), 1);
    if (!checkdnsrr($dominio, "MX")) {
        $_SESSION['msg'] = "❌ O domínio do e-mail não existe.";
        header("Location: ../contato.php");
        exit;
    }

    // 4. Montar email para o administrador
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'livranea@gmail.com'; // seu email
        $mail->Password   = 'orov nplu auvi twqf'; // sua senha/app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('livranea@gmail.com', 'Contato Livranea');
        $mail->addAddress('livranea@gmail.com'); // email que vai receber

        $mail->isHTML(true);
        $mail->Subject = "Novo contato - Livranea";
        $mail->Body    = "
            <strong>Nome:</strong> {$nome}<br>
            <strong>E-mail:</strong> {$email}<br>
            <strong>Assunto:</strong> {$assunto}<br>
            <strong>Mensagem:</strong><br>
            <p>{$mensagem}</p>
        ";

        $mail->send();

        $_SESSION['msg'] = "✅ Mensagem enviada com sucesso! Entraremos em contato.";
        header("Location: ../contato.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['msg'] = "❌ Erro ao enviar mensagem: {$mail->ErrorInfo}";
        header("Location: ../contato.php");
        exit;
    }
}
