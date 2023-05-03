@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="bg-gradient-success mb-5 rounded">
            <div class="row p-5 pb-0">
                <div class="col-md-3 mb-3">
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Number of Recettes</h5>
                                    <p class="card-text">{{ $data['counts']['numberOfRecettes'] }}</p>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                        <i class="fas fa-line-chart text-lg opacity-10"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Number of Depenses</h5>
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
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Number of Documents</h5>
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
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Number of Adherents</h5>
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
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Complete credits</h5>
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
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Number of Rembourssements</h5>
                                    <p class="card-text">{{ $data['counts']['numberOfRembourssements'] }}</p>
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
                <div class="col-md-3 mb-3">
                    <div class="card h-100 ">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title">Incomplete credits</h5>
                                    <p class="card-text">{{ $data['counts']['incompleteCredits'] }}</p>
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
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
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
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
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
                        Recette par rubrique
                    </div>
                    <div class="card-body">
                        <canvas id="recette-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Dépenses par rubrique
                    </div>
                    <div class="card-body">
                        <canvas id="depense-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Solde Chart</h5>
                        <canvas id="solde-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">

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

    @section('scripts')
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
        </script>


        <script>
            // Extract the years, caisse, and banque values from the data
            var solde = @json($data['solde']);
            var years = solde.years;
            var caisseValues = solde.caisseValues;
            var banqueValues = solde.banqueValues;
            var latestCaisse = solde.latestCaisse;
            var latestBanque = solde.latestBanque;
            // Create a line chart using Chart.js library
            var ctx = document.getElementById('solde-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Caisse',
                        data: caisseValues,
                        borderColor: 'rgb(54, 162, 235)',
                        fill: false
                    }, {
                        label: 'Banque',
                        data: banqueValues,
                        borderColor: 'rgb(255, 99, 132)',
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            // Display the latest caisse and banque values in a card
            document.getElementById('latest-caisse').innerHTML = latestCaisse;
            document.getElementById('latest-banque').innerHTML = latestBanque;
        </script>
    @endsection
