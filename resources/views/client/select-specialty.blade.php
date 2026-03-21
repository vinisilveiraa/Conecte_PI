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

            <div class="search-wrapper">
                <!-- FILTROS -->

                <div class="filters-card">
                    <h3>Filtros</h3>

                    <form action="{{route('load.caregivers')}}" method="POST">

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
















                <!-- CAREGIVERS GRID -->
                @if (empty($caregivers))
                    <p class="no-caregivers">Nenhum cuidador encontrado</p>
                @else
                    <div class="caregivers-grid">
                        <?php foreach ($caregivers as $caregiver): ?>
                        <div class="caregiver-card">
                            <div class="caregiver-avatar">
                                @if ($caregiver->user->foto == null)
                                    <i class="fa-solid fa-user"></i>
                                @else
                                    <img src="{{ asset('asserts/imgs/caregivers/' . $caregiver->user->foto) }}"
                                        alt="">
                                @endif
                            </div>
                            <h3>{{ $caregiver->user->nome }}</h3>

                            <div class="caregiver-rating">
                                <span class="rating-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M14 17H9v-5h5v5zm-2.5-8c-1.38 0-2.5-1.12-2.5-2.5S10.12 4 11.5 4 14 5.12 14 6.5 12.88 9 11.5 9z" />
                                    </svg>
                                    {{ $caregiver->estrela }}
                                </span>
                                <span class="rating-item dislike">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M10 7H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h5v2h2V9c0-1.1-.9-2-2-2zm0 10H5V9h5v8z" />
                                    </svg>

                                </span>
                            </div>

                            <div class="caregiver-actions">
                                <button class="btn btn-outline btn-sm">Currículo</button>
                                <button class="btn btn-primary btn-sm">Contratar</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

@include('components.footer')
