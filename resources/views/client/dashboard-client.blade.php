@section('title', 'Painel do Cliente')
@include('components.header-dashboard')
@include('components.navbar')


<div class="dashboard-wrapper">
    <!-- MAIN CONTENT -->

    <main class="dashboard-content">
        <div class="container client-dashboard">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <span>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </span>
                </div>
            @endif

            <!-- HEADER: Perfil, Ações rápidas, Porcentagem de perfil completo -->
            <div class="client-dashboard-header card">
                <div class="header-profile-info">
                    <div class="profile-avatar-lg">
                        @if (Auth::user()->foto == null)
                            <i class="fa-solid fa-user"></i>
                        @else
                            <img src="{{ asset('storage/clients/' . Auth::user()->foto) }}" alt="Foto de Perfil">
                        @endif
                    </div>
                    <div class="profile-text-info">
                        <h2>Bem-vindo(a), {{ ucwords(Auth::user()->nome) }}!</h2>
                        <p class="profile-type">{{ Auth::user()->role == 'caregiver' ? 'Cuidador' : 'Cliente' }}</p>
                    </div>
                </div>

                <div class="header-quick-actions">
                    <a href="{{ route('dashboard.caregiver-editProfile') }}" class="btn btn-outline-primary btn-sm"><i
                            class="fas fa-user-edit"></i> Editar Perfil</a>
                    <a href="{{ route('client.searchCaregiver') }}" class="btn btn-primary btn-sm"><i
                            class="fas fa-search"></i> Buscar Cuidador</a>
                    <a href="{{ route('client.hire-history') }}" class="btn btn-secondary btn-sm"><i
                            class="fas fa-clipboard-list"></i> Minhas Solicitações</a>
                </div>
            </div>

            <div class="profile-completion-card card mb-4" hidden>
                <h3>Complete seu Perfil para Melhor Experiência</h3>
                <div class="progress-bar-container">
                    <div class="progress-bar"></div> <span class="progress-text">% Completo</span>
                </div>
                <p class="text-muted mt-2">Um perfil completo aumenta suas chances de encontrar o cuidador ideal. </p>
                <a href="{{ route('dashboard.caregiver-editProfile') }}"
                    class="btn btn-sm btn-outline-primary mt-3">Completar Perfil</a>
            </div>

            <!-- STATS: Solicitações, Favoritos, Chats, Cuidados -->
            <div class="stats-grid">
                <div class="stat-card card">
                    <i class="fas fa-clipboard-list stat-icon"></i>
                    <span class="stat-value">{{ $totalRequests ?? 0 }}</span>
                    <span class="stat-label">Solicitações</span>
                </div>
                <div class="stat-card card">
                    <i class="fas fa-circle-check stat-icon"></i>
                    <span class="stat-value">{{ $completedRequests ?? 0 }}</span>
                    <span class="stat-label">Solicitações Completas</span>
                </div>
                <div class="stat-card card">
                    <i class="fas fa-star stat-icon"></i>
                    <span class="stat-value">{{ $totalReviews ?? 0 }}</span>
                    <span class="stat-label">Total Avaliações</span>
                </div>
                <div class="stat-card card">
                    <i class="fa-solid fa-ranking-star stat-icon"></i>
                    <span class="stat-value">{{ number_format($averageRating ?? 0, 1) }}</span>
                    <span class="stat-label">Avaliação Média</span>
                </div>
                {{-- <div class="stat-card card">
                    <i class="fas fa- stat-icon"></i>
                    <span class="stat-value">{{ $totalChats ?? 0 }}</span>
                    <span class="stat-label">Chats</span>
                </div> --}}
            </div>

            <div class="dashboard-main-layout">
                <div class="main-content-grid">
                    <div class="card">
                        <h3 class="card-title"><i class="fas fa-history"></i> Solicitações Recentes</h3>
                        <div class="proposal-list">
                            @forelse ($recentProposals as $proposal)
                                <div class="proposal-item">
                                    <div class="proposal-item-wrap">
                                        <div class="proposal-avatar">
                                            @if ($proposal->caregiver->user->foto == null)
                                                <i class="fa-solid fa-user"></i>
                                            @else
                                                <img src="{{ asset('storage/caregivers/' . $proposal->caregiver->user->foto) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="proposal-details">
                                            <h4> {{ $proposal->caregiver->user->nome }} </h4>
                                            <p> <span>{{ $proposal->created_at->format('d/m/Y') }}</span> </p>
                                        </div>
                                    </div>
                                    <div class="proposal-details">
                                        <div class="request-badge badge-{{ $proposal->status }} small">
                                            @if ($proposal->status == 'completed')
                                                <i class="fa-solid fa-circle-check"></i>
                                            @elseif ($proposal->status == 'pending')
                                                <i class="fa-solid fa-clock"></i>
                                            @elseif ($proposal->status == 'accepted')
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="proposal-details">
                                        <span class="text-muted">
                                            <i class="fa-solid fa-map-pin"></i>
                                            {{ $proposal->caregiver->user->address->cidade }},
                                            {{ $proposal->caregiver->user->address->estado }} |
                                        </span>

                                        <span class="text-muted">
                                            <i class="fa-solid fa-star"></i>
                                            {{ $proposal->caregiver->avgReviews() }}/5
                                        </span>
                                    </div> --}}

                                    <div class="proposal-actions">
                                        <a href="{{ route('caregiver.public-profile', $proposal->caregiver->slug) }}"
                                            class="btn btn-sm btn-outline-primary">Ver Perfil</a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center">Nenhum paciente atribuído ainda.</p>
                            @endforelse
                            <div class="card-footer">
                                <a href="{{ route('client.hire-history') }}" class="btn btn-sm btn-link mt-3">Ver todas
                                    as
                                    propostas</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="card-title"><i class="fas fa-envelope"></i> Mensagens Recentes</h3>
                        @if ($recentChats->isEmpty())
                            {{-- if is empty pq mongo n conversa direito com o @empty --}}
                            <p class="text-muted">Nenhuma mensagem recente.</p>
                        @else
                            @foreach ($recentChats as $chat)
                                @php
                                    $caregiver = $chat->other_user;
                                @endphp

                                <div class="recent-list">
                                    <div class="conversation-item">
                                        <div class="conversation-avatar">
                                            @if ($caregiver->foto)
                                                <img src="{{ asset('storage/caregivers/' . $caregiver->foto) }}">
                                            @else
                                                <img src="{{ asset('assets/imgs/default-avatar.svg') }}">
                                            @endif
                                        </div>
                                        <div class="conversation-info">
                                            <div class="conversation-top">
                                                <span class="conversation-name">
                                                    {{ $caregiver->nome }}</span>
                                                <span class="conversation-time">
                                                    {{ $chat->last_message_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="conversation-bottom">
                                                <span class="last-message">{{ $chat->last_message ?? '...' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="card-footer">
                            <a href="{{ route('client.chat') }}" class="btn btn-sm btn-link">Ver todas as
                                mensagens</a>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="card-title"><i class="fas fa-star"></i> Cuidadores Não Avaliados</h3>
                        <div class="review-list">
                            @forelse ($pendingReviews as $review)
                                <div class="proposal-item">
                                    <div class="proposal-item-wrap">
                                        <div class="proposal-avatar">
                                            @if ($proposal->caregiver->user->foto == null)
                                                <i class="fa-solid fa-user"></i>
                                            @else
                                                <img src="{{ asset('storage/caregivers/' . $proposal->caregiver->user->foto) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="proposal-details">
                                            <h4> {{ $proposal->caregiver->user->nome }} </h4>
                                            <p> <span>{{ $proposal->created_at->format('d/m/Y') }}</span> </p>
                                        </div>
                                    </div>

                                    <div class="proposal-actions">
                                        <a href="{{ route('client.hire-history', $proposal->id) }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            Avaliar Agora
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center">Tudo em dia por aqui!.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="card-title"><i class="fa-solid fa-bookmark"></i> Cuidadores Favoritos</h3>

                        <p class="text-danger text-center">Função ainda nao adicionada.</p>
                    </div>
                </div>

                <div class="card">
                    <h3 class="card-title"><i class="fas fa-bell"></i>Alertas e Notificações</h3>
                    <div class="alert-list">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <div class="alert-item">
                                <i class="fa-solid fa-bell"></i>
                                <p>{{ $notification->data['message'] }}</p>
                                <span class="alert-time"></span>
                            </div>
                        @empty

                            <p class="text-muted text-center">Nenhum alerta ou notificação recente.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

@include('components.footer')


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const profileCard = document.querySelector('.profile-completion-card');
        const profileCompletionBar = document.querySelector('.progress-bar');
        const profileCompletionText = document.querySelector('.progress-text');

        let completedFields = 0;
        const totalFields = 9;

        if ("{{ Auth::user()->nome }}") completedFields++;
        if ("{{ Auth::user()->cpf }}") completedFields++;
        if ("{{ Auth::user()->rg }}") completedFields++;
        if ("{{ Auth::user()->email }}") completedFields++;
        if ("{{ Auth::user()->telefone }}") completedFields++;
        if ("{{ Auth::user()->address->cidade ?? '' }}") completedFields++;
        if ("{{ Auth::user()->address->bairro ?? '' }}") completedFields++;
        if ("{{ Auth::user()->address->logradouro ?? '' }}") completedFields++;
        if ("{{ Auth::user()->address->cep ?? '' }}") completedFields++;

        const completionPercentage = Math.round((completedFields / totalFields) * 100);

        profileCompletionBar.style.width = completionPercentage + '%';
        profileCompletionText.textContent = completionPercentage + '% Completo';

        if (completionPercentage < 100) {
            profileCard.removeAttribute('hidden');
        } else {
            profileCard.setAttribute('hidden', '');
        }

        // // Script para toggle de seções (se houver, como em filtros)
        // function toggleSection(id) {
        //     const section = document.getElementById(id);
        //     if (section) {
        //         section.classList.toggle('active');
        //         const icon = section.previousElementSibling.querySelector('i');
        //         if (icon) {
        //             icon.classList.toggle('fa-chevron-down');
        //             icon.classList.toggle('fa-chevron-up');
        //         }
        //     }
        // }

        // Exemplo de como você pode chamar toggleSection se tiver seções colapsáveis
        // document.querySelectorAll('.filter-title').forEach(title => {
        // title.addEventListener('click', () => toggleSection(title.nextElementSibling.id));
        // });
    });
</script>
