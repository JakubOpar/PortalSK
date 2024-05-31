<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column">
        <h2 class="mt-5">Zarejestruj się</h2>
        <form id="editUserForm" class="mt-4" action="{{ route('userRegister') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Imię</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                        required maxlength="20" pattern="^[A-Za-z]+$">
                </div>
                <div class="col-md-6">
                    <label for="surname" class="form-label">Nazwisko</label>
                    <input type="text" class="form-control" id="surname" name="surname"
                        value="{{ old('surname') }}" required maxlength="25" pattern="^[A-Za-z]+$">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required maxlength="40" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Numer telefonu</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number"
                        value="{{ old('phone_number') }}" required pattern="^[0-9]{9}$"
                        title="Numer telefonu musi mieć dokładnie 9 cyfr">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}"
                        required maxlength="30">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="password" name="password" required maxlength="100">
                </div>
                <div class="col-md-6">
                    <label for="commitPassword" class="form-label">Potwierdź hasło</label>
                    <input type="password" class="form-control" id="commitPassword" name="commitPassword" required
                        maxlength="100">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Załóż konto</button>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('mainPage') }}" class="btn btn-danger">Anuluj</a>
                </div>
            </div>
        </form>

    </div>

    @include('PageElements.footer')
</body>

</html>
