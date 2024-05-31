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
                    <input type="text" class="form-control" id="name" name="name" maxlength="50"
                        value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="typeSelect" class="form-label">Typ oferty</label>
                    <select class="form-select" id="typeSelect" name="type" required>
                        <option value="sprzedam" {{ old('type') == 'sprzedam' ? 'selected' : '' }}>Sprzedam</option>
                        <option value="kupie" {{ old('type') == 'kupie' ? 'selected' : '' }}>Kupię</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="description" class="form-label">Opis</label>
                    <textarea class="form-control" id="description" name="description" maxlength="200" rows="3"
                        value="{{ old('description') }}"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="price" class="form-label">Cena</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" max="999999999"
                        value="{{ old('price') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="negotiation" class="form-label">Negocjacja</label>
                    <label for="negotiaionSelect" class="form-label">Do negocjacji</label>
                    <select class="form-select" id="negotiaionSelect" name="negotiation" required>
                        <option value="1" {{ old('negotiation') == '1' ? 'selected' : '' }}>Tak</option>
                        <option value="0" {{ old('negotiation') == '0' ? 'selected' : '' }}>Nie</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="tags" class="form-label">Tagi</label>
                    <input type="text" class="form-control" id="tags" name="tags" maxlength="100" value="{{ old('tags') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="fileInput">Wybierz zdjęcia (.jpg, .png)</label>
                <input type="file" class="form-control-file" id="fileInput" name="photos[]" accept=".jpg,.png"
                    multiple>
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
