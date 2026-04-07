@section('title', 'Contratar Cuidador')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR CLIENTE -->
    @include('components.dashboard-sidebar-cliente')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <div class="content-header mb-xl">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('select.specialty') }}">Buscar</a></li>
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
                            @if ($caregiver->foto == null)
                                <div class="avatar-placeholder"><i class="fa-solid fa-user"></i></div>
                            @else
                                <img src="{{ asset('storage/caregivers/' . $caregiver->foto) }}"
                                    alt="{{ $caregiver->nome }}">
                            @endif
                        </div>
                        <h3>{{ $caregiver->nome }}</h3>
                        <div class="rating-stars mb-sm">
                            <span class="text-primary">★★★★★</span>
                            <span class="text-xs text-muted">(4.9)</span>
                        </div>
                        @if ($caregiver->bio == null)
                            <p class="text-sm text-center text-muted">Sem biografia disponível.</p>
                        @else
                            <p class="text-sm text-center">{{ $caregiver->bio }}</p>
                        @endif
                        <hr class="my-md">
                        <div class="summary-info">
                            <div class="info-line">
                                <span class="label">Localização:</span>
                                <span class="value">{{ $caregiver->address->cidade }},
                                    {{ $caregiver->address->estado }}</span>
                            </div>
                            {{-- <div class="info-line">
                                <span class="label">Experiência:</span>
                                <span class="value">5+ anos</span>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- COLUNA DIREITA: Formulário de Proposta -->
                <div class="hire-main">
                    <form action="{{ route('client.hire') }}" method="POST" class="hire-form">
                        @csrf
                        <input type="hidden" name="caregiver_id" value="{{ $caregiver->id }}">

                        <div class="card mb-md">
                            <h3 class="card-title"><i class="fa-solid fa-calendar-days mr-sm"></i> Período do Serviço
                            </h3>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label class="form-label">Data de Início</label>
                                    <input type="date" name="data_inicio" class="form-control" required>
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-label">Data de Fim</label>
                                    <input type="date" name="data_fim" class="form-control" required>
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
                                    <small class="text-muted">Defina o valor total, recomendado R$:15,00/hora.</small>
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
                            </div>
                            <div class="form-group">
                                <label class="form-label">Endereço do Serviço</label>
                                <input type="text" name="endereco_servico" class="form-control"
                                    placeholder="Rua, número, bairro e cidade"
                                    value="{{ Auth::user()->address->logradouro }}, {{ Auth::user()->address->bairro }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-actions-hire mt-xl">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fa-solid fa-paper-plane mr-sm"></i> Enviar Proposta de Contratação
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
