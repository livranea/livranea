<?php
session_start(); // precisa iniciar a sessão pra usar $_SESSION

require_once __DIR__ . '/../Conn.php';
require_once __DIR__ . '/../User.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $conn = (new Conn())->conectar();
    $query = "UPDATE usuarios 
              SET status = 'ativo', token_confirmacao = NULL 
              WHERE token_confirmacao = :token 
              LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':token', $token);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $_SESSION['msg'] = "✅ Conta confirmada com sucesso! Já pode fazer login.";
        header("Location: ../login.php");
        exit;
    } else {
        $_SESSION['msg'] = "❌ Token inválido ou conta já confirmada.";
        header("Location: ../login.php");
        exit;
    }
} else {
    $_SESSION['msg'] = "⚠ Nenhum token informado.";
    header("Location: ../login.php");
    exit;
}
