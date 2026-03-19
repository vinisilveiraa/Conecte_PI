@include('components.header')
<!-- NAVBAR -->
@include('components.navbar')
<!-- SEÇÃO PRINCIPAL -->
<section class="section">
    <div class="container">
        <h1 class="section-title">A ajuda certa, no momento certo!</h1>

        <!-- Cards de Cadastro -->
        <div
            style="display: flex; flex-wrap: wrap; justify-content: space-evenly; gap: var(--spacing-xl); margin-bottom: 4rem; justify-items: center;">
            <!-- Card 1: Buscando um Cuidador -->
            <div class="card card-list" style="border-top: 4px solid var(--color-primary);">
                <div style="display: flex; justify-content: center; margin-bottom: var(--spacing-md);">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path
                                d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <h3>Buscando um cuidador?</h3>

                <ul>
                    <li>Profissionais confiáveis</li>
                    <li>Escolha fácil e rápida.</li>
                    <li>Sem burocracia.</li>
                    <li>Encontre ajuda quando mais precisar.</li>
                </ul>

                <a href="{{ route('register.client') }}" class="btn btn-primary btn-md btn-block text-center btn-choose">
                    Preciso de um
                </a>
            </div>

            <!-- Card 2: Quer Oferecer Cuidado -->
            <div class="card card-list" style="border-top: 4px solid var(--color-secondary);">
                <div style="display: flex; justify-content: center; margin-bottom: var(--spacing-md);">
                    <div class="icon"
                        style="background-color: var(--color-light-pink); color: var(--color-secondary);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path
                                d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <h3>Quer oferecer cuidado?</h3>

                <ul>
                    <li>Alcance mais pessoas.</li>
                    <li>Destaque sua experiência.</li>
                    <li>Conexão direta, sem burocracia.</li>
                    <li>Flexibilidade para escolher.</li>
                </ul>

                <a href="{{ route('register.caregiver') }}" class="btn btn-secondary btn-md btn-block text-center btn-choose">
                    Seja Cuidador
                </a>
            </div>
        </div>
    </div>
</section>

<!-- COMO FUNCIONA -->
<section class="section section-light">
    <div class="container">
        <h2 class="section-title">Como Funciona?</h2>

        <div class="steps">
            <!-- Step 1 -->
            <div class="card" style="position: relative;">
                <div class="step-number">1</div>
                <div
                    style="display: flex; align-items: center; justify-content: center; margin-bottom: var(--spacing-md); padding-top: var(--spacing-sm);">
                    <div class="step-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path
                                d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>

                <h3>Escolha seu papel</h3>
                <p>Cadastre-se como cuidador ou busque profissionais qualificados.</p>
            </div>

            <!-- Step 2 -->
            <div class="card" style="position: relative;">
                <div class="step-number">2</div>
                <div
                    style="display: flex; align-items: center; justify-content: center; margin-bottom: var(--spacing-md); padding-top: var(--spacing-sm);">
                    <div class="step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path
                                d="M320 32l-8.6 0C300.4 12.9 279.7 0 256 0L128 0C104.3 0 83.6 12.9 72.6 32L64 32C28.7 32 0 60.7 0 96L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-352c0-35.3-28.7-64-64-64zM136 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l112 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-112 0z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <h3>Preencha</h3>
                <p>Informações simples e preferências. Quanto mais detalhes, melhor!</p>
            </div>

            <!-- Step 3 -->
            <div class="card" style="position: relative;">
                <div class="step-number">3</div>
                <div
                    style="display: flex; align-items: center; justify-content: center; margin-bottom: var(--spacing-md); padding-top: var(--spacing-sm);">
                    <div class="step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path
                                d="M512 240c0 132.5-114.6 240-256 240-37.1 0-72.3-7.4-104.1-20.7L33.5 510.1c-9.4 4-20.2 1.7-27.1-5.8S-2 485.8 2.8 476.8l48.8-92.2C19.2 344.3 0 294.3 0 240 0 107.5 114.6 0 256 0S512 107.5 512 240z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <h3>Conecte-se</h3>
                <p>Receba contatos e converse diretamente com quem precisa.</p>
            </div>

            <!-- Step 4 -->
            <div class="card" style="position: relative;">
                <div class="step-number">4</div>
                <div
                    style="display: flex; align-items: center; justify-content: center; margin-bottom: var(--spacing-md); padding-top: var(--spacing-sm);">
                    <div class="step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path
                                d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>
                <h3>Comece o cuidado</h3>
                <p>Combine os detalhes e inicie um cuidado seguro e de confiança.</p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
@include('components.footer')
