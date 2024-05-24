<!doctype html>
<html lang="pl" data-bs-theme="">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')


    <div class="container-fluid p-4">
        <h2 class="mb-4">Użytkownicy</h2>
        <form method="POST" action="{{ route('userStore') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Imię">
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Nazwisko">
                </div>
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" id="inputPhoneNumber" name="phone_number" placeholder="Numer Telefonu">
                    <!-- Poprawiono inputPhorneNumber na inputPhoneNumber -->
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="inputLogin" name="login" placeholder="Login">
                </div>
                <div class="form-group col-md-1">
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Hasło">
                </div>
                <div class="form-group col-md-2">
                    <input type="number" class="form-control" id="inputPermission" name="permission"  placeholder="Uprawnienia">
                </div>
                <div class="form-group col-md-1">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container-fluid p-4 d-flex flex-column flex-grow-1">
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
                        <th scope="col">Hasło</th>
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
                            <td>{{ $us->password }}</td>
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
