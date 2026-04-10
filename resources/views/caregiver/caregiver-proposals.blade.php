@section('title', 'Minhas Propostas')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR CUIDADOR -->
    @include('components.dashboard-sidebar-cuidador')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <div class="content-header mb-xl">
                <h1 class="mb-0">Propostas <span>Recebidas</span></h1>
                <p class="text-light">Gerencie suas solicitações de trabalho e novas oportunidades de clientes.</p>
            </div>

            <!-- NAVEGAÇÃO DE STATUS (FILTROS) -->
            <div class="status-nav mb-xl">
                <a href="?status=all"
                    class="status-nav-item {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">Todas</a>
                <a href="?status=pending"
                    class="status-nav-item {{ request('status') == 'pending' ? 'active' : '' }}">Pendentes</a>
                <a href="?status=accepted"
                    class="status-nav-item {{ request('status') == 'accepted' ? 'active' : '' }}">Aceitas</a>
                <a href="?status=rejected"
                    class="status-nav-item {{ request('status') == 'rejected' ? 'active' : '' }}">Rejeitadas</a>
                <a href="?status=completed"
                    class="status-nav-item {{ request('status') == 'completed' ? 'active' : '' }}">Finalizadas</a>
            </div>

            <!-- LISTAGEM DE PROPOSTAS -->
            <div class="requests-container">
                @forelse($proposals as $proposal)
                    <div class="premium-request-card mb-lg">
                        <!-- LADO ESQUERDO: Perfil do Cliente -->
                        <div class="request-side-info">
                            <div class="avatar-container">
                                @if ($proposal->client->user->foto == null)
                                    <div
                                        class="request-user-avatar d-flex align-items-center justify-content-center bg-light-blue">
                                        <i class="fa-solid fa-user text-primary" style="font-size: 32px;"></i>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/clients/' . $proposal->client->user->foto) }}"
                                        class="request-user-avatar" alt="{{ $proposal->client->user->nome }}">
                                @endif
                            </div>
                            <h4 class="request-user-name">{{ $proposal->client->user->nome }}</h4>
                            <span class="request-date-meta text-muted">Recebida em
                                {{ $proposal->created_at }}</span>

                            <a href="" class="btn btn-outline-primary w-100 mt-auto">Ver
                                Perfil</a>
                        </div>

                        <!-- LADO DIREITO: Detalhes da Proposta -->
                        <div class="request-main-content">
                            <div class="request-top-bar">
                                <div class="request-id">
                                    <span
                                        class="text-xs text-light font-bold">#{{ str_pad($proposal->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="premium-badge badge-{{ $proposal->status }}">
                                    {{ ucfirst($proposal->status) }}
                                </div>
                            </div>

                            <div class="request-stats-grid">
                                <div class="stat-item">
                                    <label><i class="fa-solid fa-money-bill-wave mr-xs"></i> Valor Oferecido</label>
                                    <span>R$ {{ number_format($proposal->valor_servico, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Grid de Estatísticas Rápidas -->
                            <div class="request-stats-grid">
                                <div class="stat-item">
                                    <label><i class="fa-solid fa-calendar mr-xs"></i> Período</label>
                                    <span>{{ $proposal->data_inicio }} -
                                        {{ $proposal->data_fim }}</span>
                                </div>
                                <div class="stat-item">
                                    <label><i class="fa-solid fa-location-dot mr-xs"></i> Localização</label>
                                    <span>{{ Str::limit($proposal->endereco_servico) }}</span>
                                </div>
                            </div>

                            <!-- Descrição do Serviço -->
                            <div class="request-description-box">
                                <h5>Descrição do Serviço</h5>
                                <p>{{ $proposal->descricao_servico }}</p>
                            </div>

                            <!-- Ações Inferiores -->
                            <div class="request-actions-bar">
                                @if ($proposal->status == 'pending')
                                    <form action="" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger">Recusar</button>
                                    </form>
                                    <form action="" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary">Aceitar
                                            Proposta</button>
                                    </form>
                                @endif

                                @if ($proposal->status == 'accepted')
                                    <a href="#" class="btn btn-secondary"><i class="fa-solid fa-comment"></i>
                                        Abrir Chat</a>
                                    <button class="btn btn-outline-primary" disabled>Aguardando
                                        Finalização</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card text-center p-xl">
                        <i class="fa-solid fa-folder-open text-light mb-md" style="font-size: 40px;"></i>
                        <p class="text-light">Nenhuma proposta recebida no momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

@include ('components.footer')
