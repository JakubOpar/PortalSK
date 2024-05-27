<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12 text-center">
                <h2 class="text-center mb-4">Wystąpił błąd 500</h2>
                <h3 class="text-center mb-4">Błąd wewnętrzny serwera</h3>
                <img src="{{ asset('storage/error.png') }}" alt="error" class="img-fluid">
            </div>
        </div>
    </div>

    @include('PageElements.footer')
</body>

</html>
