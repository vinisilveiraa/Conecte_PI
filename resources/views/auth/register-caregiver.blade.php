{{-- HEADER --}}
@include('components.header')
<!-- NAVBAR -->
@include('components.navbar')

<!-- MAIN CONTENT -->
<main class="cadastro-container">
    <div class="cadastro-wrapper">
        <!-- SEÇÃO ESQUERDA - CTA -->
        <div class="cadastro-sidebar">
            <h2>Cadastre-se<br>Gratuitamente!</h2>
            <p>Preencha os campos abaixo para criar sua conta como cuidador.</p>
            <p class="login-link">Já possui uma conta? <a href="login.php">Entre aqui!</a></p>
        </div>

        <!-- SEÇÃO DIREITA - FORMULÁRIO -->
        <div class="cadastro-form-section">
            <form class="cadastro-form" method="POST" action="{{ route('register') }}"enctype="multipart/form-data">
                @csrf

                <input type="hidden"name='role' value='caregiver'>

                <!-- DADOS PESSOAIS -->
                <div class="form-section">
                    <h3 class="form-section-title">Dados Pessoais</h3>

                    <div class="form-row" style="grid-template-columns: 1fr;">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="">
                            {{-- erro --}}
                            @error('nome')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for=" cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" placeholder="">
                            {{-- erro --}}
                            @error('cpf')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="text" id="rg" name="rg" placeholder="">
                            {{-- erro --}}
                            @error('rg')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="">
                        {{-- erro --}}
                        @error('email')
                            <div class="text-danger fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="">
                        {{-- erro --}}
                        @error('telefone')
                            <div class="text-danger fw-bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- ENDEREÇO -->
                <div class="form-section">
                    <h3 class="form-section-title">Endereço</h3>

                    <div class="form-row" style="grid-template-columns: 1fr;">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" placeholder="">
                            {{-- erro --}}
                            @error('cep')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" id="logradouro" name="logradouro" placeholder="">
                            {{-- erro --}}
                            @error('logradouro')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" placeholder="">
                            {{-- erro --}}
                            @error('bairro')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" placeholder="">
                            {{-- erro --}}
                            @error('cidade')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" name="estado" placeholder="">
                            {{-- erro --}}
                            @error('estado')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Cuidador -->
                <div class="form-section">
                    <h3 class="form-section-title">Cuidador</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="coren">Coren</label>
                            <input type="text" id="coren" name="coren" placeholder="">
                            {{-- erro --}}
                            @error('coren')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row" style="grid-template-columns: 1fr;">
                        <div class="form-group">
                            <label for="certificado_cuidador">Certificado</label>
                            <input type="file" id="certificado_cuidador" name="certificado_cuidador"
                                accept="application/pdf ,image/*">
                            {{-- erro --}}
                            @error('certificado_cuidador')
                                <div class="text-danger fw-bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEGURANÇA -->
                <div class="form-section">
                    <h3 class="form-section-title">Segurança</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" id="password" name="password" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="">
                        </div>
                    </div>
                    {{-- erro --}}
                    @error('password')
                        <div class="text-danger fw-bold">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Arquivos</h3>

                    <div class="form-row" style="grid-template-columns: 1fr;">
                        <div class="form-group">
                            <label for="foto">Foto de Perfil</label>
                            <input type="file" id="foto" name="foto" accept="image/*">
                        </div>
                        <div id="preview-container" style="margin-top: 10px; display: none;">
                            <img id="preview-img" src="" alt="Preview"
                                style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                        </div>
                    </div>

                    <!-- BOTÃO ENVIAR -->
                    <button type="submit" class="btn btn-submit">Cadastrar-se</button>
            </form>
        </div>
    </div>
</main>

<!-- FOOTER -->
@include('components.footer')

<script>
    document.getElementById('cep').addEventListener('blur', function() {

        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) return;

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {

                if (data.erro) return;

                document.getElementById('logradouro').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;

            });
    });
</script>
