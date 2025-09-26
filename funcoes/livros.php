<?php
include_once('../session.php');
require_once '../User.php';

$user = new User();
$livros = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $termo = $_GET['search'];
    $livros = $user->pesquisarLivros($termo);
} elseif (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $livros = $user->getLivrosCategoria($categoria);
} else {
    $livros = $user->getLivros();
}
?>
