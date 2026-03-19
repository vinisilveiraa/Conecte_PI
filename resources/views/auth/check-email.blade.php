{{-- TITLE --}}
@section('title', 'Login')
{{-- HEADER --}}
@include('components.header')
<!-- NAVBAR -->
@include('components.navbar')

<section class="section">
    <div class="container">

        <h2 class="section-title">Cadastro realizado com sucesso</h2>
        <p>
            Enviamos um e-mail para você.
        </p>
        <p>
            Abra seu e-mail e clique no botão para acessar seu dashboard.
        </p>
    </div>
</section>

<!-- FOOTER -->
@include('components.footer')
