<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-md-6 bg-secondary text-white d-flex flex-column">
                <div class="row p-2">
                    <h2>Edytuj dane:</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('profileUpdate', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row p-2">
                                <label for="login">Login:</label>
                                <input type="text" id="login" name="login" value="{{ Auth::user()->login }}"
                                    readonly required maxlength="30">
                            </div>
                            <div class="row p-2">
                                <label for="name">Imię:</label>
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                                    required maxlength="20">
                            </div>
                            <div class="row p-2">
                                <label for="surname">Nazwisko:</label>
                                <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}"
                                    required maxlength="25">
                            </div>
                            <div class="row p-2">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                                    required maxlength="40" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                    title="Email musi być w formacie name@email.com">
                            </div>
                            <div class="row p-2">
                                <label for="phone">Numer telefonu:</label>
                                <input type="tel" id="phone" name="phone_number"
                                    value="{{ Auth::user()->phone_number }}" required minlength="9" maxlength="9"
                                    pattern="^[0-9]{9}$" title="Numer telefonu musi mieć dokładnie 9 cyfr">
                            </div>
                            <div class="row p-2 mt-2">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Edytuj</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('profile', Auth::user()->id) }}" class="btn btn-danger">Anuluj</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-white d-flex flex-column">
                <div class="row p-2 bg-primary">
                    <h2 class="text-center">Moje oferty:</h2>
                </div>
                <div class="row p-2">
                    <div class="row p-2">
                        @forelse ($offers as $off)
                            <div class="col-12 col-md-6 col-lg-6 mb-4 d-flex align-items-stretch">
                                <div class="card w-100">
                                    <div class="row no-gutters">
                                        @if ($off->photo->first())
                                            <img src="{{ asset('storage/photos/' . $off->photo->first()->file) }}" class="img-fluid"
                                                alt="...">
                                        @else
                                            <img src="{{ asset('storage/default.png') }}" alt="Default Image">
                                        @endif
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
                                            <b>Do negocjacji: </b> {{ $off->negotiation ? 'tak' : 'nie' }}<br>
                                            <b>Status: </b>
                                            <b
                                                class="{{ $off->status === 'aktualna' ? 'text-success' : ($off->status === 'zarezerwowana' ? 'text-warning' : ($off->status === 'zakończona' ? 'text-danger' : '')) }}">
                                                {{ $off->status }}
                                            </b>
                                            <div class="mt-2 d-flex justify-content-around">
                                                <a href="{{ route('offerEditWithPhotos', $off->id) }}"
                                                    class="btn btn-primary">Edytuj</a>
                                                <form action="{{ route('userOfferDelete', $off->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <h2 class="text-center">Brak ofert.</h2>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>


    @include('PageElements.footer')
</body>

</html>
