<!doctype html>
<html lang="pl">
@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-md-6 bg-secondary text-white d-flex flex-column">
                <form action="{{ route('updateByUser', $offer->id) }}" method="POST" class="p-2">
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
                    <div class="mb-3">
                        <label for="name" class="form-label">Nazwa:</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $offer->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Opis:</label>
                        <textarea id="description" name="description" class="form-control" rows="5">{{ $offer->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Cena:</label>
                        <input type="text" id="price" name="price" class="form-control"
                            value="{{ $offer->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="negotiation" class="form-label">Do negocjacji:</label>
                        <select id="negotiation" name="negotiation" class="form-control">
                            <option value="1" {{ $offer->negotiation ? 'selected' : '' }}>tak</option>
                            <option value="0" {{ !$offer->negotiation ? 'selected' : '' }}>nie</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Typ:</label>
                        <input type="text" id="type" name="type" class="form-control"
                            value="{{ $offer->type }}">
                    </div>
                    <div class="mb-3">
                        <label for="publication_date" class="form-label">Data publikacji:</label>
                        <input type="date" id="publication_date" name="publication_date" class="form-control"
                            value="{{ $offer->publication_date }}">
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tagi:</label>
                        <input type="text" id="tags" name="tags" class="form-control"
                            value="{{ $offer->tags }}">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="statusSelect" name="status">
                            <option value="aktualna" {{ $offer->status == 'aktualna' ? 'selected' : '' }}>aktualna</option>
                            <option value="zarezerwowana" {{ $offer->status == 'zarezerwowana' ? 'selected' : '' }}>
                                zarezerwowana</option>
                                <option value="zakończona" {{ $offer->status == 'zakończona' ? 'selected' : '' }}>zakończona</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                </form>
            </div>
            <div class="col-md-6 bg-white d-flex flex-column">
                <div class="row p-2 bg-primary">
                    <h2 class="text-center">Moje oferty:</h2>
                </div>
                <div class="row p-2">
                    @if ($photos->isNotEmpty())
                        <div class="col-12 mb-4">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Obraz</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($photos as $photo)
                                        <tr>
                                            <td class="align-middle">
                                                <img src="{{ asset('storage/' . $photo->file) }}" alt=""
                                                    class="img-fluid">
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Usuń</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-12">
                            <h2 class="text-center">Brak zdjęć.</h2>
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>

    <footer class="container-fluid bg-dark">
        <div class="row text-center pt-2">
            <p class="text-white">&copy; Sprzedam.pl &ndash; 2024</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
