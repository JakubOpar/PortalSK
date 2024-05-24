<!doctype html>
<html lang="pl">
@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-md-6 bg-secondary text-white d-flex flex-column">
                <div class="row p-2">
                    <h2>Informacje:</h2>
                </div>
                <div class="row p-2">
                    <span>Login: {{ Auth::user()->login }} </span>
                </div>
                <div class="row p-2">
                    <span>Imię: {{ Auth::user()->name }} </span>
                </div>
                <div class="row p-2">
                    <span>Nazwisko: {{ Auth::user()->surname }} </span>
                </div>
                <div class="row p-2">
                    <span>Email: {{ Auth::user()->email }} </span>
                </div>
                <div class="row p-2">
                    <span>Numer telefonu: {{ Auth::user()->phone_number }} </span>
                </div>
                <div class="row p-2 mt-2">
                    <div class="col-md-2">
                       <a href="{{ route('profileEdit', Auth::user()->id) }}" class="btn btn-primary">Edytuj</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-white d-flex flex-column">
                <div class="row p-2 bg-primary">
                    <h2 class="text-center">Moje oferty:</h2>
                </div>
                <div class="row p-2">
                    @forelse ($offers as $off)
                        <div class="col-12 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="row no-gutters">
                                    <img src="{{ asset('storage/test.png') }}" alt="...">
                                </div>
                                <div class="row no-gutters">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $off->name }}</h5>
                                        <p class="card-text" style="height: 80px;">{{ $off->description }}</p>
                                        <p class="card-text" style="height: 40px;">{{ $off->tags }}</p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0">
                                        <b>Typ: </b> {{ $off->type }}<br>
                                        <b>Cena: </b> {{ $off->price }}<br>
                                        <b>Do negocjacji: </b> {{ $off->negotiation ? 'tak' : 'nie' }}
                                        <div class="mt-2">
                                            <a href="#" class="btn btn-primary">Szczegóły</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <h2 class="text-center">W tej chwili brak ofert.</h2>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid bg-dark">
        <div class="row text-center pt-2">
            <p class="text-white">&copy; Sprzedam.pl &ndash; 2024</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>
