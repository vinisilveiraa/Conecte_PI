<?php

/**
 * PÁGINA HOME
 * Página principal do Conecte
 */

$current_page = 'home';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecte - Conectamos quem cuida a quem precisa</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/componentes.css">
</head>

<body>
    <!-- NAVBAR -->
    <?php include '../components/navbar.php'; ?>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>
                        Conectamos quem cuida a quem precisa.
                        <span class="highlight">Simples, rápido e humano.</span>
                    </h1>
                    <p>
                        Encontre o cuidador ideal para suas necessidades ou ofereça seus serviços de cuidado de forma
                        fácil e segura.
                    </p>
                    <a href="cadastro.php" class="btn btn-secondary btn-lg">
                        Quero saber mais
                    </a>
                </div>
                <div class="hero-image">
                    <div
                        style="background: linear-gradient(135deg, #d4f0f0 0%, #e8f8f8 100%); border-radius: 20px; text-align: center; color: #999;">
                        <img src="../assets/imgs/home-hero.png" alt="Cuidador com idosa">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DESTAQUES DA PLATAFORMA -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Destaques da Plataforma</h2>

            <div class="cards-grid">
                <!-- Card 1: Segurança -->
                <div class="card card-icon">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.8 82.8c22 9.3 38.4 31 38.3 57.2-.5 99.2-41.3 280.7-213.6 363.2-16.7 8-36.1 8-52.8 0-172.4-82.5-213.1-264-213.6-363.2-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.9 1 251.4 0 256 0z" fill="currentColor" />
                        </svg>
                    </div>
                    <h3>Segurança</h3>
                    <p>Verificamos informações básicas e priorizamos a privacidade para uma conexão segura.</p>
                </div>

                <!-- Card 2: Conexão Rápida -->
                <div class="card card-icon">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path d="M338.8-9.9c11.9 8.6 16.3 24.2 10.9 37.8L271.3 224 416 224c13.5 0 25.5 8.4 30.1 21.1s.7 26.9-9.6 35.5l-288 240c-11.3 9.4-27.4 9.9-39.3 1.3s-16.3-24.2-10.9-37.8L176.7 288 32 288c-13.5 0-25.5-8.4-30.1-21.1s-.7-26.9 9.6-35.5l288-240c11.3-9.4 27.4-9.9 39.3-1.3z" fill="currentColor" />
                        </svg>
                    </div>
                    <h3>Conexão rápida</h3>
                    <p>Perfil simples e fluxo intuitivo para encontrar o oferecedor serviços em poucos passos.</p>
                </div>

                <!-- Card 3: Humanizado -->
                <div class="card card-icon">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path d="M64 128a112 112 0 1 1 224 0 112 112 0 1 1 -224 0zM0 464c0-97.2 78.8-176 176-176s176 78.8 176 176l0 6c0 23.2-18.8 42-42 42L42 512c-23.2 0-42-18.8-42-42l0-6zM432 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zm0 240c79.5 0 144 64.5 144 144l0 22.4c0 23-18.6 41.6-41.6 41.6l-144.8 0c6.6-12.5 10.4-26.8 10.4-42l0-6c0-51.5-17.4-98.9-46.5-136.7 22.6-14.7 49.6-23.3 78.5-23.3z" fill="currentColor" />
                        </svg>
                    </div>
                    <h3>Humanizado</h3>
                    <p>Foco na experiência do cuidador e do cliente: comunicação clara e respeito.</p>
                </div>

                <!-- Card 4: Responsivo -->
                <div class="card card-icon">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                            <path d="M80 0C44.7 0 16 28.7 16 64l0 384c0 35.3 28.7 64 64 64l224 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L80 0zm72 416l80 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z" fill="currentColor" />
                        </svg>
                    </div>
                    <h3>Responsivo</h3>
                    <p>Funciona bem em celulares e computadores para facilitar o uso em qualquer lugar.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- QUEM SOMOS NÓS -->
    <section class="section section-light">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                <div>
                    <div
                        style="background: linear-gradient(135deg, #f5e6d3 0%, #f0d4e0 100%); padding: 1rem; border-radius: 20px; text-align: center; color: #999; min-height: 300px; display: flex; align-items: center; justify-content: center;">
                        <img style="border-radius: 20px" src="../assets/imgs/home-sobre.png" alt="Cuidador com idosa">
                    </div>
                </div>
                <div>
                    <h2>Quem somos nós?</h2>
                    <p>
                        No Conecte, acreditamos que cuidado de verdade começa com uma boa conexão. Nosso propósito é
                        aproximar cuidadores qualificados de pessoas que precisam de apoio.
                    </p>
                    <p>
                        Nossa missão é oferecer segurança, confiança e praticidade para famílias, enquanto valorizamos
                        profissionais comprometidos com o bem-estar e a saúde de quem precisa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- POR QUE USAR O CONECTE -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Por que usar o Conecte?</h2>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <!-- Card 1: Zero Burocracia -->
                <div class="card card-border-left">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div class="icon" style="margin: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path
                                    d="M241 87.1l15 20.7 15-20.7C296 52.5 336.2 32 378.9 32 452.4 32 512 91.6 512 165.1l0 2.6c0 112.2-139.9 242.5-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1s-30.8-4.6-43.1-14.1C139.9 410.2 0 279.9 0 167.7l0-2.6C0 91.6 59.6 32 133.1 32 175.8 32 216 52.5 241 87.1z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                        <h3 style="margin: 0;">Zero burocracia</h3>
                    </div>
                    <p>Cadastro simples e comunicação direta entre cliente e cuidador.</p>
                </div>

                <!-- Card 2: Transparência -->
                <div class="card card-border-left">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div class="icon" style="margin: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path d="M80 160c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-48 0c-17.7 0-32-14.3-32-32L0 192c0-17.7 14.3-32 32-32l48 0zM270.6 16C297.9 16 320 38.1 320 65.4l0 4.2c0 6.8-1.3 13.6-3.8 19.9L288 160 448 160c26.5 0 48 21.5 48 48 0 19.7-11.9 36.6-28.9 44 17 7.4 28.9 24.3 28.9 44 0 23.4-16.8 42.9-39 47.1 4.4 7.3 7 15.8 7 24.9 0 22.2-15 40.8-35.4 46.3 2.2 5.5 3.4 11.5 3.4 17.7 0 26.5-21.5 48-48 48l-87.9 0c-36.3 0-71.6-12.4-99.9-35.1L184 435.2c-15.2-12.1-24-30.5-24-50l0-186.6c0-14.9 3.5-29.6 10.1-42.9L226.3 43.3C234.7 26.6 251.8 16 270.6 16z" fill="currentColor" />
                            </svg>
                        </div>
                        <h3 style="margin: 0;">Transparência</h3>
                    </div>
                    <p>Avaliações e informações claras para facilitar a escolha com confiança.</p>
                </div>

                <!-- Card 3: Flexibilidade -->
                <div class="card card-border-left">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div class="icon" style="margin: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path d="M168.5 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l32 0 0 25.3c-108 11.9-192 103.5-192 214.7 0 119.3 96.7 216 216 216s216-96.7 216-216c0-39.8-10.8-77.1-29.6-109.2l28.2-28.2c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-23.4 23.4c-32.9-30.2-75.2-50.3-122-55.5l0-25.3 32 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-112 0zm80 184l0 104c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-104c0-13.3 10.7-24 24-24s24 10.7 24 24z" fill="currentColor" />
                            </svg>
                        </div>
                        <h3 style="margin: 0;">Flexibilidade</h3>
                    </div>
                    <p>Encontre profissionais por disponibilidade, local ou tipo de cuidado.</p>
                </div>

                <!-- Card 4: Suporte -->
                <div class="card card-border-left">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div class="icon" style="margin: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                <path d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z" fill="currentColor" />
                            </svg>
                        </div>
                        <h3 style="margin: 0;">Suporte</h3>
                    </div>
                    <p>Mapeamos problemas comuns e desenhamos o fluxo simples para resolver.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ESTATÍSTICAS -->
    <section class="section section-primary">
        <div class="container">
            <div class="stats">
                <div class="stat">
                    <div class="stat-number">24</div>
                    <div class="stat-label">Cuidadores</div>
                </div>
                <div class="stat">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Famílias conectadas</div>
                </div>
                <div class="stat">
                    <div class="stat-number">95</div>
                    <div class="stat-label">Satisfação (%)</div>
                </div>
                <div class="stat">
                    <div class="stat-number">150</div>
                    <div class="stat-label">Horas de atendimento</div>
                </div>
            </div>
            <p style="text-align: center; margin-top: 2rem; font-size: 0.875rem; color: rgba(255, 255, 255, 0.7);">
                * Números baseados em dados fictícios para demonstração
            </p>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include '../components/footer.php'; ?>

    <script src="../js/main.js"></script>
</body>

</html>