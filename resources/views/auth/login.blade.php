{{-- TITLE --}}
@section('title', 'Login')
{{-- HEADER --}}
@include('components.header')
<!-- NAVBAR -->
@include('components.navbar')
<!-- LOGIN CONTAINER -->
<div class="login-container">
    <div class="login-card">
        {{-- ERROR --}}
        @if (session('error'))
        <div
            style="
                text-align:center;
                padding:12px;
                margin-bottom:20px;
                background-color:#ff4d4f;
                border-radius:6px;
                font-weight:600;
                box-shadow:0 2px 6px rgba(0,0,0,0.1);
            ">
            <p style="font-size:1.1rem; margin:0; color:white">
                {{ session('error') }}
            </p>
        </div>
    @endif
        <!-- Ícone -->
        <div class="login-icon">
            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                <path
                    d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
                    fill="currentColor" />
            </svg>
        </div>

        <!-- Título -->
        <h1>Entrar no Conecte</h1>

        <!-- Formulário -->
        <form method="POST" action="{{route('login')}}">
            @csrf
            <!-- Campo E-mail -->
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com"  >
            </div>

            <!-- Campo Senha -->
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="••••••••"  >
            </div>

            <!-- Botão Login -->
            <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: var(--spacing-md);">
                LOGIN
            </button>
        </form>

        <!-- Links Footer -->
        <div class="login-footer">
            <p>
                <a href="cadastro.php">Ainda não tem conta?</a>
            </p>
            <p>
                <a href="recuperar-senha.php">Esqueceu a senha?</a>
            </p>
        </div>
    </div>
</div>

<!-- FOOTER -->
@include('components.footer')

<script>
    /**
     * Função para lidar com o login
     */
    function handleLogin(event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Validação básica
        if (!email || !password) {
            alert('Por favor, preencha todos os campos.');
            return;
        }

        // Aqui você conectaria com um backend real
        console.log('Login attempt:', {
            email,
            password
        });
        alert('Login realizado com sucesso! (Demonstração)');

        // Redirecionar para home após login
        // window.location.href = 'index.php';
    }
</script>
