{{-- TITLE --}}
@section('title', 'Buscar Cuidadores')
{{-- HEADER --}}
@include('components.header-dashboard')
<!-- NAVBAR -->
@include('components.navbar')

<div class="dashboard-wrapper">

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <h1 class="mb-4">Buscar Cuidadores</h1>
            <p></p>

            @auth
                @if (Auth::user()->role == 'caregiver')
                    <p class="alert-info text-muted text-center mb-3 p-2">
                        Cadastre-se como cliente para contratar cuidadores!
                    </p>
                @endif
            @endauth

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="search-header">
                <p><strong>{{ method_exists($caregivers, 'total') ? $caregivers->total() : $caregivers->count() }}
                    </strong>
                    cuidadores encontrados</p>

                <form action="{{ route('client.searchCaregiver') }}" method="GET" id="sortForm" class="m-0">
                    {{-- Mantém os filtros atuais ao ordenar --}}
                    @foreach (request()->except('sort') as $key => $value)
                        @if (is_array($value))
                            @foreach ($value as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <select name="sort" onchange="this.form.submit()">
                        <option value="">Ordenar por</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Melhor avaliados
                        </option>
                        <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Mais avaliações
                        </option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mais recentes
                        </option>
                    </select>
                </form>
            </div>

            @if ($caregivers->count() <= 2)
                <p class="text-muted text-center mt-3 mb-3">
                    Mostrando poucos resultados. Tente remover alguns filtros.
                </p>
            @endif

            <div class="search-wrapper">
                <!-- FILTROS -->
                <div class="filters-sidebar">
                    <h3><i class="fas fa-sliders-h"></i> Filtros</h3>

                    <form action="{{ route('client.searchCaregiver') }}" method="GET" id="filterForm">

                        <div class="sidebar-actions mb-3">
                            {{-- <button type="submit" class="btn-apply">
                                Aplicar Filtros
                            </button> --}}
                            <a href="{{ route('client.searchCaregiver') }}" class="btn-clear">
                                Limpar Filtros
                            </a>
                        </div>

                        {{-- Categoria: Cuidados Pessoais --}}
                        <div class="filter-section">
                            <div class="filter-title" onclick="toggleSection('sec-pessoais')">
                                Cuidados Pessoais
                                <i class="fas fa-chevron-down text-muted small"></i>
                            </div>
                            <div class="filter-options active" id="sec-pessoais">
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Cuidados Pessoais')
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}"
                                                {{ is_array(request('specialties')) && in_array($specialty->id, request('specialties')) ? 'checked' : '' }}>
                                            <span>{{ $specialty->nome }}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Categoria: Saúde --}}
                        <div class="filter-section">
                            <div class="filter-title" onclick="toggleSection('sec-saude')">
                                Saúde
                                <i class="fas fa-chevron-down text-muted small"></i>
                            </div>
                            <div class="filter-options active" id="sec-saude">
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Saúde')
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}"
                                                {{ is_array(request('specialties')) && in_array($specialty->id, request('specialties')) ? 'checked' : '' }}>
                                            <span>{{ $specialty->nome }}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Categoria: Acompanhamento --}}
                        <div class="filter-section">
                            <div class="filter-title" onclick="toggleSection('sec-acompanhamento')">
                                Acompanhamento
                                <i class="fas fa-chevron-down text-muted small"></i>
                            </div>
                            <div class="filter-options active" id="sec-acompanhamento">
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Acompanhamento')
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}"
                                                {{ is_array(request('specialties')) && in_array($specialty->id, request('specialties')) ? 'checked' : '' }}>
                                            <span>{{ $specialty->nome }}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- Categoria: Cuidados Especializados --}}
                        <div class="filter-section">
                            <div class="filter-title" onclick="toggleSection('sec-especializados')">
                                Especializados
                                <i class="fas fa-chevron-down text-muted small"></i>
                            </div>
                            <div class="filter-options active" id="sec-especializados">
                                @foreach ($specialties as $specialty)
                                    @if ($specialty->categoria === 'Especializados')
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}"
                                                {{ is_array(request('specialties')) && in_array($specialty->id, request('specialties')) ? 'checked' : '' }}>
                                            <span>{{ $specialty->nome }}</span>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </form>
                </div>

                <!-- CAREGIVERS GRID -->
                @if ($caregivers->isEmpty())
                    <div class="empty-state">
                        <h3>Nenhum cuidador encontrado</h3>
                        <p>Tente ajustar os filtros ou limpar a busca.</p>
                        <a href="{{ route('client.searchCaregiver') }}" class="btn-clear">
                            Limpar filtros
                        </a>
                    </div>
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

                                <div class="caregiver-info">

                                    <span class="text-muted">
                                        <i class="fa-solid fa-map-pin"></i>
                                        @if ($caregiver->distance)
                                            <strong>{{ $caregiver->distance }}</strong> km /
                                        @endif
                                        {{ $caregiver->user->address->cidade }} -
                                        {{ $caregiver->user->address->estado }}
                                    </span>
                                </div>

                                <div class="caregiver-rating">
                                    <span class="rating-stars">
                                        @if ($caregiver->reviews_count > 0)
                                            <i class="fa-solid fa-star"></i>
                                            <span>{{ number_format($caregiver->reviews_avg_rating, 1) }}</span>
                                            <sub class="text-muted">({{ $caregiver->reviews_count }})</sub>
                                        @else
                                            <span class="text-muted rate-count">Sem avaliações</span>
                                        @endif
                                    </span>
                                </div>

                                {{-- manda so os necessarios pro js por json --}}
                                @php
                                    $caregiverData = [
                                        'id' => $caregiver->id,
                                        'nome' => $caregiver->user->nome,
                                        'foto' => $caregiver->user->foto,
                                        'cidade' => $caregiver->user->address->cidade ?? null,
                                        'bio' => $caregiver->bio,
                                        'created_at' => $caregiver->created_at->toISOString(),
                                        'rating' => number_format($caregiver->reviews_avg_rating, 1),
                                        'reviews_count' => $caregiver->reviews_count,
                                        'especialidades' => $caregiver->specialties->pluck('nome')->values(),
                                    ];
                                @endphp

                                <div class="caregiver-actions">
                                    <button class="btn btn-outline btn-sm btn-open-modal" data-bs-toggle="modal"
                                        data-bs-target="#perfilModal" data-caregiver='@json($caregiverData)'>
                                        Mais
                                    </button>
                                    @if (Auth::guest() || Auth::user()->role == 'caregiver')
                                        <a href="{{ route('login') }}"
                                            class="btn btn-outline btn-sm w-100">Cadastrar-se</a>
                                    @elseif(Auth::user()->role == 'client')
                                        <a href="{{ route('client.hire.form', $caregiver->id) }}"
                                            class="btn btn-primary btn-sm">Contratar</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($caregivers->hasPages())
                        <div class="pagination-wrapper mt-4">
                            {{ $caregivers->links() }}
                        </div>
                    @endif
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
                            <img id="modal-avatar" src=" {{ asset('assets/imgs/default-avatar.svg') }}"
                                alt="Avatar">
                        </div>
                        <div class="caregiver-basic-info">
                            <h3 id="modal-nome" class="mb-0">Nome do Cuidador</h3>
                            <p class="font-weight-semibold mb-1">Membro desde: <span id="modal-created"></span></p>
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
                                Nenhuma bio disponível
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
                                <span class="info-value" id="modal-avaliacao">
                                    <span id="modal-rate">0.0</span>
                                    <span class="text-muted" id="modal-count">(0)</span>
                                </span>
                            </div>
                            <div class="info-item info-item-column">
                                <span class="info-label"> <i class="fa-solid fa-location-dot"></i>
                                    Localização</span>
                                <span class="info-value" id="modal-cidade">None</span>
                            </div>
                        </div>
                        <div class="info-section">
                            <span></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-md">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Fechar</button>
                    @if (!Auth::guest())
                        <a id="contratarBtn" class="btn btn-primary"
                            href="{{ route('client.hire.form', 0) }}">Contratar</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Cadastrar</a>
                    @endauth
            </div>

        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-open-modal').forEach(button => {

            button.addEventListener('click', function() {

                const caregiver = JSON.parse(this.dataset.caregiver);

                const date = new Date(caregiver.created_at);

                document.getElementById('modal-nome').innerText = caregiver.nome;

                document.getElementById('modal-avatar').src =
                    caregiver.foto ?
                    `/storage/caregivers/${caregiver.foto}` :
                    `/assets/imgs/default-avatar.svg`;

                document.getElementById('modal-created').innerText =
                    date.toLocaleDateString('pt-BR', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });

                document.getElementById('modal-bio').innerText =
                    caregiver.bio ?? 'Nenhuma bio disponível';

                document.getElementById('modal-rate').innerText =
                    caregiver.rating ?? '0.0';

                document.getElementById('modal-count').innerText =
                    `(${caregiver.reviews_count ?? 0})`;

                document.getElementById('modal-cidade').innerText =
                    caregiver.cidade ?? 'Não informado';

                const container = document.getElementById('modal-especialidades');
                container.innerHTML = '';

                caregiver.especialidades.forEach(nome => {
                    container.innerHTML += `<span class="badge-tag">${nome}</span>`;
                });

                document.getElementById('contratarBtn').href =
                    `/hire/${caregiver.id}`;
            });
        });
    });

    function toggleSection(id) {
        const section = document.getElementById(id);
        const icon = section.previousElementSibling.querySelector('i');

        section.classList.toggle('active');

        if (section.classList.contains('active')) {
            icon.classList.replace('fa-chevron-right', 'fa-chevron-down');
        } else {
            icon.classList.replace('fa-chevron-down', 'fa-chevron-right');
        }
    }

    // auto-submit ao clicar
    document.querySelectorAll('.checkbox-item input').forEach(item => {
        item.addEventListener('change', event => {
            document.getElementById('filterForm').submit();
        })
    })
</script>

@include('components.footer')
