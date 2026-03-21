{{-- TITLE --}}
@section('title', 'Dashboard Cliente')
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
            <h1 class="text-center">Bem vindo, <span>{{ Auth::user()->nome }}</span>!</h1>

            <div class="dashboard-grid">
                <!-- PERFIL CARD -->
                <div class="profile-card">
                    <div class="profile-avatar">

                        @if (Auth::user()->foto == null)
                            <i class="fa-solid fa-user"></i>
                        @else
                            <img src="{{ asset('assets/imgs/caregivers/' . Auth::user()->foto) }}" alt="">
                        @endif

                        <!-- FORM escondido -->
                        <form id="avatarForm" action="{{ route('edit.profile.avatar') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar" id="avatarInput" hidden>
                        </form>

                        <!-- BOTÃO lápis -->
                        <button type="button" class="profile-edit-icon"
                            onclick="document.getElementById('avatarInput').click()">
                            <i class="fa-solid fa-pencil"></i>
                        </button>

                    </div>

                    <h3>{{ ucwords(Auth::user()->nome) }}</h3>

                    @if (Auth::user()->role == 'caregiver')
                        <p class="profile-type">Cuidador</p>
                    @else
                        <p class="profile-type">Cliente</p>
                    @endif

                    <div class="profile-bio">
                        <h4>Bio:</h4>
                        @if (Auth::user()->bio == null)
                            <p>nada ainda</p>
                        @else
                            {{ Auth::user()->bio }}
                        @endif
                    </div>
                </div>

                <!-- INFORMAÇÕES CARD -->
                <div class="info-card">
                    <h3>Informações do Usuário</h3>

                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22 6 12 13 2 6"></polyline>
                        </svg>
                        <div>
                            <label>E-mail</label>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg>
                        <div>
                            <label>Telefone</label>
                            <p>{{ Auth::user()->telefone }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="1"></circle>
                            <path d="M12 1v6m0 6v6"></path>
                            <path d="M4.22 4.22l4.24 4.24m2.12 2.12l4.24 4.24"></path>
                            <path d="M1 12h6m6 0h6"></path>
                            <path d="M4.22 19.78l4.24-4.24m2.12-2.12l4.24-4.24"></path>
                            <path d="M12 19v6"></path>
                            <path d="M19.78 19.78l-4.24-4.24m-2.12-2.12l-4.24-4.24"></path>
                            <path d="M19 12h6"></path>
                            <path d="M19.78 4.22l-4.24 4.24m-2.12 2.12l-4.24 4.24"></path>
                        </svg>
                        <div>
                            <label>CPF</label>
                            <p>{{ Auth::user()->cpf }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <div>
                            <label>Cidade</label>
                            <p>{{ Auth::user()->address->cidade }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <div>
                            <label>Bairro</label>
                            <p>{{ Auth::user()->address->bairro }}</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <div>
                            <label>Logradouro</label>
                            <p>{{ Auth::user()->address->logradouro }}</p>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block">Atualizar Dados</button>
                </div>
            </div>
        </div>
    </main>
</div>

@include('components.footer')

<script>
    document.getElementById('avatarInput').addEventListener('change', function() {
        document.getElementById('avatarForm').submit();
    });
</script>
