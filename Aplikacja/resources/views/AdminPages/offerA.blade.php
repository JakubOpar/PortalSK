<!doctype html>
<html lang="pl" data-bs-theme="">

@include('PageElements.head')

<body>
    @include('PageElements.navbar')

    <div class="container-fluid p-4">
        <h2 class="mt-4">Oferty</h2>
        <form method="POST" action="{{ route('offerStore') }}">
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
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputName">Nazwa oferty:</label>
                        <input type="text" class="form-control" id="inputName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="inputPrice">Cena</label>
                        <input type="text" class="form-control" id="inputPrice" name="price">
                    </div>
                    <div class="form-group">
                        <label for="typeSelect" class="form-label">Typ oferty</label>
                        <select class="form-select" id="typeSelect" name="type" >
                            <option value="sprzedam" selected>Sprzedam</option>
                            <option value="kupie">Kupię</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="negotiaionSelect" class="form-label">Do negocjacji</label>
                        <select class="form-select" id="negotiaionSelect" name="negotiation" >
                            <option value="1" selected>Tak</option>
                            <option value="0">Nie</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputPublicationDate">Data wystawienia</label>
                        <input type="date" class="form-control" id="inputPublicationDate" name="publication_date">
                    </div>
                    <div class="form-group">
                        <label for="statusSelect" class="form-label">Status</label>
                        <select class="form-select" id="statusSelect" name="status" >
                            <option value="aktualna" selected>aktualna</option>
                            <option value="zarezerwowana">zarezerwowana</option>
                            <option value="zakończona">zakończona</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputUserId">Id użytkownika</label>
                        <input type="number" class="form-control" id="inputUserId" name="user_id">
                    </div>
                    <div class="form-group">
                        <label for="inputTags">Tagi</label>
                        <input type="text" class="form-control" id="inputTags" name="tags">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputDescription">Opis:</label>
                        <textarea class="form-control" id="inputDescription" rows="20" name="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container-fluid p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Opis</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Negocjacja</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tagi</th>
                        <th scope="col">Id_użytkownika</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $off)
                        <tr>
                            <th scope="row">{{ $off->id }}</th>
                            <td>{{ $off->name }}</td>
                            <td>{{ $off->description }}</td>
                            <td>{{ $off->price }}</td>
                            <td>{{ $off->negotiation ? 'tak' : 'nie' }}</td>
                            <td>{{ $off->type }}</td>
                            <td>{{ $off->status }}</td>
                            <td>{{ $off->tags }}</td>
                            <td>{{ $off->user_id }}</td>
                            <td><a href="{{ route('offerShow', $off->id) }}">Edytuj</a></td>
                            <td>
                                <form action="{{ route('offerDelete', $off->id) }}" method="POST">
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
