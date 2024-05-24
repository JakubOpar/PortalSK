<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Logowanie</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1">Login</label>
                        <input type="text" class="form-control" id="inputLogin" name="login">
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputPassword1">Hasło</label>
                        <input type="password" class="form-control" id="InputPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
                </form>
            </div>
        </div>
    </div>

    @include('PageElements.footer')
</body>

</html>
