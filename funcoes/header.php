<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"><strong>☰</strong></button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-links">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">LIVRÂNEA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="termos.php" style="font-weight: normal;">Termos e Condições</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contato.php" style="font-weight: normal;">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php" style="font-weight: normal;">Sobre Nós</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <div class="search-container">
                    <form action="categorias.php" method="GET" style="display:flex; align-items:center;">
                        <input type="text" name="search" class="search-bar" placeholder="Pesquise um livro..." required>
                        <button type="submit" class="search-icon">
                            <img src="image/lupaicon.png" width="15px" alt="lupaicon">
                        </button>
                    </form>
                </div>
                <!-- Foto de perfil dinâmica -->
                <div>
                    <a href="<?= isset($_SESSION['id']) ? 'perfil.php' : 'login.php' ?>">
                        <img class="profile-icon" src="<?= isset($_SESSION['foto']) ? $_SESSION['foto'] : 'image/defaultprofile.jpg' ?>" alt="icone">
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>