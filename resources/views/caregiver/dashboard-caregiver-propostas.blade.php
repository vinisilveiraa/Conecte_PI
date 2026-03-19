{{-- TITLE --}}
@section('title', 'Propostas')
{{-- HEADER --}}
@include('components.header-dashboard')
<!-- NAVBAR -->
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR -->
    @include('components.dashboard-sidebar-cuidador')


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
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"
                                            fill="currentColor" />
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

@include('components.footer')
