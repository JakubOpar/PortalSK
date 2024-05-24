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
                            <div class="row p-2">
                                <label for="login">Login:</label>
                                <input type="text" id="login" name="login" value="{{ Auth::user()->login }}"
                                    readonly>
                            </div>
                            <div class="row p-2">
                                <label for="name">Imię:</label>
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="row p-2">
                                <label for="surname">Nazwisko:</label>
                                <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}">
                            </div>
                            <div class="row p-2">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="row p-2">
                                <label for="phone">Numer telefonu:</label>
                                <input type="tel" id="phone" name="phone_number"
                                    value="{{ Auth::user()->phone_number }}">
                            </div>
                            <div class="row p-2 mt-2">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Edytuj</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('profile', Auth::user()->id) }}"
                                        class="btn btn-danger">Anuluj</a>
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
                    <div class="col-md-12">
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
    </div>


    @include('PageElements.footer')
</body>

</html>
