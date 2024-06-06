<nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sprzedam.pl</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mainPage') }}">Strona główna</a>
                </li>
                @can('access-admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Zarządzaj</a>
                    </li>
                @endcan
                @can('is-logged-in')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showCreateOffer') }}">Dodaj ofertę</a>
                    </li>
                @endcan
            </ul>
            <div class="d-flex flex-column flex-lg-row align-items-start">
                @if (Auth::check())
                    <a href="{{ route('profile', ['id' => Auth::user()->id]) }}"
                        class="btn btn-outline-light w-auto me-lg-2 mb-2 mb-lg-0"><img
                            src="{{ asset('storage/user.png') }}" alt=""> {{ Auth::user()->login }}</a>
                    <a href="{{ route('logout') }}" class="btn btn-outline-light w-auto"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Wyloguj
                        się</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('register') }}"
                        class="btn btn-outline-light w-auto me-lg-2 mb-2 mb-lg-0">Zarejestruj się</a>
                    <a href="{{ route('loginPage') }}" class="btn btn-outline-light w-auto">Zaloguj się</a>
                @endif
            </div>
        </div>
    </div>
</nav>
