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
                <p class="text-muted">Gerencie suas solicitações de trabalho e novas oportunidades de clientes.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- NAVEGAÇÃO DE STATUS (FILTROS) -->
            <div class="status-nav-container mb-sm">
                <div class="status-nav status-nav-first">
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
                <div class="status-nav status-nav-last">
                    <a href="?status=cancelled"
                        class="status-nav-item {{ request('status') == 'cancelled' ? 'active' : '' }}">Canceladas</a>
                    <a href="?status=expired"
                        class="status-nav-item {{ request('status') == 'expired' ? 'active' : '' }}">Expiradas</a>
                </div>
            </div>

            <!-- LISTAGEM DE PROPOSTAS -->
            <div class="requests-container">
                @forelse($requests as $proposal)
                    <div class="request-card mb-lg">
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

                            @if ($proposal->status == 'rejected')
                                <span class="request-date-meta text-muted">Proposta Recusada em
                                    {{ $proposal->cancelled_at }}</span>
                            @elseif ($proposal->status == 'accepted')
                                <span class="request-date-meta text-success">Proposta Aceita em <br>
                                    {{ $proposal->accepted_at }}</span>
                            @endif

                            <a href="" class="btn btn-outline-primary w-100 mt-auto">Ver
                                Perfil</a>
                        </div>

                        <!-- LADO DIREITO: Detalhes da Proposta -->
                        <div class="request-main-content">
                            <div class="request-top-bar">
                                <div class="request-id">
                                    <span
                                        class="text-xs text-muted font-bold">#{{ str_pad($proposal->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="request-badge badge-{{ $proposal->status }}">
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
                                    <form
                                        action="{{ route('proposal.set-proposal-status', [
                                            'id' => $proposal->id,
                                            'status' => 'rejected',
                                        ]) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger">Recusar</button>
                                    </form>
                                    <form
                                        action="{{ route('proposal.set-proposal-status', [
                                            'id' => $proposal->id,
                                            'status' => 'accepted',
                                        ]) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-primary">Aceitar</button>
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
                    <div class="card text-center">
                        <i class="fa-solid fa-folder-open text-muted mt-2 mb-md" style="font-size: 40px;"></i>
                        <p class="text-muted">Nenhuma proposta recebida no momento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

@include ('components.footer')
