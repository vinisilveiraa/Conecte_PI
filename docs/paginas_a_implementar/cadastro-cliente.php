<?php

/**
 * PÁGINA: CADASTRO CLIENTE
 * Formulário de cadastro para clientes que buscam cuidadores
 */

$current_page = 'cadastro-cliente';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Cliente - Conecte</title>
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/componentes.css">
</head>

<body>
  <!-- NAVBAR -->
  <?php include '../components/navbar.php'; ?>

  <!-- MAIN CONTENT -->
  <main class="cadastro-container">
    <div class="cadastro-wrapper">
      <!-- SEÇÃO ESQUERDA - CTA -->
      <div class="cadastro-sidebar">
        <h2>Cadastre-se<br>Gratuitamente!</h2>
        <p>Preencha os campos abaixo para criar sua conta como cliente.</p>
        <p class="login-link">Já possui uma conta? <a href="login.php">Entre aqui!</a></p>
      </div>

      <!-- SEÇÃO DIREITA - FORMULÁRIO -->
      <div class="cadastro-form-section">
        <form class="cadastro-form" method="POST" action="dashboard-cliente.php">
          <!-- DADOS PESSOAIS -->
          <div class="form-section">
            <h3 class="form-section-title">Dados Pessoais</h3>

            <div class="form-row" style="grid-template-columns: 1fr;">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for=" cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="data-nascimento">RG</label>
                <input type="text" id="data-nascimento" name="data-nascimento" placeholder="" required>
              </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="tel" id="telefone" name="telefone" placeholder="" required>
            </div>
          </div>

          <!-- ENDEREÇO -->
          <div class="form-section">
            <h3 class="form-section-title">Endereço</h3>

            <div class="form-row" style="grid-template-columns: 1fr;">
              <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" placeholder="" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" id="rua" name="rua" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" placeholder="" required>
              </div>
            </div>
          </div>

          <!-- SEGURANÇA -->
          <div class="form-section">
            <h3 class="form-section-title">Segurança</h3>

            <div class="form-row">
              <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="" required>
              </div>
              <div class="form-group">
                <label for="confirmar-senha">Confirmar Senha</label>
                <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="" required>
              </div>
            </div>
          </div>

          <div class="form-section">
            <h3 class="form-section-title">Arquivos</h3>

            <div class="form-row" style="grid-template-columns: 1fr;">
              <div class="form-group">
                <label for="foto-perfil">Foto de Perfil</label>
                <input type="file" id="foto-perfil" name="foto-perfil" accept="image/*">
              </div>
              <div id="preview-container" style="margin-top: 10px; display: none;">
                <img id="preview-img" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
              </div>
            </div>

            <!-- BOTÃO ENVIAR -->
            <button type="submit" class="btn btn-submit">Cadastrar-se</button>
        </form>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <?php include '../components/footer.php'; ?>

  <script src="../js/main.js"></script>
</body>

</html>