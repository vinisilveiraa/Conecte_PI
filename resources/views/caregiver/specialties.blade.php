@section('title', 'Especialidades')
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
            <!-- ESPECIALIDADES CADASTRADAS -->
            <div class="specialties-section">
                <h2>Especialidades cadastradas</h2>
                <p>Gerencie as áreas em que você atua como cuidador.</p>

                <div class="tags-container">
                    @foreach ($mySpecialties as $specialty)
                        <span class="tag">
                            {{ $specialty->nome }}

                            <form action="{{ route('caregiver.remove.specialty', $specialty->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="tag-remove">&times;</button>
                            </form>
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- ADICIONAR ESPECIALIDADE -->
            <div class="add-specialty-section">
                <h2>Adicionar nova especialidade</h2>
                <p>Selecione uma especialidade para adicionar ao seu perfil.</p>

                <div class="specialties-grid">
                    <!-- Cuidados Pessoais -->
                    <div class="specialty-category">
                        <h3>Cuidados pessoais</h3>
                        {{-- mostrar todas as especialidades que seja da categoria cuidados pessoais que ainda não foram cadastradas pelo mcuidador --}}
                        @foreach ($availableSpecialties as $specialty)
                            @if ($specialty->categoria == 'Cuidados Pessoais')
                                <form action="{{ route('caregiver.add.specialty', $specialty->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-sm">
                                        + {{ $specialty->nome }}
                                    </button>
                                </form>
                            @endif
                        @endforeach
                    </div>

                    <!-- Cuidados de Saúde -->
                    <div class="specialty-category">
                        <h3>Cuidados de Saúde</h3>
                        {{-- mostrar todas as especialidades que seja da categoria cuidados e saude que ainda não foram cadastradas pelo mcuidador --}}
                        @foreach ($availableSpecialties as $specialty)
                            @if ($specialty->categoria == 'Saúde')
                                <form action="{{ route('caregiver.add.specialty', $specialty->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-sm">
                                        + {{ $specialty->nome }}
                                    </button>
                                </form>
                            @endif
                        @endforeach
                    </div>

                    <!-- Rotina e Acompanhamento -->
                    <div class="specialty-category">
                        <h3>Rotina e Acompanhamento</h3>
                        {{-- mostrar todas as especialidades que seja da categoria cuidados e saude que ainda não foram cadastradas pelo mcuidador --}}
                        @foreach ($availableSpecialties as $specialty)
                            @if ($specialty->categoria == 'Acompanhamento')
                                <form action="{{ route('caregiver.add.specialty', $specialty->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-sm">
                                        + {{ $specialty->nome }}
                                    </button>
                                </form>
                            @endif
                        @endforeach

                    </div>

                    <!-- Apoio Emocional -->
                    <div class="specialty-category">
                        <h3>Apoio Emocional e Social</h3>
                        @foreach ($availableSpecialties as $specialty)
                            @if ($specialty->categoria == 'Especializados')
                                <form action="{{ route('caregiver.add.specialty', $specialty->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-sm">
                                        + {{ $specialty->nome }}
                                    </button>
                                </form>
                            @endif
                        @endforeach

                    </div>

                    <!-- Tarefas Domésticas -->
                    <div class="specialty-category">
                        <h3>Tarefas Domésticas</h3>
                        <p class="coming-soon">Em breve</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


@include('components.footer')
