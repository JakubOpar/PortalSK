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
                                <input type="text" id="login" name="login" value="{{ Auth::user()->login }}" readonly>
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
                                <input type="tel" id="phone" name="phone_number" value="{{ Auth::user()->phone_number }}">
                            </div>
                            <div class="row p-2 mt-2">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Edytuj</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('profile', Auth::user()->id ) }}" class="btn btn-danger">Anuluj</a>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4 mt-4">
                            <img src="img/colorado.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Kolorado</h5>
                                <p class="card-text">jest wyżynno-górzystym stanem, którego średnia wysokość nad
                                    poziomem
                                    morza przekracza 2000 m. Najwyższy szczyt Kolorado, Mount Elbert, wznosi się na 4399
                                    m
                                    n.p.m. </p>
                                <a href="#" class="btn btn-primary">Więcej szczegółów...</a>
                            </div>
                        </div>

                        <div class="card mb-4 mt-4">
                            <img src="img/colorado.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Kolorado</h5>
                                <p class="card-text">jest wyżynno-górzystym stanem, którego średnia wysokość nad
                                    poziomem
                                    morza przekracza 2000 m. Najwyższy szczyt Kolorado, Mount Elbert, wznosi się na 4399
                                    m
                                    n.p.m. </p>
                                <a href="#" class="btn btn-primary">Więcej szczegółów...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('PageElements.footer')
</body>

</html>
