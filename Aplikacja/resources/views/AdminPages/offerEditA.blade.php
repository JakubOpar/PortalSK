<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column">
        <h2 class="mt-5">Edytuj ofertę</h2>
        <form id="editOfferForm" class="mt-4" action="{{ route('offerUpdate', $offer->id) }}" method="POST">
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
                    <input type="text" class="form-control" id="id" name="id" value="{{ $offer->id }}"
                        readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nazwa</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="50"
                        value="{{ $offer->name }}">
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Typ</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="sprzedam" {{ $offer->type == 'sprzedam' ? 'selected' : '' }}>Sprzedaż</option>
                        <option value="kupie" {{ $offer->type == 'kupie' ? 'selected' : '' }}>Kupno</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="description" class="form-label">Opis</label>
                    <textarea class="form-control" id="description" name="description" maxlength="200" rows="3">{{ $offer->description }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="price" class="form-label">Cena</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" max="999999999"
                        value="{{ $offer->price }}" required>
                </div>
                <div class="col-md-6">
                    <label for="negotiation" class="form-label">Negocjacja</label>
                    <select class="form-select" id="negotiation" name="negotiation" required>
                        <option value="1" {{ $offer->negotiation ? 'selected' : '' }}>Tak</option>
                        <option value="0" {{ !$offer->negotiation ? 'selected' : '' }}>Nie</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="publication_date" class="form-label">Data publikacji</label>
                    <input type="date" class="form-control" id="publication_date" name="publication_date"
                        value="{{ $offer->publication_date }}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="statusSelect" name="status" required>
                        <option value="aktualna" {{ $offer->status == 'aktualna' ? 'selected' : '' }}>aktualna</option>
                        <option value="zarezerwowana" {{ $offer->status == 'zarezerwowana' ? 'selected' : '' }}>
                            zarezerwowana</option>
                            <option value="zakończona" {{ $offer->status == 'zakończona' ? 'selected' : '' }}>zakończona</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="tags" class="form-label">Tagi</label>
                    <input type="text" class="form-control" id="tags" name="tags" maxlength="100"
                        value="{{ $offer->tags }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="user_id" class="form-label">ID użytkownika</label>
                    <input type="number" class="form-control" id="user_id" name="user_id"
                        value="{{ $offer->user_id }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('offerIndex') }}" class="btn btn-danger">Anuluj</a>
                </div>
            </div>
        </form>
    </div>

    @include('PageElements.footer')
</body>

</html>
