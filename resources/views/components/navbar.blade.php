<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo/Brand -->
        <a href="{{ route('home') }}" class="navbar-brand">
            <span class="navbar-brand-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                    <path
                        d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
                        fill="currentColor" />
                </svg>
            </span>
            <span>Conecte</span>
        </a>

        <!-- Menu Toggle (Mobile) -->
        <button class="navbar-toggle" id="navbarToggle" onclick="">
            ☰
        </button>

        <!-- Menu Links -->
        <ul class="navbar-menu" id="navbarMenu">
            <li>
                <a href="{{ route('home') }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('client.searchCaregiver') }}">
                    Encontrar Cuidador
                </a>
            </li>

            <li>
                <a href="{{ route('sobre-nos') }}">
                    Sobre Nós
                </a>
            </li>
            <li>
                <a href="{{ route('contatos') }}">
                    Contatos
                </a>
            </li>
        </ul>

        <!-- Buttons -->

        <div class="navbar-buttons" id="navbarButtons">

            @auth
                <div class="navbar-user-container">
                    <div class="dropdown">
                        <button class="navbar-profile-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <div class="navbar-profile-info">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('storage/' . (auth()->user()->role === 'client' ? 'clients/' : 'caregivers/') . Auth::user()->foto) }}"
                                        class="navbar-avatar" alt="Avatar">
                                @else
                                    <div class="navbar-avatar-placeholder">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                                <span class="navbar-name d-none d-sm-inline">
                                    {{ explode(' ', Auth::user()->nome)[0] }}
                                </span>
                                <i class="fa-solid fa-chevron-down ms-2 small opacity-75"></i>
                            </div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            <li>
                                <a class="dropdown-item py-2"
                                    href="{{ auth()->user()->role === 'client' ? route('dashboard.client') : route('dashboard.caregiver') }}">
                                    <i class="fa-solid fa-user me-2"></i> Painel
                                </a>
                            </li>

                            @if (auth()->user()->role === 'caregiver')
                                <li>
                                    <a class="dropdown-item py-2"
                                        href="{{ route('caregiver.public-profile', Auth::user()->caregiver->slug) }}">
                                        <i class="fa-solid fa-book-medical me-2"></i> Meu Perfil
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item py-2"
                                    href="{{ auth()->user()->role === 'client' ? route('dashboard.client-editProfile') : route('dashboard.caregiver-editProfile') }}">
                                    <i class="fa-solid fa-pencil me-2"></i> Editar Perfil
                                </a>
                            </li>

                            @if (auth()->user()->role === 'client')
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('client.hire-history') }}">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i> Propostas
                                    </a>
                                </li>
                            @endif

                            <li>
                                <hr class="dropdown-divider opacity-50">
                            </li>
                            <li>
                                <a class="dropdown-item py-2 text-danger navbar-logout" href="{{ route('logout') }}">
                                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="navbar-user-notify">
                    <div class="dropdown">
                        <button class="navbar-notify-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-bell"></i>

                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="notify-badge">
                                    {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li>
                                        {{-- <a href="{{ route('notifications/$notification->id') }}"
                                            class="dropdown-item py-2">
                                            <i class="fa-solid fa-exclamation"></i>
                                            {{ $notification->data['message'] }}
                                        </a> --}}
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a href="dropdown-item py-2">
                                        Nenhuma notificação recebida...
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('register') }}" class="navbar-btn navbar-btn-primary">
                    Cadastro
                </a>
                <a href="{{ route('login') }}" class="navbar-btn navbar-btn-primary">
                    Login
                </a>
            @endguest
        </div>
    </div>
</nav>

<script src="../js/main.js"></script>
