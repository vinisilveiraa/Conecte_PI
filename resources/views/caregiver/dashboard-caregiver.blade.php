{{-- TITLE --}}
@section('title', 'Painel Cuidador')
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
            <h1 class="text-center">Bem vindo, <span>{{ Auth::user()->nome }}</span>!</h1>

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

            <div class="dashboard-cuidador">
                <div class="card proposal-overview-card">
                    <h3>Minhas Propostas Ativas</h3>
                    <div class="proposal-list">
                        @forelse ($proposals as $proposal)
                            @if ($proposal->status == 'pending' || $proposal->status == 'accepted')
                                <div class="proposal-item">
                                    <div class="proposal-item-wrap">
                                        <div class="proposal-avatar">
                                            @if ($proposal->client->user->foto == null)
                                                <i class="fa-solid fa-user"></i>
                                            @else
                                                <img src="{{ asset('storage/clients/' . $proposal->client->user->foto) }}"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="proposal-details">
                                            <h4> {{ $proposal->client->user->nome }} </h4>
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
                                    {{-- <a href="" class="btn btn-sm btn-outline-primary">Ver Perfil</a> --}}
                                </div>
                            @endif
                        @empty
                            <p class="text-muted text-center">Nenhum paciente atribuído ainda.</p>
                        @endforelse
                    </div>
                </div>

                <div class="card upcoming-reviews-card">
                    <h3>Avaliações Mais Recentes</h3>
                    <div class="review-list">
                        @forelse ($reviews as $review)
                            <div class="review-item">
                                <div class="review-user-wrap">
                                    <div class="review-icon">
                                        @if ($review->client->user->foto == null)
                                            <i class="fa-solid fa-user"></i>
                                        @else
                                            <img src="{{ asset('storage/clients/' . $review->client->user->foto) }}"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="review-details">
                                        <h4> {{ $review->client->user->nome }} </h4>
                                        <p> {{ $review->comment }} </p>
                                    </div>
                                </div>
                                <div class="review-rate">
                                    <div class="rating-stars">
                                        <span>{{ number_format($review->rating, 1) }}</span>
                                        <sub class="text-muted">/5</sub>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center">Nenhuma análise recente.</p>
                        @endforelse
                    </div>
                </div>

                <!-- CARD: ALERTAS E NOTIFICAÇÕES -->
                <div class="card">
                    <h3>Alertas e Notificações</h3>
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

                <!-- CARD: FEEDBACK -->
                <div class="card feedback-feed-card">
                    <h3>Sua avaliação atual</h3>

                    <div class="feedback-stats-wrapper">
                        <!-- TOPO (2 pequenos) -->
                        <div class="feedback-stats-top">
                            <div class="stat-small">
                                <span class="stat-label">Propostas</span>
                                <span class="stat-value">{{ $totalProposals }}</span>
                            </div>

                            <div class="stat-small">
                                <span class="stat-label">Avaliações</span>
                                <span class="stat-value">{{ $totalReviews }}</span>
                            </div>
                        </div>

                        <!-- DESTAQUE (nota grande) -->
                        @if (!$totalReviews)
                            <div class="feedback-stat-highlight">
                            @else
                                <div
                                    class="feedback-stat-highlight
                                    {{ $averageRating >= 4 ? 'high' : ($averageRating >= 3 ? 'mid' : 'low') }}">
                        @endif

                        <span class="stat-label">Média de avaliação</span>

                        <div class="rating-big">
                            {{ number_format($averageRating ?? 0, 1) }}
                            <span class="star">★</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card profile-summary-card">
                <h3>Meu Perfil</h3>
                <div class="profile-avatar-summary">
                    @if (Auth::user()->foto == null)
                        <i class="fa-solid fa-user"></i>
                    @else
                        <img src="{{ asset('storage/caregivers/' . Auth::user()->foto) }}" alt="">
                    @endif
                </div>
                <h4>{{ ucwords(Auth::user()->nome) }}</h4>
                <p class="text-muted">{{ Auth::user()->caregiver->headline ?? 'Defina sua headline' }}</p>
                <a href="{{ route('caregiver.public-profile', Auth::user()->caregiver->slug) }}"
                    class="btn btn-outline-primary btn-block mt-md">Ver Perfil</a>
            </div>

            <div class="card proposal-overview-card">
                <h3>Meus chats ativos</h3>
                @if ($recentChats->isEmpty())
                    {{-- if is empty pq mongo n conversa direito com o @empty --}}
                    <p class="text-muted">Nenhuma mensagem recente.</p>
                @else
                    @foreach ($recentChats as $chat)
                        @php
                            $client = $chat->other_user;
                        @endphp

                        <div class="recent-list">
                            <div class="conversation-item">
                                <div class="conversation-avatar">
                                    @if ($client->foto)
                                        <img src="{{ asset('storage/clients/' . $client->foto) }}">
                                    @else
                                        <i class="fa-solid fa-user"></i>
                                    @endif
                                </div>
                                <div class="conversation-info">
                                    <div class="conversation-top">
                                        <span class="conversation-name">
                                            {{ $client->nome }}</span>
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
            </div>
        </div>
    </main>
</div>


@include('components.footer')
