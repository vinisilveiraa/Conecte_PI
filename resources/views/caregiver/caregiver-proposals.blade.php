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
                <h1>Propostas <span>Recebidas</span></h1>
                <p class="text-muted">Gerencie suas solicitações de trabalho e propostas de clientes.</p>
            </div>

            <!-- FILTROS RÁPIDOS -->
            <div class="status-filters mb-lg">
                <a href="{{ route('caregiver.proposals') }}" class="status-filter active">Todas (10)</a>
                {{-- <a href="{{ route('caregiver.proposals.pendentes') }}" class="status-filter ">Pendentes</a> --}}
                {{-- <a href="{{ route('caregiver.proposals.aceitas') }}" class="status-filter">Aceitas</a> --}}
                {{-- <a href="{{ route('caregiver.proposals.recusadas') }}" class="status-filter">Recusadas</a> --}}
            </div>

            <!-- LISTA DE PROPOSTAS -->
            <div class="proposals-list">
                @forelse($proposals as $proposal)
                    <div class="card proposal-card mb-md">
                        <div class="proposal-header">
                            <div class="client-info">
                                <div class="client-avatar">
                                    @if ($proposal->client->foto == null)
                                        <div class="avatar-placeholder"><i class="fa-solid fa-user"></i></div>
                                    @else
                                        <img src="{{ asset('storage/clients/' . $proposal->client->foto) }}"
                                            alt="{{ $proposal->client->nome }}">
                                    @endif
                                </div>
                                <div class="client-details">
                                    <h4>{{ $proposal->client->nome }}</h4>
                                    <span class="text-xs text-light">Solicitado em
                                        {{ $proposal->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="proposal-status badge-{{ $proposal->status }}">
                                {{ ucfirst($proposal->status) }}
                            </div>
                        </div>

                        <div class="proposal-body">
                            <div class="proposal-details-grid">
                                <div class="detail-item">
                                    <i class="fa-solid fa-calendar-day text-primary"></i>
                                    <div>
                                        <label>Período</label>
                                        <p>{{ $proposal->data_inicio->format('d/m/Y') }} a
                                            {{ $proposal->data_fim->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fa-solid fa-sack-dollar text-secondary"></i>
                                    <div>
                                        <label>Valor Oferecido</label>
                                        <p>R$ {{ number_format($proposal->valor_servico, 2, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="detail-item col-span-2">
                                    <i class="fa-solid fa-location-dot text-primary"></i>
                                    <div>
                                        <label>Endereço do Serviço</label>
                                        <p>{{ $proposal->endereco_servico }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="proposal-description mt-md">
                                <label>Descrição do Serviço:</label>
                                <p>{{ $proposal->descricao_servico }}</p>
                            </div>
                        </div>

                        <div class="proposal-footer">
                            @if ($proposal->status == 'pendente')
                                <div class="actions-group">
                                    <form action="{{ route('proposta.recusar', $proposal->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-outline-danger">Recusar</button>
                                    </form>
                                    <form action="{{ route('proposta.aceitar', $proposal->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary">Aceitar Proposta</button>
                                    </form>
                                </div>
                            @else
                                <button class="btn btn-light" disabled>Ação não disponível</button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="card text-center p-xl">
                        <i class="fa-solid fa-folder-open text-muted mb-md" style="font-size: 40px;"></i>
                        <p class="text-muted">Nenhuma proposta encontrada.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>

@include ('components.footer')
