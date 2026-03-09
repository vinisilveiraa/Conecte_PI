<?php
/**
 * PÁGINA: DASHBOARD - PROPOSTAS
 * Propostas recebidas pelo cuidador
 */

$current_page = 'dashboard-propostas';
$user_type = 'cuidador';
$user_name = 'Ana Paula Santos';

$proposals = [
  ['date' => '14/01/2025', 'value' => 'R$ 250,00', 'client' => 'João Silva', 'description' => 'Cuidado diário para idoso com mobilidade...', 'status' => 'pendente'],
  ['date' => '17/01/2025', 'value' => 'R$ 180,00', 'client' => 'Ana Souza', 'description' => 'Acompanhamento para consultas médicas...', 'status' => 'aceito'],
  ['date' => '19/01/2025', 'value' => 'R$ 320,00', 'client' => 'Pedro Lima', 'description' => 'Pernoite com paciente em pós-operatório...', 'status' => 'pendente'],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Propostas - Conecte</title>
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
        <h1>Propostas Recebidas</h1>

        <div class="table-wrapper">
          <table class="dashboard-table proposals-table">
            <thead>
              <tr>
                <th>Data</th>
                <th>Valor</th>
                <th>Cliente</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($proposals as $proposal): ?>
              <tr>
                <td><?php echo $proposal['date']; ?></td>
                <td><?php echo $proposal['value']; ?></td>
                <td><?php echo $proposal['client']; ?></td>
                <td><?php echo $proposal['description']; ?></td>
                <td>
                  <span class="status-badge status-<?php echo $proposal['status']; ?>">
                    <?php echo ucfirst($proposal['status']); ?>
                  </span>
                </td>
                <td class="table-actions">
                  <button class="btn-icon accept">
                    like
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                      <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="currentColor"/>
                    </svg>
                  </button>
                  <button class="btn-icon reject">
                    deslike
                    </svg>
                  </button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script src="../js/main.js"></script>
</body>
</html>
