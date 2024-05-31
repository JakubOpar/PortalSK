<!doctype html>
<html lang="pl" data-bs-theme="">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')


    <div class="container mb-4 mt-4">
        <h2 class="mb-4">Użytkownicy</h2>
        <form method="POST" action="{{ route('userStore') }}">
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
            <div class="row">
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Imię"
                        value="{{ old('name') }}" required maxlength="20" pattern="^[A-Za-z]+$">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Nazwisko"
                        value="{{ old('surname') }}" required maxlength="25" pattern="^[A-Za-z]+$">
                </div>
                <div class="form-group col-md-2">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email"
                        value="{{ old('email') }}" required maxlength="40"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                        title="Email musi być w formacie name@email.com">
                </div>
                <div class="form-group col-md-2">
                    <input type="tel" class="form-control" id="inputPhoneNumber" name="phone_number"
                        placeholder="Numer Telefonu" value="{{ old('phone_number') }}" required pattern="^[0-9]{9}$"
                        title="Numer telefonu musi mieć dokładnie 9 cyfr">
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="inputLogin" name="login" placeholder="Login"
                        value="{{ old('login') }}" required maxlength="30">
                </div>
                <div class="form-group col-md-1">
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Hasło"
                        required maxlength="100">
                </div>
                <div class="form-group col-md-2">
                    <select class="form-select" id="inputPermission" name="permission" required>
                        <option value="1" {{ old('permission') == '1' ? 'selected' : '' }}>1 - Admin</option>
                        <option value="2" {{ old('permission') == '2' ? 'selected' : '' }}>2 - Użytkownik</option>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>

    </div>

    <div class="container d-flex flex-column flex-grow-1">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Naziwsko</th>
                        <th scope="col">Email</th>
                        <th scope="col">Numer telefonu</th>
                        <th scope="col">Login</th>
                        <th scope="col">P. uprawnień</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $us)
                        <tr>
                            <th scope="row">{{ $us->id }}</th>
                            <td>{{ $us->name }}</td>
                            <td>{{ $us->surname }}</td>
                            <td>{{ $us->email }}</td>
                            <td>{{ $us->phone_number }}</td>
                            <td>{{ $us->login }}</td>
                            <td>{{ $us->permission }}</td>
                            <td><a href="{{ route('userShow', $us->id) }}">Edytuj</a></td>
                            <td>
                                <form action="{{ route('userDelete', $us->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="8">Brak danych.</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('PageElements.footer')

</body>

</html>
