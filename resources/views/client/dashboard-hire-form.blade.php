@section('title', 'Contratar Cuidador')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR CLIENTE -->

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <div class="content-header mb-xl">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('client.searchCaregiver') }}">Buscar</a></li>
                        <li class="breadcrumb-item active">Contratação</li>
                    </ol>
                </nav>
                <h1>Solicitar <span>Contratação</span></h1>
                <p class="text-muted">Preencha os detalhes do serviço para enviar a proposta ao cuidador.</p>

            </div>

            <div class="hire-grid">
                <!-- COLUNA ESQUERDA: Resumo do Cuidador -->
                <div class="hire-sidebar">
                    <div class="card caregiver-summary-card">
                        <div class="summary-avatar">
                            @if ($caregiver->user->foto == null)
                                <img src="{{ asset('assets/imgs/default-avatar.svg') }}" alt="">
                            @else
                                <img src="{{ asset('storage/caregivers/' . $caregiver->user->foto) }}"
                                    alt="{{ $caregiver->user->nome }}">
                            @endif
                        </div>

                        <h3 class="mb-0">{{ $caregiver->user->nome }}</h3>
                        <p class="profile-username mb-2">{{ '@' . $caregiver->slug }} | Código:
                            #{{ $caregiver->public_code }}</p>
                        <div class="rating-stars mb-sm">
                            @if ($caregiver->reviews_count > 0)
                                <i class="fa-solid fa-star"></i>
                                <span>{{ number_format($caregiver->reviews_avg_rating, 1) }}</span>
                                <sub class="text-muted">({{ $caregiver->reviews_count }})</sub>
                            @else
                                <span class="text-muted rate-count">Sem avaliações</span>
                            @endif
                        </div>

                        @if ($caregiver->headline == null)
                            <p class="text-sm text-center text-muted">Sem biografia disponível.</p>
                        @else
                            <p class="text-sm text-center">{{ $caregiver->headline }}</p>
                        @endif

                        <hr class="my-md">
                        <div class="summary-info">
                            <div class="info-line">
                                <span class="label">Localização:</span>
                                <span class="value">{{ $caregiver->user->address->cidade }},
                                    {{ $caregiver->user->address->estado }}</span>
                            </div>
                            <div class="info-line">
                                <span class="label">Experiência:</span>
                                <span class="value">{{ $caregiver->experience_years }}+ anos</span>
                            </div>
                            <div class="info-line">
                                <span class="label">Disponibilidade:</span>
                            </div>
                            <div class="availability-schedule tags-container small mb-xs">
                                @if ($caregiver->available_morning)
                                    <span class="badge-tag small">Manhã</span>
                                @endif
                                @if ($caregiver->available_afternoon)
                                    <span class="badge-tag small">Tarde</span>
                                @endif
                                @if ($caregiver->available_night)
                                    <span class="badge-tag small">Noite</span>
                                @endif
                                @if ($caregiver->available_weekends)
                                    <span class="badge-tag small">Fim de Semana</span>
                                @endif
                            </div>
                            <div class="info-line">
                                <span class="label">Especialidades:</span>
                            </div>
                            <div class="availability-schedule tags-container small">
                                @foreach ($caregiver->specialties->take(3) as $specialty)
                                    <span class="badge-tag small">{{ $specialty->nome }}</span>
                                @endforeach
                                @if ($caregiver->specialties->count() > 3)
                                    <span class="badge-tag small">+{{ $caregiver->specialties->count() - 3 }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="card hire-summary-info">
                        <ul class="text-sm text-muted">
                            <li>Você só paga após aceitar</li>
                            <li>Cancelamento gratuito</li>
                            <li>Cuidador será notificado imediatamente</li>
                        </ul>
                    </div>
                </div>

                <!-- COLUNA DIREITA: Formulário de Proposta -->
                <div class="hire-main">
                    <form action="{{ route('client.hire') }}" method="POST" class="hire-form">
                        @csrf
                        <input type="hidden" name="caregiver_id" value="{{ $caregiver->id }}">

                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-calendar-days mr-sm"></i> Período do
                                Serviço
                            </h3>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label class="form-label">Data de Início</label>
                                    <input type="date" name="data_inicio" class="form-control" id="data_inicio"
                                        min="{{ now()->toDateString() }}" required>
                                    @error('data_inicio')
                                        <div class="alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label">Data de Fim</label>
                                    <input type="date" name="data_fim" id="data_fim"
                                        class="form-control"min="{{ now()->toDateString() }}" required>
                                    @error('data_fim')
                                        <div class=" alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-hand-holding-dollar mr-sm"></i> Detalhes
                                Financeiros</h3>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="form-label">Valor do Serviço (R$)</label>
                                    <div class="input-group-custom">
                                        <span class="input-prefix">R$</span>
                                        <input type="number" step="0.01" name="valor_servico" class="form-control"
                                            placeholder="0,00" required>
                                    </div>
                                    @error('valor_servico')
                                        <div class=" alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="text-muted">
                                        @if ($caregiver->hour_price)
                                            Valor definido minimo pelo cuidador:
                                            <strong>{{ $caregiver->hour_price }}/hora</strong>
                                        @else
                                            Defina o valor total,recomendado R$:15,00/hora
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-file-lines mr-sm"></i> Descrição e Endereço
                            </h3>
                            <div class="form-group mb-md">
                                <label class="form-label">Descrição das Atividades</label>
                                <textarea name="descricao_servico" class="form-control" rows="4"
                                    placeholder="Descreva as necessidades do paciente, rotinas e cuidados específicos..." required></textarea>
                                @error('descricao_servico')
                                    <div class=" alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Endereço do Serviço</label>
                                <input type="text" name="endereco_servico" class="form-control"
                                    placeholder="Rua, número, bairro e cidade"
                                    value="{{ Auth::user()->address->logradouro }}, {{ Auth::user()->address->bairro }}"
                                    required>
                                @error('endereco_servico')
                                    <div class=" alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions-hire mt-xl">
                            <button type="submit" class="btn btn-primary btn-lg btn-block"
                                onclick="this.disabled=true; this.form.submit();">
                                <i class="fa-solid fa-paper-plane mr-sm"></i>
                                Enviar Proposta
                            </button>
                            <p class="text-center text-xs text-light mt-sm">
                                O cuidador será notificado e poderá aceitar ou recusar sua proposta.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

@include('components.footer')

<script>
    const dataInicio = document.getElementById('data_inicio');
    const dataFim = document.getElementById('data_fim');

    dataInicio.addEventListener('change', function() {
        dataFim.min = this.value;

        // limpa a data fim se ela for menor
        if (dataFim.value < this.value) {
            dataFim.value = '';
        }
    });
</script>
