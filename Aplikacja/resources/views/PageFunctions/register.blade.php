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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" maxlength="20" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="surname" class="form-label">Nazwisko</label>
                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" maxlength="25" value="{{ old('surname') }}">
                    @error('surname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" maxlength="40" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Numer telefonu</label>
                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" maxlength="20" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" maxlength="30" value="{{ old('login') }}">
                    @error('login')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" maxlength="100" >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="commitPassword" class="form-label">Potwierdź hasło</label>
                    <input type="password" class="form-control @error('commitPassword') is-invalid @enderror" id="commitPassword" name="commitPassword" maxlength="100">
                    @error('commitPassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Załóż konto</button>
                </div>
                <div class="col-md-6">
                    <a href="#" class="btn btn-danger">Anuluj</a>
                </div>
            </div>
        </form>
    </div>

    @include('PageElements.footer')
</body>

</html>
