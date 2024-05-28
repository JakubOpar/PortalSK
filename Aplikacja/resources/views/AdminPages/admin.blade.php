<!doctype html>
<html lang="pl" data-bs-theme="">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column mt-4 mb-5">
        <h2 class="mb-4">Statystyki:</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba ofert:</h5>
                        <p class="card-text"> {{$offerCount}} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba użytkowników: </h5>
                        <p class="card-text"> {{$userCount}} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ofert na dzień:</h5>
                        <p class="card-text"> {{$offersPerDay}} </p>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row mb-4">
                    <h2 class="text-center">Zarządzaj:</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <div class="row mb-4">
                            <a href="{{ route('userIndex')  }}" class="btn btn-primary">Użytkowmicy</a>
                        </div>
                        <div class="row mb-4">
                            <a href="{{  route('offerIndex') }}" class="btn btn-primary">Oferty</a>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>


        </div>
    </div>


    @include('PageElements.footer')

</body>

</html>
