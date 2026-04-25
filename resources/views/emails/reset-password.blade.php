<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Conecte</title>
</head>

<body style="margin:0; padding:0; background-color:#eef2f7; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#eef2f7; padding:50px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.08);">

                    <!-- HEADER -->
                    <tr>
                        <td
                            style="background:linear-gradient(135deg,#17a2a2,#2ab8b8); padding:30px; text-align:center; color:#ffffff;">
                            <h1 style="margin:0; font-size:28px; letter-spacing:1px;">Conecte</h1>
                            <p style="margin:5px 0 0; font-size:14px; opacity:0.9;">
                                Conectando você ao cuidado certo
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:40px 35px; color:#333333; line-height:1.6; text-align:center;">

                            <h2 style="margin-top:0; font-size:22px;">
                                Olá, <span style="color:#17a2a2;">{{ $user->nome }}</span> 👋
                            </h2>

                            <p style="margin:10px 0;">
                                Recebemos uma <strong>solicitação para redefinir sua senha</strong>..
                            </p>

                            <!-- BOTÃO -->
                            <div style="text-align:center; margin:35px 0;">
                                <a href="{{ $url }}"
                                    style="
                                    background:linear-gradient(135deg,#17a2a2,#2ab8b8);
                                    color:#ffffff;
                                    padding:15px 30px;
                                    text-decoration:none;
                                    border-radius:8px;
                                    font-weight:bold;
                                    font-size:14px;
                                    display:inline-block;
                                    box-shadow:0 5px 15px rgba(44,123,229,0.3);
                                ">
                                    Redefinir minha senha
                                </a>
                            </div>

                            <p style="margin:15px 0;">
                                Se não foi você, pode ignorar este e-mail...
                            </p>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f5f5f5; padding:25px; text-align:center; font-size:12px; color:#888;">
                            © {{ date('Y') }} <strong>Conecte</strong><br>
                            Todos os direitos reservados
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
