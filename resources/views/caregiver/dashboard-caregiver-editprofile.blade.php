@section('title', 'Editar Perfil Profissional')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR CUIDADOR -->

    @include('components.dashboard-sidebar-cuidador')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <div class="content-header mb-xl">
                <div class="">
                    <h1>Editar Perfil <span>Profissional</span></h1>
                    <p class="text-muted">Mantenha seus dados e certificados em dia para atrair mais clientes.</p>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-md">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-warning mb-md">
                    <ul style="list-style: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data"
                class="edit-profile-form">
                @csrf

                <div class="edit-grid">
                    <!-- COLUNA ESQUERDA: Avatar e Resumo -->
                    <div class="edit-sidebar">
                        <div class="card profile-upload-card">
                            <div class="profile-avatar-edit">

                                <img id="avatar-preview"
                                    src="{{ Auth::user()->foto ? asset('storage/caregivers/' . Auth::user()->foto) : asset('storage/default-avatar.png') }}"
                                    class="avatar-img">

                                <label for="avatarInput" class="avatar-upload-btn">
                                    <i class="fa-solid fa-camera"></i>
                                    <input type="file" name="foto" id="avatarInput" hidden>
                                </label>
                            </div>
                            <h3>{{ Auth::user()->nome }}</h3>
                            {{-- <span class="badge-tag">Cuidador Verificado</span> --}}
                        </div>

                        <div class="card mt-md">
                            <label class="form-label">Sua Bio Profissional</label>
                            <textarea name="bio" class="form-control" rows="6"
                                placeholder="Ex: Sou especialista em cuidados pós-operatórios com 5 anos de experiência...">{{ Auth::user()->caregiver->bio }}</textarea>
                            <small class="text-muted">Destaque suas principais competências aqui.</small>
                        </div>
                    </div>

                    <!-- COLUNA DIREITA: Formulários -->
                    <div class="edit-main">
                        <!-- Dados Pessoais -->
                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-user-gear mr-sm"></i> Dados de Contato</h3>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Nome Completo</label>
                                    <input type="text" name="nome" value="{{ Auth::user()->nome }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label>E-mail</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-sm">
                                <div class="form-group col-6">
                                    <label>WhatsApp / Telefone</label>
                                    <input type="text" name="telefone" value="{{ Auth::user()->telefone }}"
                                        class="form-control phone-mask">
                                </div>
                                <div class="form-group col-6">
                                    <label>CPF (Protegido)</label>
                                    <input type="text" value="{{ Auth::user()->cpf }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- Documentação (Exclusivo Cuidador) -->
                        <div class="card mb-md card-border-primary">
                            <h3 class="card-title"><i class="fa-solid fa-id-card mr-sm"></i> Credenciais e
                                Certificados</h3>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Número do COREN (Opcional)</label>
                                    <input type="text" name="coren" value="{{ Auth::user()->caregiver->coren }}"
                                        class="form-control" placeholder="Ex: 123.456-SP">
                                </div>
                            </div>
                            <div class="form-row mt-md">
                                <div class="form-group col-12">
                                    <label>Certificado de Formação (Imagem)</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" name="certificado_cuidador" class="file-input"
                                            id="certificadoInput">
                                        <div class="file-dummy">
                                            <i class="fa-solid fa-certificate mb-sm"></i>
                                            <span id="file-name">Clique para atualizar seu certificado</span>
                                        </div>
                                    </div>
                                    <div class="certificado-preview" id="certificado-preview">
                                        @if (Auth::user()->caregiver->certificado_cuidador)
                                            <div id="current-certificado" class="current-certificado mt-sm">
                                                <p>Certificado Atual:</p>

                                                @if (str_ends_with(Auth::user()->caregiver->certificado_cuidador, '.pdf'))
                                                    <iframe
                                                        src="{{ asset('storage/' . Auth::user()->caregiver->certificado_cuidador) }}"></iframe>
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->caregiver->certificado_cuidador) }}"
                                                        alt="Certificado Atual">
                                                @endif
                                            </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!-- Endereço -->
                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-location-dot mr-sm"></i> Onde você atende?
                            </h3>
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>CEP</label>
                                    <input type="text" name="cep" value="{{ Auth::user()->address->cep }}"
                                        class="form-control cep-mask">
                                </div>
                                <div class="form-group col-8">
                                    <label>Logradouro</label>
                                    <input type="text" name="logradouro"
                                        value="{{ Auth::user()->address->logradouro }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-sm">
                                <div class="form-group col-5">
                                    <label>Bairro</label>
                                    <input type="text" name="bairro" value="{{ Auth::user()->address->bairro }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-5">
                                    <label>Cidade</label>
                                    <input type="text" name="cidade" value="{{ Auth::user()->address->cidade }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Estado</label>
                                    <input type="text" name="estado" value="{{ Auth::user()->address->estado }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mt-xl">
                            <a href="{{ route('dashboard.caregiver') }}" class="btn btn-outline-primary">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-lg">Atualizar Perfil
                                Profissional</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

@include('components.footer')

<script>
    const cepInput = document.querySelector('input[name="cep"]');

    cepInput.addEventListener('blur', function() {
        let cep = cepInput.value.replace(/\D/g, '');

        if (cep.length !== 8) return;

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(res => res.json())
            .then(data => {
                if (data.erro) return;

                document.querySelector('input[name="logradouro"]').value = data.logradouro;
                document.querySelector('input[name="bairro"]').value = data.bairro;
                document.querySelector('input[name="cidade"]').value = data.localidade;
            })
            .catch(() => {
                console.log('Erro ao buscar CEP');
            });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('avatarInput');

        input.addEventListener('change', function() {
            previewImage(this);
        });
    });

    function previewImage(input) {
        const circle = document.querySelector('.profile-avatar-edit');
        const preview = document.getElementById('avatar-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }

        circle.classList.add('preview-updated');
    }


    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('certificadoInput');
        const container = document.getElementById('certificado-preview');

        if (!input || !container) return;

        input.addEventListener('change', function() {
            const file = this.files[0];

            // ❌ nenhum arquivo
            if (!file) {
                container.style.display = 'none';
                container.innerHTML = '';
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];

            if (!validTypes.includes(file.type)) {
                container.style.display = 'block';
                container.innerHTML = '<p style="color:#b00;">Tipo de arquivo não suportado</p>';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                container.style.display = 'block';
                container.innerHTML = '<p style="color:#b00;">Arquivo muito grande (máx 2MB)</p>';
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                const url = e.target.result;

                // limpa preview antigo
                container.innerHTML = '';
                container.style.display = 'block';

                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = url;
                    img.style.maxWidth = '100%';
                    img.style.borderRadius = '8px';
                    img.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';

                    container.appendChild(img);
                } else if (file.type === 'application/pdf') {
                    const iframe = document.createElement('iframe');
                    iframe.src = url;
                    iframe.width = '100%';
                    iframe.height = '400px';
                    iframe.style.border = '1px solid #eee';
                    iframe.style.borderRadius = '8px';

                    container.appendChild(iframe);
                }
            };

            reader.onerror = function() {
                container.style.display = 'block';
                container.innerHTML = '<p style="color:#b00;">Erro ao carregar o arquivo</p>';
            };

            reader.readAsDataURL(file);
        });
    });
</script>
