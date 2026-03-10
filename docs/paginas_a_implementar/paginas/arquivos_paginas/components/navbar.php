<?php

/**
 * COMPONENTE NAVBAR
 * Barra de navegação reutilizável para todas as páginas
 * 
 * Uso: <?php include 'components/navbar.php'; ?>
 */

// Definir página ativa (passar como variável antes do include)
$current_page = isset($current_page) ? $current_page : '';
?>

<nav class="navbar">
  <div class="navbar-container">
    <!-- Logo/Brand -->
    <a href="index.php" class="navbar-brand">
      <span class="navbar-brand-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
          <path
            d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
            fill="currentColor" />
        </svg>
      </span>
      <span>Conecte</span>
    </a>

    <!-- Menu Toggle (Mobile) -->
    <button class="navbar-toggle" id="navbarToggle" onclick="">
      ☰
    </button>

    <!-- Menu Links -->
    <ul class="navbar-menu" id="navbarMenu">
      <li>
        <a href="index.php" class="<?php echo ($current_page === 'home') ? 'active' : ''; ?>">
          Home
        </a>
      </li>
      <li>
        <a href="cadastro.php" class="<?php echo ($current_page === 'cadastro') ? 'active' : ''; ?>">
          Cadastro
        </a>
      </li>
      <li>
        <a href="sobre-nos.php" class="<?php echo ($current_page === 'sobre-nos') ? 'active' : ''; ?>">
          Sobre Nós
        </a>
      </li>
      <li>
        <a href="contatos.php" class="<?php echo ($current_page === 'contatos') ? 'active' : ''; ?>">
          Contatos
        </a>
      </li>
      <li>
        <a href="politica-privacidade.php" class="<?php echo ($current_page === 'politica-privacidade') ? 'active' : ''; ?>">
          Política de Privacidade
        </a>
      </li>
    </ul>

    <!-- Buttons -->
    <div class="navbar-buttons" id="navbarButtons">
      <a href="cadastro.php" class="navbar-btn navbar-btn-primary">
        Cadastro
      </a>
      <a href="login.php" class="navbar-btn navbar-btn-primary">
        Login
      </a>
    </div>
  </div>
</nav>

<script src="../js/main.js"> </script>