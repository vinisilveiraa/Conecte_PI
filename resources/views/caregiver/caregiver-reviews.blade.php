@section('title', 'Minhas Avaliações')
@include('components.header-dashboard')
@include('components.navbar')

<div class="dashboard-wrapper">
    @include('components.dashboard-sidebar-cuidador')

    <main class="dashboard-content">
        <div class="container">
            <h1 class="mb-4">Minhas Avaliações</h1>

            <div class="search-header">
                <p><strong>{{ $reviews->total() }}</strong> avaliações encontradas</p>

                <form action="{{ route('caregiver.showReviews') }}" method="GET" class="m-0">

                    @foreach (request()->except(['sort_time', 'sort_rating']) as $key => $value)
                        @if (is_array($value))
                            @foreach ($value as $v)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <div class="search-sort">

                        {{-- SORT POR TEMPO --}}
                        <select name="sort_time" onchange="this.form.submit()">
                            <option value="">Tempo</option>
                            <option value="newest" {{ request('sort_time') == 'newest' ? 'selected' : '' }}>
                                Mais recentes
                            </option>
                            <option value="oldest" {{ request('sort_time') == 'oldest' ? 'selected' : '' }}>
                                Mais antigas
                            </option>
                        </select>

                        {{-- SORT POR AVALIAÇÃO --}}
                        <select name="sort_rating" onchange="this.form.submit()">
                            <option value="">Avaliação</option>
                            <option value="highest_rating"
                                {{ request('sort_rating') == 'highest_rating' ? 'selected' : '' }}>
                                Maior avaliação
                            </option>
                            <option value="lowest_rating"
                                {{ request('sort_rating') == 'lowest_rating' ? 'selected' : '' }}>
                                Menor avaliação
                            </option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="reviews-page-grid">
                <!-- FILTROS -->
                <div class="filters-sidebar">
                    <h3><i class="fas fa-filter"></i> Filtros</h3>

                    <form action="{{ route('caregiver.showReviews') }}" method="GET">
                        @foreach (request()->except(['rating', 'sort']) as $key => $value)
                            @if (is_array($value))
                                @foreach ($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <div class="filter-section">
                            <div class="filter-title" onclick="toggleSection('sec-rating')">
                                Avaliação por Estrelas
                                <i class="fas fa-chevron-up text-muted small"></i>
                            </div>

                            <div class="filter-options active" id="sec-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="rating[]" value="{{ $i }}"
                                            {{ is_array(request('rating')) && in_array($i, request('rating')) ? 'checked' : '' }}>

                                        <span>
                                            @for ($j = 1; $j <= $i; $j++)
                                                <i class="fas fa-star filled"></i>
                                            @endfor
                                            @for ($j = $i + 1; $j <= 5; $j++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                            ({{ $i }} Estrela{{ $i > 1 ? 's' : '' }})
                                        </span>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <div class="sidebar-actions">
                            <button type="submit" class="btn-apply">Aplicar Filtros</button>
                            <a href="{{ route('caregiver.showReviews') }}" class="btn-clear">Limpar Filtros</a>
                        </div>
                    </form>
                </div>

                <!-- LISTA -->
                <div class="reviews-list-container">
                    @if ($reviews->count() == 0)
                        <div class="empty-state">
                            <h3>Nenhuma avaliação encontrada</h3>
                            <p>Tente ajustar os filtros ou limpar a busca.</p>
                            <a href="{{ route('caregiver.showReviews') }}" class="btn-clear">
                                Limpar filtros
                            </a>
                        </div>
                    @else
                        @foreach ($reviews as $review)
                            <div class="review-user">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <div class="reviewer-avatar">
                                            @if ($review->client->user->foto == null)
                                                <i class="fa-solid fa-user"></i>
                                            @else
                                                <img src="{{ asset('storage/users/' . $review->client->user->foto) }}"
                                                    alt="{{ $review->client->user->nome }}">
                                            @endif
                                        </div>

                                        <div class="reviewer-details">
                                            <h4>{{ $review->client->user->nome }}</h4>
                                            <span class="review-date">
                                                {{ $review->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="review-stars">
                                        <div class="rating-stars">
                                            <span>{{ number_format($review->rating, 1) }}</span>
                                            <sub class="text-muted">/5</sub>
                                        </div>
                                        <div class="">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star filled"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <div class="review-comment">
                                    @if (!empty($review->comment))
                                        <p>{{ $review->comment }}</p>
                                    @else
                                        <span class="text-muted">Nenhum comentário fornecido.</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <!-- PAGINAÇÃO -->
                        <div class="pagination-container">
                            {{ $reviews->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>

@include('components.footer')

<script>
    function toggleSection(id) {
        const section = document.getElementById(id);
        if (!section) return;

        section.classList.toggle('active');

        const icon = section.previousElementSibling.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }
    }

    function toggleSection(id) {
        const section = document.getElementById(id);
        if (!section) return;

        section.classList.toggle('active');

        const icon = section.previousElementSibling.querySelector('i');
        if (icon) {
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }
    }
</script>
