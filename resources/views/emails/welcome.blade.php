<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Conecte</title>
</head>

<body style="margin:0; padding:0; background-color:#eef2f7; font-family:Arial, Helvetica, sans-serif;">

```
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#eef2f7; padding:50px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0"
                style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.08);">

                <!-- HEADER -->
                <tr>
                    <td style="background:linear-gradient(135deg,#2c7be5,#1a5edb); padding:30px; text-align:center; color:#ffffff;">
                        <h1 style="margin:0; font-size:28px; letter-spacing:1px;">Conecte</h1>
                        <p style="margin:5px 0 0; font-size:14px; opacity:0.9;">
                            Conectando você ao cuidado certo
                        </p>
                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:40px 35px; color:#333333; line-height:1.6;">

                        <h2 style="margin-top:0; font-size:22px;">
                            Bem-vindo, <span style="color:#2c7be5;">{{ $user->nome }}</span> 👋
                        </h2>

                        <p style="margin:15px 0;">
                            Seu cadastro na plataforma <strong>Conecte</strong> foi realizado com sucesso.
                        </p>

                        <p style="margin:15px 0;">
                            Agora você já pode acessar seu painel e começar a utilizar o sistema com total praticidade.
                        </p>

                        <!-- BOTÃO -->
                        <div style="text-align:center; margin:35px 0;">
                            <a href="{{ $link }}"
                                style="
                                    background:linear-gradient(135deg,#2c7be5,#1a5edb);
                                    color:#ffffff;
                                    padding:15px 30px;
                                    text-decoration:none;
                                    border-radius:8px;
                                    font-weight:bold;
                                    font-size:14px;
                                    display:inline-block;
                                    box-shadow:0 5px 15px rgba(44,123,229,0.3);
                                ">
                                Acessar meu dashboard
                            </a>
                        </div>

                        <p style="font-size:13px; color:#777;">
                            Caso o botão não funcione, copie e cole o link abaixo no navegador:
                        </p>

                        <p style="word-break:break-all; font-size:13px; color:#2c7be5;">
                            {{ $link }}
                        </p>

                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background:#f8f9fc; padding:25px; text-align:center; font-size:12px; color:#888;">
                        © {{ date('Y') }} <strong>Conecte</strong><br>
                        Todos os direitos reservados
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>
```

</body>

</html>
