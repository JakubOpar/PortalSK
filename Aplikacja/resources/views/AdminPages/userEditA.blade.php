<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column">
        <h2 class="mt-5">Edytuj dane użytkownika</h2>
        <form id="editUserForm" class="mt-4" action="{{ route('userUpdate', $user->id) }}" method="POST">
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
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Imię</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="20" value="{{ $user->name }}" required>
                </div>
                <div class="col-md-6">
                    <label for="surname" class="form-label">Nazwisko</label>
                    <input type="text" class="form-control" id="surname" name="surname" maxlength="25" value="{{ $user->surname }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email"
                        value="{{ $user->email }}" required maxlength="40"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Email musi być w formacie name@email.com">
                </div>
                <div class="col-md-6">
                    <label for="phone_number" class="form-label">Numer telefonu</label>
                    <input type="tel" class="form-control" id="inputPhoneNumber" name="phone_number"
                        placeholder="Numer Telefonu" value="{{ $user->phone_number }}" required pattern="^[0-9]{9}$"
                        title="Numer telefonu musi mieć dokładnie 9 cyfr">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login" maxlength="30" value="{{ $user->login }}" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="password" name="password" maxlength="100">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="permission" class="form-label">Uprawnienia</label>
                    <select class="form-select" id="inputPermission" name="permission" required>
                        <option value="1" {{ $user->permission == '1' ? 'selected' : '' }}>1 - Admin</option>
                        <option value="2" {{ $user->permission == '2' ? 'selected' : '' }}>2 - Użytkownik</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('userIndex') }}" class="btn btn-danger">Anuluj</a>
                </div>
            </div>
        </form>
    </div>




    @include('PageElements.footer')
</body>

</html>
