<?php
require_once 'Conn.php';
if (!isset($_SESSION)) {
        session_start();
        ob_start();
    }
    if (!isset($_SESSION['id'])) {
        echo "<script>window.location.href='login.php';</script>";
    }
?>