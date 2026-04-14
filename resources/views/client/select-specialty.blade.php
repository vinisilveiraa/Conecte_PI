{{-- TITLE --}}
@section('title', 'Buscar Cuidadores')
{{-- HEADER --}}
@include('components.header-dashboard')
<!-- NAVBAR -->
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR -->
    @include('components.dashboard-sidebar-cliente')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <h1>Buscar Cuidadores</h1>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="search-wrapper">
                <!-- FILTROS -->

                <div class="filters-card">
                    <h3>Filtros</h3>

                    <form action="{{ route('load.caregivers') }}" method="POST">

                        @csrf

                        <div class="filter-group">
                            <label>Cuidados Pessoais</label>
                            <select name="cuidados_pessoais">
                                <option value="">Selecionar</option>
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Cuidados Pessoais')
                                        <option value="{{ $specialty->id }}">
                                            {{ $specialty->nome }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Saúde</label>
                            <select name="saude">
                                <option value="">Selecionar</option>
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Saúde')
                                        <option value="{{ $specialty->id }}">
                                            {{ $specialty->nome }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Acompanhamento</label>
                            <select name="acompanhamento">
                                <option value="">Selecionar</option>
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Acompanhamento')
                                        <option value="{{ $specialty->id }}">
                                            {{ $specialty->nome }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label>Cuidados Especializado</label>
                            <select name="cuidados_especializado">
                                <option value="">Selecionar</option>
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Especializados')
                                        <option value="{{ $specialty->id }}">
                                            {{ $specialty->nome }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary"style="min-width:100%;">
                            Buscar
                        </button>

                    </form>
                </div>

                @php
                    $caregivers = session('caregivers');
                    // session()->forgot('caregivers');
                @endphp
                <!-- CAREGIVERS GRID -->
                @if (!isset($caregivers) || $caregivers->isEmpty())
                    <p>
                        Nenhum cuidador encontrado
                    </p>
                @else
                    <div class="caregivers-grid">
                        @foreach ($caregivers as $caregiver)
                            <div class="caregiver-card">
                                <div class="caregiver-avatar">
                                    @if ($caregiver->user->foto == null)
                                        <i class="fa-solid fa-user"></i>
                                    @else
                                        <img src="{{ asset('storage/caregivers/' . $caregiver->user->foto) }}"
                                            alt="">
                                    @endif
                                </div>
                                <h3>{{ $caregiver->user->nome }}</h3>

                                <div class="caregiver-rating">
                                    <span class="rating-item">
                                        <i class="fa-solid fa-star"></i>
                                        @if ($caregiver->estrela == null)
                                            <span class="text-muted">N/A</span>
                                        @else
                                            {{ $caregiver->estrela }}
                                        @endif
                                    </span>
                                </div>

                                <div class="caregiver-actions">
                                    <button class="btn btn-outline btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#perfilModal" data-id="{{ $caregiver->id }}"
                                        data-nome="{{ $caregiver->user->nome }}"
                                        data-foto="{{ $caregiver->user->foto }}"
                                        data-cidade="{{ $caregiver->user->address->cidade }}"
                                        data-bio="{{ $caregiver->bio }}"
                                        data-especialidades="{{ implode(', ', $caregiver->specialties->pluck('nome')->toArray()) }}">
                                        Mais
                                    </button>
                                    <a href="{{ route('client.hire.form', $caregiver->id) }}"
                                        class="btn btn-primary btn-sm">Contratar</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Modal Perfil do Cuidador -->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-hidden="true">
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
                            {{-- <p class="text-primary font-weight-semibold mb-1">Cuidador de Idosos & Pós-Operatório</p> --}}
                            {{-- <div class="rating-stars">
                                <span class="text-secondary">★★★★★</span>
                                <span class="text-sm text-muted">(12 avaliações)</span>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Detalhes do Perfil -->
                    <div class="modal-perfil-details p-md">
                        <div class="info-section mb-lg">
                            <h4 class="section-subtitle">Bio</h4>
                            <p id="modal-bio" class="text-sm">

                            </p>
                        </div>

                        <div class="info-section mb-lg">
                            <h4 class="section-subtitle">Especialidades</h4>
                            <div class="tags-container" id="modal-especialidades">
                                {{-- Especialidades aqui pelo JS --}}
                            </div>
                        </div>

                        <div class="info-grid">
                            <div class="info-item info-item-column">
                                <span class="info-label">
                                    <i class="fas fa-star"></i>
                                    Avaliação</span>
                                {{-- ! trocar aqui avalicao futuramente ! --}}
                                <span class="info-value" id="modal-avaliacao">
                                    <i class="fas fa-star"></i>
                                    4.8 / 5
                                </span>
                            </div>
                            <div class="info-item info-item-column">
                                <span class="info-label"> <i class="fa-solid fa-location-dot"></i>
                                    Localização</span>
                                <span class="info-value" id="modal-cidade">None</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-md">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fechar</button>

                    <a id="contratarBtn" class="btn btn-primary"
                        href="{{ route('client.hire.form', 0) }}">Contratar</a>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var perfilModal = document.getElementById('perfilModal');
        perfilModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var caregiverId = button.getAttribute('data-id');
            var contratarBtn = document.getElementById('contratarBtn');
            if (caregiverId && contratarBtn) {
                // Substitui o id 0 pelo id real do cuidador na rota Blade
                contratarBtn.href = contratarBtn.href.replace(/\d+$/, caregiverId);
            }
        });
    });
</script>

@include('components.footer')
