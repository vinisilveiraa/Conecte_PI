{{-- TITLE --}}
@section('title', 'Editar Perfil Profissional')
@include('components.header-dashboard')
@include('components.navbar')


<div class="dashboard-wrapper">

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <h1 class="mb-4">Editar Perfil de Cuidador</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('update.caregiver') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="edit-grid caregiver-profile-edit">
                    <!-- Coluna da Esquerda: Avatar e Certificado -->
                    <div class="profile-upload-card card mb-4">
                        <h3 class="mb-0">Certificado de Cuidador</h3>
                        <p class="text-muted ">(Opcional caso envie COREN)</p>
                        @php
                            $extension = strtolower(pathinfo($caregiver->certificado_cuidador, PATHINFO_EXTENSION));
                        @endphp

                        <div class="certificado-preview mb-3">
                            @if (!empty($caregiver->certificado_cuidador))

                                @if ($extension === 'pdf')
                                    <iframe src="{{ route('caregiver.certificate', $caregiver->id) }}" width="100%"
                                        height="150px">
                                    </iframe>
                                @else
                                    <img src="{{ route('caregiver.certificate', $caregiver->id) }}" alt="Certificado"
                                        class="img-fluid">
                                @endif
                            @else
                                <p class="text-muted">Nenhum certificado enviado.</p>
                            @endif
                        </div>
                        <div class="file-upload-wrapper">
                            <input type="file" id="certificado_cuidador" name="certificado_cuidador"
                                accept=".pdf,image/*" class="file-input">
                            <div class="file-dummy">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Arraste e solte seu certificado aqui ou clique para fazer upload</p>
                                <small class="text-muted">(PDF ou Imagem)</small>
                            </div>
                        </div>
                        @error('certificado_cuidador')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Coluna da Direita: Detalhes do Cuidador -->
                    <div class="edit-main">
                        <div class="card mb-4">
                            <h3 class="card-title">Informações do Cuidador</h3>
                            <div class="form-row mb-3">
                                <div class="form-group mb-3">
                                    <label for="coren" class="form-label">COREN <span class="text-muted">(Opcional
                                            caso envie certificado)</span></label>
                                    <input type="text" id="coren" name="coren" class="form-control"
                                        value="{{ old('coren', $caregiver->coren ?? '') }}" placeholder="Ex: 123456-SP">
                                    @error('coren')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="slug-text">
                                        <label for="slug" class="form-label">Nome de usuário</label>
                                        <span class="text-danger" id="slug-feedback"></span>
                                    </div>

                                    <input type="text" id="slug" name="slug" class="form-control"
                                        maxlength="24" value="{{ old('slug', $caregiver->slug ?? '') }}"
                                        placeholder="nome-sobrenome">
                                    <small id="slug-preview" class="text-muted"></small>

                                    @error('slug')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <h3 class="card-title">Informações Profissionais</h3>
                            <div class="form-group mb-3">
                                <label for="headline" class="form-label">Título Profissional (Headline)</label>
                                <input type="text" id="headline" name="headline" class="form-control"
                                    value="{{ old('headline', $caregiver->headline ?? '') }}"
                                    placeholder="Ex: Cuidador(a) com experiência em idosos e pós-cirúrgicos"
                                    maxlength="120">
                                @error('headline')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="bio" class="form-label">Biografia</label>
                                <textarea id="bio" name="bio" class="form-control" rows="5"
                                    placeholder="Fale um pouco sobre você, sua experiência e paixão por cuidar.">{{ old('bio', $caregiver->bio ?? '') }}</textarea>
                                @error('bio')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group mb-3">
                                    <label for="hour_price" class="form-label">Valor da Hora (R$)</label>
                                    <div class="input-group-custom">
                                        <span class="input-prefix">R$</span>
                                        <input type="number" id="hour_price" name="hour_price" class="form-control"
                                            value="{{ old('hour_price', $caregiver->hour_price ?? 0) }}" step="0.01"
                                            min="0">
                                    </div>
                                    @error('hour_price')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="experience_years" class="form-label">Anos de Experiência</label>
                                    <input type="number" id="experience_years" name="experience_years"
                                        class="form-control"
                                        value="{{ old('experience_years', $caregiver->experience_years ?? 0) }}"
                                        min="0" maxlength="100">
                                    @error('experience_years')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <h3 class="card-title">Disponibilidade</h3>
                            <div class="form-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="available_morning" value="1"
                                        {{ old('available_morning', $caregiver->available_morning ?? false) ? 'checked' : '' }}>
                                    <span>Manhã</span>
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="available_afternoon" value="1"
                                        {{ old('available_afternoon', $caregiver->available_afternoon ?? false) ? 'checked' : '' }}>
                                    <span>Tarde</span>
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="available_night" value="1"
                                        {{ old('available_night', $caregiver->available_night ?? false) ? 'checked' : '' }}>
                                    <span>Noite</span>
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="available_weekends" value="1"
                                        {{ old('available_weekends', $caregiver->available_weekends ?? false) ? 'checked' : '' }}>
                                    <span>Finais de Semana</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="{{ route('dashboard.caregiver') }}" class="btn btn-outline-primary">Cancelar</a>
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

        const slugInput = document.getElementById('slug');
        const feedback = document.getElementById('slug-feedback');
        const preview = document.getElementById('slug-preview');

        let timeout;

        // VERIFICA EM TEMPO REAL
        slugInput.addEventListener('input', function() {

            clearTimeout(timeout);

            timeout = setTimeout(async () => {

                try {

                    const response = await fetch(
                        `/caregiver/check-slug?slug=${encodeURIComponent(slugInput.value)}`
                    );

                    const data = await response.json();

                    feedback.textContent = data.available ?
                        '* Username disponível' :
                        '* Username já está em uso';

                    feedback.className = data.available ?
                        'text-success' :
                        'text-danger';

                    preview.textContent =
                        `URL do perfil: conecte.com/cuidador/${data.slug}`;

                } catch (error) {

                    feedback.textContent = 'Erro ao verificar username';
                    feedback.className = 'text-danger';
                }

            }, 400);
        });

        // FORMATA APENAS QUANDO SAIR DO INPUT
        slugInput.addEventListener('blur', async function() {

            try {
                const response = await fetch(
                    `/caregiver/check-slug?slug=${encodeURIComponent(slugInput.value)}`
                );

                const data = await response.json();

                slugInput.value = data.slug;

                preview.textContent = `URL do perfil: conecte.com/cuidador/${data.slug}`;

            } catch (error) {
                console.error(error);
            }
        });

        const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB
        const certificadoInput = document.getElementById('certificado_cuidador');
        const certificadoPreview = document.querySelector('.certificado-preview');
        const fileDummy = document.querySelector('.file-dummy');

        if (certificadoInput) {
            certificadoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    if (file.size > MAX_FILE_SIZE) {
                        certificadoPreview.innerHTML =
                            '<p class="text-danger">Arquivo muito grande. Limite de 2MB.</p>';
                        fileDummy.querySelector('p').textContent =
                            'Arraste e solte seu certificado aqui ou clique para fazer upload';
                        fileDummy.querySelector('small').textContent = '(PDF ou Imagem)';
                        certificadoInput.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        certificadoPreview.innerHTML = ''; // limpa o preview existente


                        if (file.type === 'application/pdf') {
                            const iframe = document.createElement('iframe');
                            iframe.src = e.target.result;
                            iframe.width = '100%';
                            iframe.height = '150px';
                            iframe.style.border = '1px solid #eee';
                            iframe.style.borderRadius = '8px';
                            certificadoPreview.appendChild(iframe);
                        } else if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Certificado';
                            img.style.width = '250px';
                            img.style.borderRadius = '8px';
                            img.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.08)';
                            certificadoPreview.appendChild(img);
                        } else {
                            certificadoPreview.innerHTML =
                                '<p class="text-danger">Formato de arquivo não suportado.</p>';
                        }
                        fileDummy.querySelector('p').textContent = file.name;
                        fileDummy.querySelector('small').textContent = '';
                    };
                    reader.readAsDataURL(file);
                } else {
                    certificadoPreview.innerHTML =
                        '<p class="text-muted">Nenhum certificado enviado.</p>';
                    fileDummy.querySelector('p').textContent =
                        'Arraste e solte seu certificado aqui ou clique para fazer upload';
                    fileDummy.querySelector('small').textContent = '(PDF ou Imagem)';
                }
            });
        }
    });
</script>
