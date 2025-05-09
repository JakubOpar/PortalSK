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
                    <span><b>Nazwa:</b> {{ $offer->name }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Opis:</b> {{ $offer->description }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Cena:</b> {{ $offer->price }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Do negocjacji:</b> {{ $offer->negotiation ? 'tak' : 'nie' }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Typ:</b> {{ $offer->type }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Data publikacji:</b> {{ $offer->publication_date }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Tagi:</b> {{ $offer->tags }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Status:</b> {{ $offer->status }} </span>
                </div>
                <div class="row p-2">
                    <span><b>Dodał:</b> {{ $offer->user->login }} </span>
                </div>
            </div>
            <div class="col-md-6 bg-white d-flex flex-column">
                <div class="row p-2 bg-primary">
                    <h2 class="text-center">Zdjęcia:</h2>
                </div>
                <div class="row p-2">
                    @forelse ($photos as $photo)
                        <div class="col-12 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                            <img src="{{ asset('storage/photos/' . $photo->file) }}" alt=""
                                class="img-fluid d-block mx-auto">
                        </div>
                    @empty
                        <div class="col-12">
                            <h2 class="text-center">Brak zdjęć.</h2>
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
