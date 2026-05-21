@section('title', 'Editar Perfil')
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
                    <p class="text-muted">Mantenha seus dados de úsuario em dia.</p>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <span>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </span>
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
                                    src="{{ Auth::user()->foto ? asset('storage/caregivers/' . Auth::user()->foto) : asset('assets/imgs/default-avatar.svg') }}"
                                    class="avatar-img">

                                <label for="avatarInput" class="avatar-upload-btn">
                                    <i class="fa-solid fa-pencil"></i>
                                    <input type="file" name="foto" id="avatarInput" hidden>
                                </label>
                            </div>
                            <h3>{{ Auth::user()->nome }}</h3>
                            <p class="profile-type">Cuidador Conecte</p>
                            {{-- <span class="badge-tag">Cuidador Verificado</span> --}}
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
                                        class="form-control phone-mask" maxlength="15">
                                </div>
                                <div class="form-group col-6">
                                    <label>CPF (Protegido)</label>
                                    <input type="text" value="{{ Auth::user()->cpf }}" class="form-control" disabled>
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
                                    <input type="text" name="cep" id="cep"
                                        value="{{ Auth::user()->address->cep }}" class="form-control cep-mask" maxlength="9">
                                </div>
                                <div class="form-group col-8">
                                    <label>Logradouro</label>
                                    <input type="text" name="logradouro" id="logradouro"
                                        value="{{ Auth::user()->address->logradouro }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-sm">
                                <div class="form-group col-5">
                                    <label>Número</label>
                                    <input type="text" name="numero" id="numero" maxlength="4"
                                        value="{{ Auth::user()->address->numero }}" class="form-control">
                                </div>
                                <div class="form-group col-5">
                                    <label>Bairro</label>
                                    <input type="text" name="bairro" id="bairro"
                                        value="{{ Auth::user()->address->bairro }}" class="form-control">
                                </div>
                                <div class="form-group col-5">
                                    <label>Cidade</label>
                                    <input type="text" name="cidade" id="cidade"
                                        value="{{ Auth::user()->address->cidade }}" class="form-control">
                                </div>
                                <div class="form-group col-2">
                                    <label>Estado</label>
                                    <input type="text" name="estado" id="estado"
                                        value="{{ Auth::user()->address->estado }}" class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                        </div>


                        <div class="form-actions text-right">
                            <a href="{{ route('dashboard.caregiver') }}" class="btn btn-outline-primary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>

                    </div>
                </div>
        </div>
        </form>
</div>
</main>
</div>

@include('components.footer')

<script>
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


    // document.addEventListener('DOMContentLoaded', function() {
    //     const input = document.getElementById('certificadoInput');
    //     const container = document.getElementById('certificado-preview');

    //     if (!input || !container) return;

    //     input.addEventListener('change', function() {
    //         const file = this.files[0];

    //         if (!file) {
    //             container.style.display = 'none';
    //             container.innerHTML = '';
    //             return;
    //         }

    //         const validTypes = ['image/jpeg', 'image/png', 'application/pdf'];

    //         if (!validTypes.includes(file.type)) {
    //             container.style.display = 'block';
    //             container.innerHTML = '<p style="color:#b00;">Tipo de arquivo não suportado</p>';
    //             return;
    //         }

    //         if (file.size > 2 * 1024 * 1024) {
    //             container.style.display = 'block';
    //             container.innerHTML = '<p style="color:#b00;">Arquivo muito grande (máx 2MB)</p>';
    //             return;
    //         }

    //         const reader = new FileReader();

    //         reader.onload = function(e) {
    //             const url = e.target.result;

    //             // limpa preview antigo
    //             container.innerHTML = '';
    //             container.style.display = 'block';

    //             if (file.type.startsWith('image/')) {
    //                 const img = document.createElement('img');
    //                 img.src = url;
    //                 img.style.maxWidth = '100%';
    //                 img.style.borderRadius = '8px';
    //                 img.style.boxShadow = '0 2px 8px rgba(0,0,0,0.08)';

    //                 container.appendChild(img);
    //             } else if (file.type === 'application/pdf') {
    //                 const iframe = document.createElement('iframe');
    //                 iframe.src = url;
    //                 iframe.width = '100%';
    //                 iframe.height = '400px';
    //                 iframe.style.border = '1px solid #eee';
    //                 iframe.style.borderRadius = '8px';

    //                 container.appendChild(iframe);
    //             }
    //         };

    //         reader.onerror = function() {
    //             container.style.display = 'block';
    //             container.innerHTML = '<p style="color:#b00;">Erro ao carregar o arquivo</p>';
    //         };

    //         reader.readAsDataURL(file);
    //     });
    // });
</script>
