@section('title', 'Sobre Nos')
{{-- HEADER --}}
@include('components.header')
{{-- NAVBAR --}}
@include('components.navbar')



<!-- TÍTULO E DESCRIÇÃO -->
<section class="section">
    <div class="container">
        <h1 class="section-title">Sobre o Projeto</h1>

        <div
            style="background-color: var(--color-light-gray); padding: 2rem; border-radius: 1rem; max-width: 900px; margin: 0 auto;">
            <p>
                Este projeto foi criado por alunos da <strong>FATEC Jahu</strong> com o propósito de aproximar pessoas.
                Acreditamos que cuidado é um ato humano e essencial — e que encontrar alguém de confiança não deveria
                ser difícil.
            </p>
            <p>
                Por isso, desenvolvemos uma plataforma que facilita a conexão entre cuidadores capacitados e quem
                precisa de assistência, prezando pela segurança, acolhimento e respeito.
            </p>
        </div>
    </div>
</section>

<!-- MISSÃO, VISÃO E VALORES -->
<section class="section section-light">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <!-- Missão -->
            <div class="card card-icon">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M448 256a192 192 0 1 0 -384 0 192 192 0 1 0 384 0zM0 256a256 256 0 1 1 512 0 256 256 0 1 1 -512 0zm256 80a80 80 0 1 0 0-160 80 80 0 1 0 0 160zm0-224a144 144 0 1 1 0 288 144 144 0 1 1 0-288zM224 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Missão</h3>
                <p>Facilitar o acesso a cuidadores qualificados, promovendo cuidado humano, seguro e acessível.</p>
            </div>

            <!-- Visão -->
            <div class="card card-icon">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M128 320L24.5 320c-24.9 0-40.2-27.1-27.4-48.5L50 183.3C58.7 168.8 74.3 160 91.2 160l95 0c76.1-128.9 189.6-135.4 265.5-124.3 12.8 1.9 22.8 11.9 24.6 24.6 11.1 75.9 4.6 189.4-124.3 265.5l0 95c0 16.9-8.8 32.5-23.3 41.2l-88.2 52.9c-21.3 12.8-48.5-2.6-48.5-27.4L192 384c0-35.3-28.7-64-64-64l-.1 0zM400 160a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Visão</h3>
                <p>Ser a principal plataforma de conexão de cuidado no Brasil, referência em confiança e acolhimento.
                </p>
            </div>

            <!-- Valores -->
            <div class="card card-icon">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
                            fill="currentColor" />
                    </svg>
                </div>
                <h3>Valores</h3>
                <p>Empatia, transparência, responsabilidade e respeito à dignidade humana.</p>
            </div>
        </div>
    </div>
</section>

<!-- COLABORADORES -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Colaboradores do Projeto</h2>

        <!-- Colaborador 1 -->
        <div class="collaborator">
            <div class="collaborator-avatar">W</div>
            <div class="collaborator-content">
                <h3>William Matias de Oliveira</h3>
                <div class="collaborator-role">Desenvolvedor</div>
                <div class="collaborator-links">
                    <a href="https://github.com" target="_blank">Github</a>
                    <a href="https://linkedin.com" target="_blank">LinkedIn</a>
                </div>
            </div>
        </div>

        <!-- Colaborador 2 -->
        <div class="collaborator">
            <div style="text-align: right; flex: 1;">
                <h3 style="margin-bottom: 0.5rem;">Vinicius Leonardo Silveira</h3>
                <div class="collaborator-role">Desenvolvedor</div>
                <div class="collaborator-links" style="justify-content: flex-end;">
                    <a href="https://github.com" target="_blank">Github</a>
                    <a href="https://linkedin.com" target="_blank">LinkedIn</a>
                </div>
            </div>
            <div class="collaborator-avatar" style="margin-left: auto;">V</div>
        </div>
    </div>
</section>

<!-- FOOTER -->
@include('components/footer')
