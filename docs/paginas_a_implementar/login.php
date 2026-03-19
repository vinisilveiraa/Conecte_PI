<?php

/**
 * PÁGINA LOGIN
 * Página de autenticação do usuário
 */

$current_page = 'login';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Conecte</title>
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/componentes.css">
</head>

<body>
  <!-- NAVBAR -->
  <?php include '../components/navbar.php'; ?>

  <!-- LOGIN CONTAINER -->
  <div class="login-container">
    <div class="login-card">
      <!-- Ícone -->
      <div class="login-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
          <path d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z" fill="currentColor" />
        </svg>
      </div>

      <!-- Título -->
      <h1>Entrar no Conecte</h1>

      <!-- Formulário -->
      <form method="POST" action="#" onsubmit="handleLogin(event)">
        <!-- Campo E-mail -->
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="seu@email.com"
            required>
        </div>

        <!-- Campo Senha -->
        <div class="form-group">
          <label for="password">Senha</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            required>
        </div>

        <!-- Botão Login -->
        <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: var(--spacing-md);">
          LOGIN
        </button>
      </form>

      <!-- Links Footer -->
      <div class="login-footer">
        <p>
          <a href="cadastro.php">Ainda não tem conta?</a>
        </p>
        <p>
          <a href="recuperar-senha.php">Esqueceu a senha?</a>
        </p>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include '../components/footer.php'; ?>

  <script src="../js/main.js"></script>
  <script>
    /**
     * Função para lidar com o login
     */
    function handleLogin(event) {
      event.preventDefault();

      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      // Validação básica
      if (!email || !password) {
        alert('Por favor, preencha todos os campos.');
        return;
      }

      // Aqui você conectaria com um backend real
      console.log('Login attempt:', {
        email,
        password
      });
      alert('Login realizado com sucesso! (Demonstração)');

      // Redirecionar para home após login
      // window.location.href = 'index.php';
    }
  </script>
</body>

</html>