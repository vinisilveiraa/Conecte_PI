<?php
// PÁGINA: REDEFINIR SENHA
$current_page = 'redefinir-senha';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - Conecte</title>
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
                        <path d="M48 64c-26.5 0-48 21.5-48 48 0 15.1 7.1 29.3 19.2 38.4l208 156c17.1 12.8 40.5 12.8 57.6 0l208-156c12.1-9.1 19.2-23.3 19.2-38.4 0-26.5-21.5-48-48-48L48 64zM0 196L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-188-198.4 148.8c-34.1 25.6-81.1 25.6-115.2 0L0 196z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <h1 class="recovery-title">Recuperar Senha</h1>
            <p class="recovery-description">Informe seu e-mail para receber o link de recuperação.</p>

            <!-- Formulário -->
            <form class="recovery-form">
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="seu@email.com"
                        required>
                </div>
                <button type="submit" class="btn-submit" style="margin-top: 0;">Enviar Link de Recuperação</button>
            </form>
        </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="../js/main.js"></script>
</body>

</html>