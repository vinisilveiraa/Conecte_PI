@section('title', 'Perfil de ' . $caregiver->user->nome)
@include('components.header-dashboard')
@include('components.navbar')

{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/perfil-cuidador.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/avaliacoes.css') }}">
@endpush --}}

<main class="profile-page-wrapper">
    <div class="container">
        {{-- Header do Perfil --}}
        <div class="profile-header-section">
            <div class="profile-main-info-wrap">
                <div class="profile-main-info">
                    <div class="profile-avatar-large">
                        <img src="{{ asset('storage/caregivers/' . $caregiver->user->foto) ?: asset('assets/imgs/default-avatar.svg') }}"
                            alt="Foto de {{ $caregiver->user->nome }}">
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-name">
                            {{ $caregiver->user->nome }}
                            <span class="profile-rating">
                                <i class="fas fa-star filled"></i> {{ number_format($averageRating, 1) }}
                            </span>
                        </h1>
                        <p class="profile-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $caregiver->user->address->cidade }},
                            {{ $caregiver->user->address->estado }}
                        </p>
                        <div class="profile-badges">
                            @if ($caregiver->coren && $caregiver->certificado_cuidador)
                                <span class="badge-verified"><i class="fas fa-check-circle"></i> Profissional
                                    Verificado</span>
                            @elseif ($caregiver->certificado_cuidador)
                                <span class="badge-verified"><i class="fas fa-check-circle"></i> Cuidador
                                    Certificado</span>
                            @elseif ($caregiver->coren)
                                <span class="badge-verified"><i class="fas fa-check-circle"></i> Profissional de
                                    Enfermagem</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="profile-main-subinfo">
                    <p class="profile-username">{{ '@' . $caregiver->slug }} | Código:
                        #{{ $caregiver->public_code }}</p>
                </div>
            </div>

            <div class="profile-actions">
                @guest
                    {{-- Visitante: Redireciona para login ou mostra modal --}}
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Entrar para Contratar</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Criar Conta</a>
                @else
                    @if (auth()->user()->id === $caregiver->user_id)
                        {{-- O próprio Cuidador vendo seu perfil --}}
                        <a href="{{ route('dashboard.caregiver') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-chart-line"></i> Voltar a Dashboard
                        </a>
                        <a href="{{ route('caregiver.edit-Profile') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    @elseif(auth()->user()->role === 'client')
                        {{-- Cliente vendo o perfil --}}
                        <a href="{{ route('client.hire.form', $caregiver->id) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-file-contract"></i> Enviar Proposta
                        </a>
                    @else
                        {{-- Outro cuidador vendo o perfil --}}
                        <span class="badge bg-light text-dark p-3 border">Visualizando como Profissional</span>
                    @endif
                @endguest
            </div>
        </div>

        <div class="profile-content-grid">
            {{-- Coluna Esquerda --}}
            <div class="profile-left-column">
                <section class="profile-section card">
                    <h2 class="card-title">Sobre Mim</h2>
                    @if (!$caregiver->headline && !$caregiver->bio)
                        <p class="profile-bio text-center">Nenhuma informação aqui</p>
                    @else
                        <h3 class="profile-headline">{{ $caregiver->headline ?? 'Nenhuma headline definida' }}</h3>
                        <span class="profile-bio">"{{ $caregiver->bio ?? 'Nenhuma bio definida' }}"</span>
                    @endif
                </section>

                <section class="profile-section card">
                    <h2 class="card-title">Especialidades</h2>

                    @if ($caregiver->specialties->isEmpty())
                        <p class="text-muted text-center">Nenhuma especialidade cadastrada</p>
                    @endif
                    <div class="specialties-list">
                        @foreach ($caregiver->specialties as $specialty)
                            <span class="specialty-badge">{{ $specialty->nome }}</span>
                        @endforeach
                    </div>
                </section>

                <section class="profile-section card">
                    <h2 class="card-title">Informações Profissionais</h2>
                    <ul class="professional-info-list">
                        <li><i class="fas fa-briefcase"></i> <strong>Membro Conecte desde:</strong>
                            {{ $caregiver->created_at->format('d/m/Y') }}</li>
                        <li><i class="fas fa-briefcase"></i> <strong>Experiência:</strong>
                            {{ $caregiver->experience_years ?? 0 }} anos</li>
                        <li><i class="fas fa-dollar-sign"></i> <strong>Valor Hora:</strong> R$
                            {{ $caregiver->hour_price ?? '0.00' }}</li>
                    </ul>
                </section>

                <section class="profile-section card">
                    <h2 class="card-title">Certificados</h2>
                    <div class="certificates-list">
                        @if (isset($caregiver->certificado_cuidador) && $caregiver->certificado_cuidador)
                            <div class="certificate-item">
                                @if (pathinfo($caregiver->certificado_cuidador, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe src="{{ route('caregiver.certificate', $caregiver->id) }}" width="100%"
                                        height="400px"></iframe>
                                @else
                                    <img src="{{ route('caregiver.certificate', $caregiver->id) }}" alt="Certificado">
                                @endif
                            </div>
                        @else
                            <i class="fa-solid fa-folder text-center"></i>
                            <p class="text-muted text-center">Nenhum certificado cadastrado.</p>
                        @endif

                    </div>
                </section>

                <section class="profile-section card">
                    <h2 class="card-title">Avaliações <strong>({{ $totalReviews }})</strong></h2>
                    <div class="reviews-list-container">
                        @forelse($caregiver->reviews as $review)
                            <div class="review-user">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <div class="reviewer-avatar">
                                            {{ substr($review->client->user->nome, 0, 1) }}
                                        </div>
                                        <div class="reviewer-details">
                                            <h4>{{ $review->client->user->nome }}</h4>
                                            <span class="review-date">{{ $review->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="review-stars low-gap">
                                        <span class="profile-rating text-muted">
                                            {{ number_format($review->rating, 1) }}
                                        </span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="review-comment">
                                    <p>{{ $review->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center">Ainda não há avaliações para este cuidador.</p>
                        @endforelse
                    </div>
                </section>
            </div>

            {{-- Coluna Direita (Sidebar) --}}
            <div class="profile-right-column">
                <section class="profile-section card">
                    <h2 class="card-title">Estatísticas</h2>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-value">{{ $totalProposals }}+</span>
                            <span class="stat-label">Atendimentos</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $satisfaction_rate }}%</span>
                            <span class="stat-label">Satisfação</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{ $caregiver->experience_years ?? 'N/A' }}</span>
                            <span class="stat-label">Anos Exp.</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">
                                <i
                                    class="fas {{ $caregiver->coren ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }}"></i>
                            </span>
                            <span class="stat-label">COREN</span>
                        </div>
                    </div>
                </section>

                <section class="profile-section card">
                    <h2 class="card-title">Galeria</h2>

                </section>

                <section class="profile-section card">
                    <h2 class="card-title">Disponibilidade</h2>
                    <div class="availability-schedule tags-container">
                        @if ($caregiver->available_morning)
                            <span class="badge-tag">Manhã</span>
                        @endif
                        @if ($caregiver->available_afternoon)
                            <span class="badge-tag">Tarde</span>
                        @endif
                        @if ($caregiver->available_night)
                            <span class="badge-tag">Noite</span>
                        @endif
                        @if ($caregiver->available_weekends)
                            <span class="badge-tag">Fim de Semana</span>
                        @endif
                    </div>
                </section>


                {{-- Card de Segurança --}}
                <div class="card alert-info border-0 shadow-sm mt-4">
                    <i class="fas text-center fa-shield-alt d-block fa-2x"></i>
                    <hr>
                    <p class="mb-0 small">Sua segurança é nossa prioridade. Todos os pagamentos são protegidos pela
                        plataforma.</p>
                </div>
            </div>
        </div>
    </div>
</main>

@include('components.footer')


{{-- @push('scripts')
    <script>
        function openChat(userId) {
            // Lógica para abrir o chat ou redirecionar
            window.location.href = "{{ route('chat.show', '') }}/" + userId;
        }
    </script>
@endpush --}}
