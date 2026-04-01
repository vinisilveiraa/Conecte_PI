@section('title', 'Editar Meu Perfil')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR CLIENTE -->
    @include('components.dashboard-sidebar-cliente')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <div class="content-header mb-xl">
                <h1>Meu <span>Perfil</span></h1>
                <p class="text-light">Atualize seus dados para que os cuidadores saibam como entrar em contato.</p>
            </div>

            <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data"
                class="edit-profile-form">
                @csrf

                <div class="edit-grid">
                    <!-- COLUNA ESQUERDA: Avatar e Bio -->
                    <div class="edit-sidebar">
                        <div class="card profile-upload-card">
                            <div class="profile-avatar-edit">
                                @if (Auth::user()->foto == null)
                                    <div class="avatar-placeholder"><i class="fa-solid fa-user"></i></div>
                                @else
                                    <img src="{{ asset('assets/imgs/clients/' . Auth::user()->foto) }}"
                                        id="avatar-preview">
                                @endif
                                <label for="avatarInput" class="avatar-upload-btn">
                                    <i class="fa-solid fa-pencil"></i>
                                    <input type="file" name="foto" id="avatarInput" hidden
                                        onchange="previewImage(this, 'avatar-preview')">
                                </label>
                            </div>
                            <h3>{{ Auth::user()->nome }}</h3>
                            <p class="profile-type">Cliente Conecte</p>
                        </div>

                        <div class="card mt-md">
                            <label class="form-label">Bio (Opcional)</label>
                            <textarea name="bio" class="form-control" rows="4"
                                placeholder="Ex: Preciso de um cuidador para meu pai aos finais de semana...">{{ Auth::user()->bio }}</textarea>
                        </div>
                    </div>

                    <!-- COLUNA DIREITA: Dados -->
                    <div class="edit-main">
                        <!-- Dados Pessoais -->
                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-id-card mr-sm"></i> Dados Pessoais</h3>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label>Nome Completo</label>
                                    <input type="text" name="nome" value="{{ Auth::user()->nome }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-sm">
                                <div class="form-group col-6">
                                    <label>E-mail</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control">
                                </div>
                                <div class="form-group col-6">
                                    <label>WhatsApp / Telefone</label>
                                    <input type="text" name="telefone" value="{{ Auth::user()->telefone }}"
                                        class="form-control phone-mask">
                                </div>
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-map-location-dot mr-sm"></i> Seu Endereço</h3>
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
                                    <label>UF</label>
                                    <input type="text" name="uf" value="{{ Auth::user()->address->uf }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mt-xl">
                            <a href="{{ route('dashboard.client') }}" class="btn btn-outline-primary">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-lg">Salvar Alterações</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>


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
</script>
