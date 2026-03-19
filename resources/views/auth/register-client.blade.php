{{-- TITLE --}}
@section('title', 'Cadastro de Cliente')
{{-- HEADER --}}
@include('components.header')
<!-- NAVBAR -->
@include('components.navbar')
<!-- MAIN CONTENT -->
<main class="cadastro-container">
    @if (session('error'))
        <div
            style="
                text-align:center;
                padding:12px;
                margin-bottom:20px;
                background-color:#ff4d4f;
                border-radius:6px;
                font-weight:600;
                box-shadow:0 2px 6px rgba(0,0,0,0.1);
            ">
            <p style="font-size:1.1rem; margin:0; color:white">
                {{ session('error') }}
            </p>
        </div>
    @endif
    <div class="cadastro-wrapper">
        <!-- SEÇÃO ESQUERDA - CTA -->
        <div class="cadastro-sidebar">
            <h2>Cadastre-se<br>Gratuitamente!</h2>
            <p>Preencha os campos abaixo para criar sua conta como cliente.</p>
            <p class="login-link">Já possui uma conta? <a href="login.php">Entre aqui!</a></p>
        </div>

        <!-- SEÇÃO DIREITA - FORMULÁRIO -->
        <div class="cadastro-form-section">
            <form action="{{ route('register') }}" method="POST" class="cadastro-form">
                @csrf
                <!-- DADOS PESSOAIS -->

                <input type="hidden"name="role" value="client">

                <div class="form-section">
                    <h3 class="form-section-title">Dados Pessoais</h3>

                    <div class="form-row" style="grid-template-columns: 1fr;">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite seu Nome"value="{{ old('nome') }}">
                            {{-- ERRO --}}
                            @error('nome')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for=" cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" placeholder="CPF"value="{{ old('cpf') }}">
                            {{-- ERRO --}}
                            @error('cpf')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="text" id="rg" name="rg" placeholder=""value="{{ old('rg') }}">
                            {{-- ERRO --}}
                            @error('rg')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="email@example.com"value="{{ old('email') }}">
                        {{-- ERRO --}}
                        @error('email')
                            <div style="color:#ff0000;font-weight:bold">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX"value="{{ old('telefone') }}">
                        {{-- ERRO --}}
                        @error('telefone')
                            <div style="color:#ff0000;font-weight:bold">
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
                            <input type="text" id="cep" name="cep" placeholder="12456-789"value="{{ old('cep') }}">
                            {{-- ERRO --}}
                            @error('cep')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" id="logradouro" name="logradouro" placeholder=""value="{{ old('logradouro') }}">
                            {{-- ERRO --}}
                            @error('logradouro')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" name="bairro" placeholder=""value="{{ old('bairro') }}">
                            {{-- ERRO --}}
                            @error('bairro')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" name="cidade" placeholder=""value="{{ old('cidade') }}">
                            {{-- ERRO --}}
                            @error('cidade')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" name="estado" placeholder=""value="{{ old('estado') }}">
                            {{-- ERRO --}}
                            @error('estado')
                                <div style="color:#ff0000;font-weight:bold">
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
                            {{-- ERRO --}}
                            @error('password')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="senha_confirmation">Confirmar Senha</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="">
                            {{-- ERRO --}}
                            @error('password_confirmation')
                                <div style="color:#ff0000;font-weight:bold">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
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
