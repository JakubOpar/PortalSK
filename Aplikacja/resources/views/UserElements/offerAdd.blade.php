<!doctype html>
<html lang="pl">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column mb-5">
        <h2 class="mt-5">Dodaj ofertę</h2>
        <form id="editOfferForm" class="mt-4" method="POST" action="{{ route('storeByUser') }}"
            enctype="multipart/form-data">
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
                    <label for="name" class="form-label">Nazwa</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="50">
                </div>
                <div class="col-md-6">
                    <label for="type" class="form-label">Typ</label>
                    <select class="form-select" id="type" name="type">
                        <option value="sprzedaz">Sprzedaż</option>
                        <option value="kupno">Kupno</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="description" class="form-label">Opis</label>
                    <textarea class="form-control" id="description" name="description" maxlength="200" rows="3"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="price" class="form-label">Cena</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01">
                </div>
                <div class="col-md-6">
                    <label for="negotiation" class="form-label">Negocjacja</label>
                    <select class="form-select" id="negotiation" name="negotiation">
                        <option value="1">Tak</option>
                        <option value="0">Nie</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="tags" class="form-label">Tagi</label>
                    <input type="text" class="form-control" id="tags" name="tags" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <label for="fileInput">Wybierz zdjęcia (.jpg )</label>
                <input type="file" class="form-control-file" id="fileInput" name="photos[]" accept=".jpg" multiple>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Dodaj ofertę</button>
                </div>
            </div>
        </form>
    </div>

    @include('PageElements.footer')
</body>

</html>
