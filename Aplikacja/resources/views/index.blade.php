<!doctype html>
<html lang="pl" data-bs-theme="">

@include('PageElements.head')

<body>
    @include('PageElements.navbar')

    <div class="container-fluid p-5 bg-light">
        <div class="row p-4">
            <div class="col-12 text-center">
                <h1>O nas!</h1>
            </div>
        </div>
        <div class="row p-4">
            <div class="col-12 text-justify">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In lobortis augue non risus eleifend
                    molestie.
                    Morbi imperdiet quam eros, a finibus est sagittis ut. Duis pulvinar velit tristique orci convallis
                    ultrices.
                    Praesent sed sem malesuada, vestibulum risus non, fermentum tellus. Orci varius natoque penatibus et
                    magnis
                    dis parturient montes, nascetur ridiculus mus. Vivamus nec diam at purus feugiat rhoncus. Aenean
                    lobortis
                    lorem et ornare varius. Fusce nec finibus tortor. Nullam sodales, elit tincidunt bibendum cursus,
                    velit dolor
                    volutpat augue, sit amet efficitur dolor enim quis massa. Proin finibus consequat aliquet. Nulla
                    facilisi.
                </p>

                <p>Vivamus vestibulum viverra risus at efficitur. Vivamus vehicula felis vel pellentesque hendrerit.
                    Etiam lorem
                    lacus, pellentesque sit amet ultrices egestas, finibus non turpis. Aliquam sit amet ligula nibh.
                    Nulla
                    lobortis tempor ipsum, nec luctus augue ultricies in. Cras viverra laoreet lacinia. Vestibulum
                    tristique
                    scelerisque leo quis rutrum. Maecenas gravida eros massa, ut varius nunc porta in.</p>
            </div>
        </div>
    </div>

    <div id="wycieczki" class="container-fluid bg-info p-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="text-light">Znajdź to czego potrzebujesz!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form class="d-flex" role="search" action="{{ route('offersSearch') }}" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Szukaj ogłoszeń"
                        aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Wyszukaj</button>
                </form>
            </div>
            <div class="col-md-3">
            </div>

        </div>
    </div>

    <div class="container-fluid bg-secondary p-5">
        <div class="row p-4">
            <div class="col-12 text-center">
                <h1 class="text-light">Proponowane ogłoszenia</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @forelse ($offers as $off)
                    <div class="col-12 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="row no-gutters">
                                <img src="{{ asset('storage/' . $off->photo->first()->file) }}" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="row no-gutters">
                                <div class="card-body">
                                    <h5 class="card-title" style="height: 40px;">{{ $off->name }}</h5>
                                    <p class="card-text" style="height: 80px;">{{ $off->description }}</p>
                                    <p class="card-text" style="height: 40px;">{{ $off->tags }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <b>Typ: </b> {{ $off->type }}<br>
                                    <b>Cena: </b> {{ $off->price }}<br>
                                    <b>Do negocjacji: </b> {{ $off->negotiation ? 'tak' : 'nie' }}<br>
                                    <b>Status: </b> {{ $off->status }}
                                    <div class="mt-2">
                                        <a href="{{ route('offerShowWithPhotos', $off->id) }}"
                                            class="btn btn-primary">Szczegóły</a>
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
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row p-4">
            <div class="col-md-3">

            </div>
            <div class="col-md-6 text-center">
                <form action="{{ route('showMoreOffers') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pokaż więcej ofert</button>
                </form>
            </div>
            <div class="col-md-3">

            </div>
        </div>

    </div>

    @include('PageElements.footer')
</body>

</html>
