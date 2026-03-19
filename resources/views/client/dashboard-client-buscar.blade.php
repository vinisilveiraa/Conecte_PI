{{-- TITLE --}}
@section('title', 'Buscar Cuidadores')
{{-- HEADER --}}
@include('components.header-dashboard')
<!-- NAVBAR -->
@include('components.navbar')

<div class="dashboard-wrapper">
    <!-- SIDEBAR -->
    @include('components.dashboard-sidebar-cliente')

    <!-- MAIN CONTENT -->
    <main class="dashboard-content">
        <div class="container">
            <h1>Buscar Cuidadores</h1>

            <div class="search-wrapper">
                <!-- FILTROS -->
                <div class="filters-card">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        Filtros
                    </h3>

                    <div class="filter-group">
                        <label>Pessoais</label>
                        <select>
                            <option>Selecionar</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Saúde</label>
                        <select>
                            <option>Selecionar</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Rotina</label>
                        <select>
                            <option>Selecionar</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Apoio</label>
                        <select>
                            <option>Selecionar</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Tarefas</label>
                        <select>
                            <option>Selecionar</option>
                        </select>
                    </div>
                </div>

                <!-- CAREGIVERS GRID -->
                <div class="caregivers-grid">
                    <?php foreach ($caregivers as $caregiver): ?>
                    <div class="caregiver-card">
                        <div class="caregiver-avatar"><?php echo substr($caregiver['name'], 0, 1); ?></div>
                        <h3><?php echo $caregiver['name']; ?></h3>

                        <div class="caregiver-rating">
                            <span class="rating-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M14 17H9v-5h5v5zm-2.5-8c-1.38 0-2.5-1.12-2.5-2.5S10.12 4 11.5 4 14 5.12 14 6.5 12.88 9 11.5 9z" />
                                </svg>
                                <?php echo $caregiver['rating']; ?>
                            </span>
                            <span class="rating-item dislike">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M10 7H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h5v2h2V9c0-1.1-.9-2-2-2zm0 10H5V9h5v8z" />
                                </svg>
                                <?php echo $caregiver['dislikes']; ?>
                            </span>
                        </div>

                        <div class="caregiver-actions">
                            <button class="btn btn-outline btn-sm">Currículo</button>
                            <button class="btn btn-primary btn-sm">Contratar</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="../js/main.js"></script>
</body>

</html>
