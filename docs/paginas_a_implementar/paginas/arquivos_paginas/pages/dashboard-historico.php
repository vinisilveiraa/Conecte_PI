<?php

/**
 * PÁGINA: DASHBOARD - HISTÓRICO
 * Histórico de serviços contratados
 */

$current_page = 'dashboard-historico';
$user_type = 'cliente';
$user_name = 'Maria Silva';

$services = [
  ['date' => '09/01/2025', 'description' => 'Cuidado diário idoso', 'value' => 'R$ 200,00', 'caregiver' => 'Ana Paula Santos'],
  ['date' => '14/01/2025', 'description' => 'Acompanhamento consulta', 'value' => 'R$ 150,00', 'caregiver' => 'João Carlos'],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Histórico - Conecte</title>
  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/componentes.css">
  <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
  <!-- NAVBAR -->
  <?php include '../components/navbar.php'; ?>

  <div class="dashboard-wrapper">
    <!-- SIDEBAR -->

    <?php include '../components/dashboard-sidebar-cliente.php'; ?>

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
      <div class="container">
        <h1>Histórico de Serviços</h1>

        <div class="table-wrapper">
          <table class="dashboard-table">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Cuidador</th>
                <th>Avaliação</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($services as $service): ?>
                <tr>
                  <td><?php echo $service['date']; ?></td>
                  <td><?php echo $service['description']; ?></td>
                  <td><?php echo $service['value']; ?></td>
                  <td><?php echo $service['caregiver']; ?></td>
                  <td class="table-actions">
                    <button class="btn-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 17H9v-5h5v5zm-2.5-8c-1.38 0-2.5-1.12-2.5-2.5S10.12 4 11.5 4 14 5.12 14 6.5 12.88 9 11.5 9z" />
                      </svg>
                    </button>
                    <button class="btn-icon dislike">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 7H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h5v2h2V9c0-1.1-.9-2-2-2zm0 10H5V9h5v8z" />
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