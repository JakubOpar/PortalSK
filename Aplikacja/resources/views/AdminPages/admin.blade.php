<!doctype html>
<html lang="pl" data-bs-theme="">

@include('PageElements.head')

<body class="d-flex flex-column min-vh-100">
    @include('PageElements.navbar')

    <div class="container flex-grow-1 d-flex flex-column mt-4 mb-5">
        <h2 class="mb-4">Statystyki:</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba ofert:</h5>
                        <p class="card-text"> {{ $offerCount }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Liczba użytkowników: </h5>
                        <p class="card-text"> {{ $userCount }} </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ofert na dzień:</h5>
                        <p class="card-text"> {{ $offersPerDay }} </p>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <h2 class="text-center">Wykres ilości ofert na dany dzień</h2>
                <canvas id="offersChart" width="400" height="200"></canvas>
            </div>

            <div class="container mt-5">
                <div class="row mb-4">
                    <h2 class="text-center">Zarządzaj:</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <div class="row mb-4">
                            <a href="{{ route('userIndex') }}" class="btn btn-primary">Użytkowmicy</a>
                        </div>
                        <div class="row mb-4">
                            <a href="{{ route('offerIndex') }}" class="btn btn-primary">Oferty</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('offersChart').getContext('2d');
            var offersData = @json($offersPerDayChart);

            var labels = Object.keys(offersData);
            var data = Object.values(offersData);

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Oferty na dzień',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    @include('PageElements.footer')
</body>
</html>
