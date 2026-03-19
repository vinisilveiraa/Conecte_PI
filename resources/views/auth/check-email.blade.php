{{-- TITLE --}}
@section('title', 'Cadastro realizado')

{{-- HEADER --}}
@include('components.header')

<!-- NAVBAR -->
@include('components.navbar')

<section class="success-section">
    <div class="success-container">
        <div class="success-card">

            <!-- SUCCESS ICON -->
            <div class="success-icon">
                <i class="fa-solid fa-check"></i>
            </div>

            <!-- TITLE -->
            <h1 class="success-title">
                Cadastro realizado com sucesso 🎉
            </h1>

            <!-- DESCRIPTION -->
            <p class="success-text-primary">
                Enviamos um e-mail para você.
            </p>

            <p class="success-text-secondary">
                Abra seu e-mail e clique no botão para acessar seu dashboard.
            </p>

            <!-- CTA BUTTON -->
            <a href="{{ route('login') }}" class="success-button">
                Ir para o login
            </a>

            <!-- HELPER TEXT -->
            <p class="success-helper">
                Não encontrou o e-mail? Verifique sua caixa de spam.
            </p>
        </div>
    </div>
</section>

@include('components.footer')

<style>
    /* ===== SECTION CONTAINER ===== */
    .success-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 300px);
        background-color: #f8f9fa;
        padding: 2rem 1rem;
    }

    /* ===== CARD CONTAINER ===== */
    .success-container {
        width: 100%;
        max-width: 550px;
    }

    .success-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 3rem 2rem;
        text-align: center;
    }

    /* ===== ICON ===== */
    .success-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 90px;
        height: 90px;
        background-color: #17a2b8;
        color: white;
        border-radius: 50%;
        margin: 0 auto 2rem;
        font-size: 2.5rem;
    }

    /* ===== TITLE ===== */
    .success-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #212529;
        margin: 0 0 1.5rem;
        line-height: 1.2;
    }

    /* ===== TEXT CONTENT ===== */
    .success-text-primary {
        font-size: 1.1rem;
        color: #212529;
        margin: 0 0 0.5rem;
    }

    .success-text-secondary {
        font-size: 0.95rem;
        color: #6c757d;
        margin: 0 0 2rem;
    }

    /* ===== BUTTON ===== */
    .success-button {
        display: inline-block;
        width: 100%;
        max-width: 300px;
        padding: 0.75rem 2rem;
        background-color: #17a2b8;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
        border: none;
        cursor: pointer;
    }

    .success-button:hover {
        background-color: #138496;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(23, 162, 184, 0.3);
        color: white;
        text-decoration: none;
    }

    .success-button:active {
        transform: translateY(0);
    }

    /* ===== HELPER TEXT ===== */
    .success-helper {
        font-size: 0.9rem;
        color: #6c757d;
        margin: 0;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .success-section {
            min-height: auto;
            padding: 1rem;
        }

        .success-card {
            padding: 2rem 1.5rem;
        }

        .success-title {
            font-size: 1.5rem;
        }

        .success-text-primary {
            font-size: 1rem;
        }

        .success-text-secondary {
            font-size: 0.9rem;
        }

        .success-button {
            font-size: 0.95rem;
            padding: 0.65rem 1.5rem;
        }
    }
</style>
