<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/lp3final/bibliochida/routes.php');
if (!(isset($_SESSION))) {
  session_start();
}
$usuario = null;
if (isset($_SESSION["usuario"])) {
  $usuario = $_SESSION["usuario"];
}
?>
<style>
  /* Custom navbar background color */
  .custom-navbar {
    background-color: #002260;
    /* Dark Blue Color */
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="/lp3final/bibliochida/main.php">BIBLIOCHIDA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Centered Dropdowns -->
      <ul class="navbar-nav mx-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Clientes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/clientes/create.php">Agregar</a></li>
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/clientes/">Listar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Prestamos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/prestamos/create.php">Agregar</a></li>
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/prestamos/">Listar</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="/lp3final/bibliochida/view/prestamos/pdf/prestamos.php" target="_blank">Imprimir</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Libros
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/libros/create.php">Agregar</a></li>
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/libros/">Listar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Referencias
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/genero/">Genero</a></li>
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/autor/">Autor</a></li>
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/editorial/">Editorial</a></li>
            <li><a class="dropdown-item" href="<?= PROJECT_PATH ?>view/idioma/">Idioma</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Right Aligned Items -->
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?= PROJECT_PATH ?>view/usuario/logout.php">Cerrar Sesión</a>
      </li>
    </ul>
  </div>
</nav>