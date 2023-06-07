@extends('layout')
@if (auth()->user()->role_id != '3')
    @section('content')
        <div class="container-fluid">
            <form method="GET" action="{{ route('charts') }}">
                <label for="year" class="p-2 bg-dark text-light text-bold rounded-3">En :</label>
                <select name="year" id="year" class="p-1 rounded-3" onchange="this.form.submit()">
                    @foreach ($data['years'] as $year)
                        <option value="{{ $year }}" @if ($year == $data['selectedYear']) selected @endif>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
                <noscript><input type="submit" value="Submit"></noscript>
            </form>
            <a href="{{ route('generate.financialRepport') }}" class="btn  " style="background-color: #F9F9F9;">Obtenir le
                rapport financier</a>
            <div class="bg-gradient-success mb-5 rounded">
                <div class="row p-5 pb-0">
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">nombre de recettes</h5>
                                        <p class="card-text">{{ $data['counts']['numberOfRecettes'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-chart-line text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">nombre de Dépenses</h5>
                                        <p class="card-text">{{ $data['counts']['numberOfDepenses'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-money-bill-wave text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">nombre de Documents</h5>
                                        <p class="card-text">{{ $data['counts']['numberOfDocuments'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-file-alt text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">nombre des adhérents</h5>
                                        <p class="card-text">{{ $data['counts']['numberOfAdherents'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-users text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-5 pt-1">
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">Crédits complets</h5>
                                        <p class="card-text">{{ $data['counts']['completeCredits'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-file-alt text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">nombre de remboursements</h5>
                                        <p class="card-text">{{ $data['counts']['numberOfRembourssements'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-money-bill text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">Crédits incomplets</h5>
                                        <p class="card-text">{{ $data['counts']['incompleteCredits'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-user-times text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-5 pt-1">
                    <div class="col mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">Revenu total en {{ $data['selectedYear'] }}</h5>
                                        <p class="card-text">{{ $data['total']['totalRevenue'] }} DH</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-money-bill-alt text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card h-100">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">Total des dépenses en {{ $data['selectedYear'] }}</h5>
                                        <p class="card-text">{{ $data['total']['totalExpenses'] }} DH</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-money-bill-wave-alt text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row p-5">
            <div class="col mb-3">
                <div class="card h-100
                    @if ($data['counts']['caisseSolde'] < 0) animate__animated animate__headShake animate__infinite text-light
                    @else
                        bg-light @endif
                "
                    @if ($data['counts']['caisseSolde'] < 0) style="background-color: #d57676" @endif>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title">Solde dans la caisse</h5>
                                @if ($data['counts']['caisseSolde'] < 0)
                                    <p class="card-text text-warning">{{ $data['counts']['caisseSolde'] }}DH</p>
                                @else
                                    <p class="card-text">{{ $data['counts']['caisseSolde'] }}DH</p>
                                @endif
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                    <i class="fa fa-money text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-3">
                <div class="card h-100
                @if ($data['counts']['banqueSolde'] < 0) animate__animated animate__headShake animate__infinite text-light
                @else
                    bg-light @endif
                "
                    @if ($data['counts']['banqueSolde'] < 0) style="background-color: #d57676" @endif>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title">Solde dans la Banque</h5>
                                @if ($data['counts']['banqueSolde'] < 0)
                                    <p class="card-text text-warning">{{ $data['counts']['banqueSolde'] }}DH</p>
                                @else
                                    <p class="card-text text-success">{{ $data['counts']['banqueSolde'] }}DH</p>
                                @endif
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                    <i class="fa fa-university text-lg opacity-10 text-light" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5> Recette par rubrique</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="recette-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5> Dépenses par rubrique</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="depense-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Évolution des dépenses et des revenus mensuels en {{ $year }}</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Adhérents par catégorie</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="adherents-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>




        <style>
            .card {
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .card-title {
                color: #333;
                font-size: 1.2rem;
                font-weight: bold;
            }

            .card-text {
                color: #198754;
                font-size: 2rem;
                font-weight: bold;
            }
        </style>
    @endsection
@else
    @section('content')
        <div class="container-fluid">
            <form method="GET" action="{{ route('charts') }}">
                <label for="year" class="p-2 bg-dark text-light text-bold rounded-3">En :</label>
                <select name="year" id="year" class="p-1 rounded-3" onchange="this.form.submit()">
                    @foreach ($data['years'] as $year)
                        <option value="{{ $year }}" @if ($year == $data['selectedYear']) selected @endif>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
                <noscript><input type="submit" value="Submit"></noscript>
            </form>
            <div class="bg-gradient-success mb-5 rounded">
                <div class="row p-5 pb-0">
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 ">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="card-title">nombre des documents</h5>
                                        <p class="card-text">{{ $data['counts']['numberOfDocuments'] }}</p>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                            <i class="fas fa-file-alt text-lg opacity-10"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
@endif
@push('script')
    <script>
        var recetteData = {!! json_encode($data['recetteRubrique']) !!};
        var depenseData = {!! json_encode($data['depenseRubrique']) !!};

        var recetteLabels = [];
        var recetteAmounts = [];
        var recetteColors = [];

        recetteData.forEach(function(item) {
            recetteLabels.push(item.label);
            recetteAmounts.push(item.amount);
            var newColor = generateRandomColor();
            while (checkColorSimilarity(newColor, recetteColors)) {
                newColor = generateRandomColor();
            }
            recetteColors.push(newColor);
        });

        var depenseLabels = [];
        var depenseAmounts = [];
        var depenseColors = [];

        depenseData.forEach(function(item) {
            depenseLabels.push(item.label);
            depenseAmounts.push(item.amount);
            var newColor = generateRandomColor();
            while (checkColorSimilarity(newColor, depenseColors)) {
                newColor = generateRandomColor();
            }
            depenseColors.push(newColor);
        });

        function generateRandomColor() {
            return 'rgb(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math
                .random() * 256) + ')';
        }

        function checkColorSimilarity(newColor, colors) {
            for (var i = 0; i < colors.length; i++) {
                var color = colors[i];
                var distance = Math.sqrt(
                    Math.pow(newColor[0] - color[0], 2) +
                    Math.pow(newColor[1] - color[1], 2) +
                    Math.pow(newColor[2] - color[2], 2)
                );
                if (distance < 70) {
                    return true;
                }
            }
            return false;
        }

        var recetteCtx = document.getElementById('recette-chart').getContext('2d');
        var recetteChart = new Chart(recetteCtx, {
            type: 'pie',
            data: {
                labels: recetteLabels,
                datasets: [{
                    data: recetteAmounts,
                    backgroundColor: recetteColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        var depenseCtx = document.getElementById('depense-chart').getContext('2d');
        var depenseChart = new Chart(depenseCtx, {
            type: 'pie',
            data: {
                labels: depenseLabels,
                datasets: [{
                    data: depenseAmounts,
                    backgroundColor: depenseColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var data = {
                labels: {!! json_encode($data['categories']->keys()) !!},
                datasets: [{
                    data: {!! json_encode($data['categories']->values()) !!},
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#FFEE11',
                        '#FFC456',
                        // Add more colors as needed
                    ],
                }],
            };

            var ctx = document.getElementById('adherents-chart').getContext('2d');
            new Chart(ctx, {
                type: 'pie', // or 'bar' for a bar chart
                data: data,
            });
        });
        // Obtenez les données mensuelles à partir de la variable PHP passée à la vue
        const donnéesMensuelles = {!! json_encode($data['monthlyData']) !!};

        // Préparez les étiquettes pour l'axe des X (mois)
        const mois = Object.keys(donnéesMensuelles);

        // Préparez les ensembles de données pour les dépenses totales et les revenus totaux
        const donnéesDépenses = mois.map(mois => donnéesMensuelles[mois].totalExpenses);
        const donnéesRevenus = mois.map(mois => donnéesMensuelles[mois].totalRevenue);

        // Créez le graphique linéaire
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: mois,
                datasets: [{
                        label: 'Dépenses totales',
                        data: donnéesDépenses,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Revenus totaux',
                        data: donnéesRevenus,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 500 // Ajustez la taille du pas pour les graduations de l'axe Y selon vos besoins
                        }
                    }
                }
            }
        });
    </script>
@endpush
