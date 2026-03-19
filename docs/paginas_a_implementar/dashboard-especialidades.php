<?php
/**
 * PÁGINA: DASHBOARD - CADASTRAR ESPECIALIDADE
 * Página para cuidador gerenciar especialidades
 */

$current_page = 'dashboard-especialidades';
$user_type = 'cuidador';
$user_name = 'Ana Paula Santos';

$registered_specialties = ['Banho', 'Curativo'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Especialidades - Conecte</title>
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/componentes.css">
  <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
  <!-- NAVBAR -->
  <?php include '../components/navbar.php'; ?>

  <div class="dashboard-wrapper">
    <!-- SIDEBAR -->

    <?php include '../components/dashboard-sidebar-cuidador.php'; ?>

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
      <div class="container">
        <!-- ESPECIALIDADES CADASTRADAS -->
        <div class="specialties-section">
          <h2>Especialidades cadastradas</h2>
          <p>Gerencie as áreas em que você atua como cuidador.</p>
          
          <div class="tags-container">
            <?php foreach ($registered_specialties as $specialty): ?>
            <span class="tag">
              <?php echo $specialty; ?>
              <button class="tag-remove">&times;</button>
            </span>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- ADICIONAR ESPECIALIDADE -->
        <div class="add-specialty-section">
          <h2>Adicionar nova especialidade</h2>
          <p>Selecione uma especialidade para adicionar ao seu perfil.</p>

          <div class="specialties-grid">
            <!-- Cuidados Pessoais -->
            <div class="specialty-category">
              <h3>Cuidados pessoais</h3>
              <button class="btn btn-outline btn-sm">+ Banho</button>
            </div>

            <!-- Cuidados de Saúde -->
            <div class="specialty-category">
              <h3>Cuidados de Saúde</h3>
              <button class="btn btn-outline btn-sm">+ Curativo</button>
            </div>

            <!-- Rotina e Acompanhamento -->
            <div class="specialty-category">
              <h3>Rotina e Acompanhamento</h3>
              <button class="btn btn-outline btn-sm">+ Diária</button>
              <button class="btn btn-outline btn-sm">+ Pernoite</button>
            </div>

            <!-- Apoio Emocional -->
            <div class="specialty-category">
              <h3>Apoio Emocional e Social</h3>
              <p class="coming-soon">Em breve</p>
            </div>

            <!-- Tarefas Domésticas -->
            <div class="specialty-category">
              <h3>Tarefas Domésticas</h3>
              <p class="coming-soon">Em breve</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/main.js"></script>
</body>
</html>
