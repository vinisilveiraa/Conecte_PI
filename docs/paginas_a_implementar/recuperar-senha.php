<?php
// PÁGINA: RECUPERAR SENHA
$current_page = 'recuperar-senha';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Conecte</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/componentes.css">
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="recovery-container">
        <div class="recovery-card">
            <!-- Ícone de E-mail -->
            <div class="icon-container">
                <div class="email-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0 160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17l0 80c0 13.3 10.7 24 24 24l80 0c13.3 0 24-10.7 24-24l0-40 40 0c13.3 0 24-10.7 24-24l0-40 40 0c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <h1 class=" recovery-title">Recuperar Senha</h1>
            <p class="recovery-description">Insira uma senha nova.</p>

            <!-- Formulário -->
            <form class="recovery-form">
                <div class="form-group">
                    <label for="email" class="form-label">Nova Senha</label>
                    <input
                        type="senha"
                        id="senha"
                        name="senha"
                        class="form-input"
                        placeholder=""
                        required>
                    <label for="email" class="form-label">Confirmar Senha</label>
                    <input
                        type="senha"
                        id="senha"
                        name="senha"
                        class="form-input"
                        placeholder=""
                        required>
                </div>
                <button type="submit" class="btn-submit" style="margin-top: 0;">Confirmar</button>
            </form>
        </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="../js/main.js"></script>
</body>

</html>