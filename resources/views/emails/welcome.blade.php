<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Conecte</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden;">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#2c7be5; padding:20px; text-align:center; color:#ffffff;">
                            <h1 style="margin:0;">Conecte</h1>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:30px; color:#333333;">

                            <h2 style="margin-top:0;">Bem-vindo, {{ $user->nome }} 👋</h2>

                            <p>
                                Seu cadastro na plataforma <strong>Conecte</strong> foi realizado com sucesso.
                            </p>

                            <p>
                                Agora você já pode acessar seu painel e começar a utilizar o sistema.
                            </p>

                            <!-- BOTÃO -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ $link }}"
                                    style="background:#2c7be5; color:#ffffff; padding:15px 25px; text-decoration:none; border-radius:6px; font-weight:bold;">
                                    Acessar meu dashboard
                                </a>
                            </div>

                            <p>
                                Caso o botão não funcione, copie e cole o link abaixo no navegador:
                            </p>

                            <p style="word-break:break-all;">
                                {{ $link }}
                            </p>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f1f1f1; padding:20px; text-align:center; font-size:12px; color:#666;">
                            © {{ date('Y') }} Conecte — Todos os direitos reservados
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
