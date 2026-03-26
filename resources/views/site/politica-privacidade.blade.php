@section('title', 'Politica De Privacidade')
{{-- HEADER --}}
@include('components.header')
{{-- NAVBAR --}}
@include('components.navbar')

{{-- CHATBOT --}}
@include('components.chatbot')

<!-- MAIN CONTENT -->
<main class="politica-container">
    <div class="politica-header">
        <svg class="politica-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            <polyline points="9 12 12 15 15 10"></polyline>
        </svg>
        <h1>Política de Privacidade</h1>
    </div>

    <div class="politica-content">
        <div class="politica-intro">
            <p><strong>Bem-vindo ao Conecte.</strong> Esta Política de Privacidade descreve como coletamos, usamos e
                protegemos as suas informações.</p>
        </div>

        <!-- SEÇÃO 1 -->
        <section class="politica-section">
            <h2>1. Informações Coletadas</h2>
            <p>Coletamos dados fornecidos voluntariamente pelos usuários, como:</p>
            <ul>
                <li>Nome completo</li>
                <li>E-mail</li>
                <li>Telefone</li>
                <li>Foto de perfil</li>
                <li>Endereço</li>
            </ul>
        </section>

        <!-- SEÇÃO 2 -->
        <section class="politica-section">
            <h2>2. Finalidade do Uso dos Dados</h2>
            <p>As informações são utilizadas para:</p>
            <ul>
                <li>Gerenciar o cadastro de cuidadores e clientes</li>
                <li>Permitir a conexão entre quem busca e quem oferece cuidado</li>
                <li>Melhorar a experiência dentro do sistema</li>
                <li>Garantir segurança e autenticação</li>
            </ul>
        </section>

        <!-- SEÇÃO 3 -->
        <section class="politica-section">
            <h2>3. Compartilhamento de Informações</h2>
            <p>Os dados podem ser compartilhados somente nos seguintes casos:</p>
            <ul>
                <li>Entre cuidadores e clientes, apenas o necessário para o serviço</li>
                <li>Quando exigido por lei</li>
            </ul>
        </section>

        <!-- SEÇÃO 4 -->
        <section class="politica-section">
            <h2>4. Armazenamento e Segurança</h2>
            <p>Os dados são armazenados de maneira segura e nunca serão vendidos ou repassados sem autorização.</p>
        </section>

        <!-- SEÇÃO 5 -->
        <section class="politica-section">
            <h2>5. Direitos do Usuário</h2>
            <p>Você pode solicitar:</p>
            <ul>
                <li>Acesso às suas informações</li>
                <li>Correção de dados</li>
                <li>Exclusão da conta e dados pessoais</li>
            </ul>
        </section>

        <!-- SEÇÃO 6 -->
        <section class="politica-section">
            <h2>6. Alterações na Política</h2>
            <p>Esta política pode ser atualizada. Sempre exibiremos a versão mais recente nesta página.</p>
            <p class="last-update"><strong>Última atualização:</strong> Novembro de 2025</p>
        </section>
    </div>
</main>

<!-- FOOTER -->
@include('components/footer')
