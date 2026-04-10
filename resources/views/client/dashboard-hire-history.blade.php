@section('title', 'Minhas Solicitações')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR CLIENTE -->
    @include('components.dashboard-sidebar-cliente')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <div class="content-header mb-xl">
                <h1 class="mb-0">Acompanhar <span>Solicitações</span></h1>
                <p class="text-light">Gerencie suas propostas enviadas aos cuidadores em um só lugar.</p>
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

            <!-- LISTAGEM DE SOLICITAÇÕES -->
            <div class="requests-container">
                @forelse($requests as $request)
                    <div class="premium-request-card mb-lg">
                        <!-- LADO ESQUERDO: Perfil do Cuidador -->
                        <div class="request-side-info">
                            <div class="avatar-container">
                                @if ($request->caregiver->user->foto == null)
                                    <div
                                        class="request-user-avatar d-flex align-items-center justify-content-center bg-light-teal">
                                        <i class="fa-solid fa-user text-primary" style="font-size: 32px;"></i>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/caregivers/' . $request->caregiver->user->foto) }}"
                                        class="request-user-avatar" alt="{{ $request->caregiver->user->nome }}">
                                @endif
                            </div>
                            <h4 class="request-user-name">{{ $request->caregiver->user->nome }}</h4>
                            <div class="rating-stars mb-sm">
                                <span class="text-primary" style="font-size: 12px;">★★★★★</span>
                                <span class="text-xs text-muted">(4.9)</span>
                            </div>
                            <span class="request-date-meta text-muted">Enviada em
                                {{ $request->created_at }}</span>

                            <a href="" class="btn btn-outline-primary w-100 mt-auto">Ver
                                Perfil</a>
                        </div>

                        <!-- LADO DIREITO: Detalhes da Proposta -->
                        <div class="request-main-content">
                            <div class="request-top-bar">
                                <div class="request-id">
                                    <span
                                        class="text-xs text-light font-bold">#{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="premium-badge badge-{{ $request->status }}">
                                    {{ ucfirst($request->status) }}
                                </div>
                            </div>

                            <div class="request-stats-grid">
                                <div class="stat-item">
                                    <label><i class="fa-solid fa-money-bill-wave mr-xs"></i> Valor Total</label>
                                    <span>R$ {{ number_format($request->valor_servico, 2, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Grid de Estatísticas Rápidas -->
                            <div class="request-stats-grid">
                                <div class="stat-item">
                                    <label><i class="fa-solid fa-calendar mr-xs"></i> Período</label>
                                    <span>{{ $request->data_inicio }}</span>
                                    <span>{{ $request->data_fim }}</span>
                                </div>

                                <div class="stat-item">
                                    <label><i class="fa-solid fa-location-dot mr-xs"></i> Local</label>
                                    <span>{{ Str::limit($request->endereco_servico) }}</span>
                                </div>
                            </div>

                            <!-- Descrição do Serviço -->
                            <div class="request-description-box">
                                <h5>Descrição da Solicitação</h5>
                                <p>{{ $request->descricao_servico }}</p>
                            </div>

                            <!-- Ações Inferiores -->
                            <div class="request-actions-bar">
                                @if ($request->status == 'pending')
                                    <form action=" # " method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-warning">Editar
                                            Solicitação</button>
                                    </form>
                                    <form action=" # " method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger">Cancelar
                                            Solicitação</button>
                                    </form>
                                @endif

                                @if ($request->status == 'accepted')
                                    <a href="#" class="btn btn-secondary"><i class="fa-solid fa-comment"></i>
                                        Abrir Chat</a>
                                    <form action="{{ route('contratacao.finalizar', $request->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary">Finalizar
                                            Serviço</button>
                                    </form>
                                @endif

                                @if ($request->status == 'completed' && !$request->estrela)
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalAvaliacao{{ $request->id }}">
                                        <i class="fa-solid fa-star"></i> Avaliar Cuidador
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card text-center">
                        <i class="fa-solid fa-exclamation text-muted m-4" style="font-size: 40px;"></i>
                        <p class="text-muted">Você ainda não enviou nenhuma solicitação.</p>
                        <a href="{{ route('select.specialty') }}" class="btn btn-primary">Buscar Cuidadores
                            Agora</a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

@include('components.footer')
