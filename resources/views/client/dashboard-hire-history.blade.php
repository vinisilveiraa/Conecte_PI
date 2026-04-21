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
                <p class="text-muted">Gerencie suas propostas enviadas aos cuidadores em um só lugar.</p>
            </div>

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

            <!-- LISTAGEM DE SOLICITAÇÕES -->
            <div class="requests-container">
                @forelse($requests as $request)
                    <div class="request-card mb-lg">
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

                            @if ($request->status == 'rejected')
                                <span class="request-date-meta text-muted">Proposta Recusada em
                                    {{ $request->cancelled_at }}</span>
                            @elseif ($request->status == 'accepted')
                                <span class="request-date-meta text-success">Proposta Aceita em <br>
                                    {{ $request->accepted_at }}</span>
                            @endif

                            <a href="" class="btn btn-outline-primary w-100 mt-auto">Ver
                                Perfil</a>
                        </div>

                        <!-- LADO DIREITO: Detalhes da Proposta -->
                        <div class="request-main-content">
                            <div class="request-top-bar">
                                <div class="request-id">
                                    <span
                                        class="text-xs text-muted font-bold">#{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="request-badge badge-{{ $request->status }}">
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
                                    <form
                                        action="{{ route('proposal.set-proposal-status', [
                                            'id' => $request->id,
                                            'status' => 'cancelled',
                                        ]) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger">Cancelar
                                            Solicitação</button>
                                    </form>
                                @endif

                                @if ($request->status == 'accepted')
                                    <a href="#" class="btn btn-secondary"><i class="fa-solid fa-comment"></i>
                                        Avaliar</a>
                                    <a href="#" class="btn btn-secondary"><i class="fa-solid fa-comment"></i>
                                        Abrir Chat</a>
                                    <form
                                        action="{{ route('proposal.set-proposal-status', [
                                            'id' => $request->id,
                                            'status' => 'completed',
                                        ]) }}"
                                        method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary">Finalizar
                                            Serviço</button>
                                    </form>
                                @endif

                                @if ($request->status == 'completed' && !$request->estrela)
                                    <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalAvaliacao"
                                        data-id="{{ $request->caregiver_id }}"
                                        data-nome="{{ $request->caregiver->user->nome }}"
                                        data-foto="{{ $request->caregiver->user->foto }}"
                                        data-inicio="{{ $request->data_inicio }}" data-fim="{{ $request->data_fim }}">
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







<!-- Modal avaliação -->
<div class="modal fade" id="modalAvaliacao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content caregiver-modal-content">

            <!-- Cabeçalho com fundo decorativo -->
            <div class="modal-header-banner">
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body p-0">
                <!-- Perfil Principal -->
                <div class="modal-perfil-header">
                    <div class="caregiver-avatar-wrapper">
                        <img id="modal-avatar" src="/storage/caregivers/default-avatar.png" alt="Avatar">
                    </div>
                    <div class="caregiver-basic-info">
                        <h3 id="modal-nome" class="mb-0">Nome do Cuidador</h3>
                    </div>
                </div>

                <!-- Detalhes do Perfil -->
                <div class="modal-details p-md">

                    <div class="info-section">

                        <h4 class="section-subtitle">
                            <i class="fa-solid fa-calendar mr-xs"></i>
                            Período do Serviço
                        </h4>
                        <div class="info-item centered">
                            <span id="modal-inicio"></span> - <span id="modal-fim"></span>
                        </div>

                    </div>

                    <form action="{{ route('cliente.proposal.avaliar') }}" method="POST">
                        @csrf

                        <input type="hidden" name="caregiver_id" id="modal-caregiver-id">

                        <div class="info-section mb-lg">
                            <h4 class="section-subtitle">
                                <i class="fa-solid fa-star"></i>
                                Avaliação
                            </h4>
                            <div class="info-item centered">

                                <div class="modal-avaliacao-estrelas">

                                    <input type="radio" name="estrela" id="vazio" value="" checked>

                                    <label for="estrela1"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="estrela" id="estrela1" value="1">

                                    <label for="estrela2"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="estrela" id="estrela2" value="2">

                                    <label for="estrela3"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="estrela" id="estrela3" value="3">

                                    <label for="estrela4"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="estrela" id="estrela4" value="4">

                                    <label for="estrela5"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="estrela" id="estrela5" value="5">

                                </div>

                                <div class="estrela-amount">
                                    <span class="estrela-count" id="estrela-count">0</span><span
                                        class="estrela-max">/5</span>
                                </div>
                            </div>

                            <div class="info-item">

                                <textarea name="comentario" id="comentario" class="form-control avaliacao-comentario"
                                    placeholder="Deixe um comentário sobre o cuidador..."></textarea>

                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer border-0 p-md">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fechar</button>

                <button type="submit" class="btn btn-primary">Avaliar</button>
            </div>
            </form>

        </div>
    </div>
</div>


<script>
    var count = document.getElementById('estrela-count');

    if (count) {
        var stars = document.querySelectorAll('.modal-avaliacao-estrelas input[type="radio"]');
        stars.forEach(function(star) {
            star.addEventListener('change', function() {
                count.textContent = this.value;
            });
        });
    }
</script>


@include('components.footer')
