<aside class="dashboard-sidebar" id="dashboardSidebar">
    <div class="sidebar-content">
        <!-- Header -->
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <i class="fa-solid fa-heart-pulse sidebar-icon-main"></i>
                <span class="sidebar-text brand-name">Dashboard</span>
            </div>
        </div>

        <!-- Menu -->
        <nav class="sidebar-menu">
            <a href="{{ route('dashboard.caregiver') }}"
                class="sidebar-menu-item {{ request()->routeIs('dashboard.caregiver') ? 'active' : '' }}" title="Início">
                <i class="fa-solid fa-house"></i>
                <span class="sidebar-text">Início</span>
            </a>

            <a href="{{ route('caregiver.proposals') }}"
                class="sidebar-menu-item {{ request()->routeIs('caregiver.proposals') ? 'active' : '' }}"
                title="Propostas">
                <i class="fa-solid fa-file-invoice"></i>
                <span class="sidebar-text">Propostas</span>
            </a>

            <a href="{{ route('caregiver.showReviews') }}"
                class="sidebar-menu-item {{ request()->routeIs('caregiver.showReviews') ? 'active' : '' }}"
                title="Avaliações">
                <i class="fa-solid fa-star"></i>
                <span class="sidebar-text">Avaliações</span>
            </a>

            <a href="{{ route('caregiver.specialties') }}"
                class="sidebar-menu-item {{ request()->routeIs('caregiver.specialties') ? 'active' : '' }}"
                title="Especialidades">
                <i class="fa-solid fa-hand-holding-medical"></i>
                <span class="sidebar-text">Especialidades</span>
            </a>
        </nav>

        <!-- Footer -->
        <div class="sidebar-footer">
            <div class="sidebar-user-card">
                <div class="sidebar-user-avatar">
                    @if (Auth::user()->foto)
                        <img src="{{ asset('storage/caregivers/' . Auth::user()->foto) }}" alt="Avatar">
                    @else
                        <i class="fa-solid fa-user"></i>
                    @endif
                </div>
                <div class="sidebar-text sidebar-user-info">
                    <span class="sidebar-user-name">{{ explode(' ', Auth::user()->nome)[0] }}</span>
                    <span class="sidebar-user-role">Cuidador</span>
                </div>
            </div>
        </div>
    </div>
</aside>
