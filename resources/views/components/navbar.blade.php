<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo/Brand -->
        <a href="{{ route('home') }}" class="navbar-brand">
            <span class="navbar-brand-icon">
                <svg width="32" height="32" viewBox="0 0 70 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M35 6C51.0163 6 64 18.9837 64 35C64 51.0163 51.0163 64 35 64C18.9837 64 6 51.0163 6 35C6 18.9837 18.9837 6 35 6ZM50.416 21.9365C46.5933 18.0218 40.3959 18.0218 36.5732 21.9365L35 23.5479L33.4268 21.9365C29.6041 18.0218 23.4067 18.0218 19.584 21.9365C14.8581 26.7766 14.8058 34.5906 19.4277 39.4961L19.4258 39.498L34.2529 54.6836C34.6393 55.0793 35.2515 55.1039 35.666 54.7578L35.7471 54.6836L50.5742 39.498L50.5723 39.4961C55.1942 34.5906 55.1419 26.7766 50.416 21.9365Z"
                        fill="currentColor" />
                    <path
                        d="M52.7559 64C52.9089 64.2351 52.999 64.515 52.999 64.8164V86.1504C52.9989 86.8211 52.741 87.7852 51.9883 88.5859C51.2223 89.4006 49.9879 90 48.124 90C47.1573 89.9999 46.0815 89.45 45.0166 88.668C43.932 87.8714 42.7746 86.7699 41.6309 85.5361C39.3414 83.0664 37.0554 80.0123 35.4385 77.6533C35.2289 77.3481 34.77 77.348 34.5605 77.6533C32.9436 80.0123 30.6577 83.0664 28.3682 85.5361C27.2243 86.77 26.0671 87.8713 24.9824 88.668C23.9175 89.4501 22.8418 90 21.875 90C20.0112 90 18.7767 89.4006 18.0107 88.5859C17.2581 87.7853 17.0001 86.821 17 86.1504V64.8164C17.0001 64.5211 17.0859 64.2459 17.2334 64.0137L34.9678 68.4189L52.7559 64Z"
                        fill="currentColor" />
                    <path
                        d="M66.5574 35C66.5574 17.5713 52.4287 3.44262 35 3.44262C17.5713 3.44262 3.44262 17.5713 3.44262 35C3.44262 52.4287 17.5713 66.5574 35 66.5574C52.4287 66.5574 66.5574 52.4287 66.5574 35ZM70 35C70 54.33 54.33 70 35 70C15.67 70 0 54.33 0 35C0 15.67 15.67 0 35 0C54.33 0 70 15.67 70 35Z"
                        fill="currentColor" />
                </svg>
            </span>
            <span>Conecte</span>
        </a>

        <!-- Menu Toggle (Mobile) -->
        <a class="navbar-toggle" id="navbarToggle">
            <i class="fa-solid fa-bars"></i>
        </a>

        <div class="navbar-mobile" id="navbarMobile">

            <ul class="navbar-menu" id="navbarMenu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('client.searchCaregiver') }}">Encontrar Cuidador</a></li>
                <li> <a href="{{ route('sobre-nos') }}"> Sobre Nós </a></li>
                <li><a href="{{ route('contatos') }}">Contatos</a></li>
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
                                    <a class="dropdown-item py-2"
                                        href="{{ auth()->user()->role === 'client' ? route('client.chat') : route('caregiver.chat') }}">
                                        <i class="fa-solid fa-comments me-2"></i> Chat
                                    </a>
                                </li>

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
                            <button class="navbar-notify-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>

                                @php
                                    $notifications = auth()->user()->unreadNotifications;
                                @endphp

                                @if ($notifications->count() > 0)
                                    <span class="notify-badge">
                                        {{ $notifications->count() > 9 ? '9+' : $notifications->count() }}
                                    </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                @if ($notifications->count() > 0)
                                    @foreach ($notifications as $notification)
                                        <li>
                                            <a href="{{ route('notification.read', $notification->id) }}"
                                                class="dropdown-item py-2">
                                                {{ $notification->data['message'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <a class="dropdown-item py-2">
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
    </div>
</nav>
