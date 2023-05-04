@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('images/sosipologo.png') }}">
    <title>
        Sosipo
    </title>
    <!--     Fonts and icons     -->

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- animation css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- End animation css -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.min.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        main {
            min-height: 100vh;
            /* set minimum height to the viewport height */
        }

        /* Define the gradient background colors */
        .btn-gradient-success {
            background: linear-gradient(to left, #2DCE92, #2DCEC2);
            background-color: #28a745;
            /* fallback color for older browsers */
            border-color: #28a745;
            color: #fff;
        }

        /* Override the default "btn-success" class */
        .btn-gradient-success:hover {
            background: linear-gradient(to right, #2DCEC2, #2DCE92);
            background-color: #007bff;
            /* fallback color for older browsers */
            border-color: #007bff;
        }
    </style>

</head>

<body class="g-sidenav-show   bg-white-300">
    <div class="min-height-200 bg-success position-absolute w-100"
        style="background-image: url('{{ asset('images/img3.wallspic.com-triticale-agriculture-barley-food_grain-crop-2560x1600.jpg') }}')">
    </div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs rounded  my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-10 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="#" target="_blank">
                <img src="{{ asset('images/sosipologo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Sosipo</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse h-100">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <a id="loading" onclick="showLoading(event)"
                        class="nav-link  btn btn-gradient-success text-light  " href="{{ route('charts') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-dashboard text-light  text-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1 mt-2 fw-bold">Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role_id != '3')
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="showLoading(event)"
                            class="nav-link btn btn btn-gradient-success text-light "
                            href="{{ route('recette.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-up-arrow text-light text-lg"></i>
                            </div>
                            <span class="nav-link-text ms-2 mt-2 fw-bold">Recette</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="showLoading(event)"
                            class="nav-link  btn btn-gradient-success text-light  " href="{{ route('depense.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-down-arrow text-light text-lg "></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2 fw-bold">Depense</span>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a id="loading" onclick="showLoading(event)"
                            class="nav-link  btn btn-gradient-success text-light  " href="{{ route('credit.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-down-arrow text-light text-lg "></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2 fw-bold">Crédit</span>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <a id="loading" onclick="showLoading(event)"
                            class="nav-link  btn btn-gradient-success text-light  "
                            href="{{ route('remboursement.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-up-arrow text-light text-lg"></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2 fw-bold">Remboursement</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item mt-3">
                    <a id="loading" onclick="showLoading(event)"
                        class="nav-link  btn btn-gradient-success text-light " href="{{ route('document.show') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-filetype-doc text-light text-lg "></i>
                        </div>
                        <span class="nav-link-text ms-1 mt-2 fw-bold">Document</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a id="loading" onclick="showLoading(event)"
                        class="nav-link  btn btn-gradient-success text-light " href="{{ route('adherents.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-filetype-doc text-light text-lg "></i>
                        </div>
                        <span class="nav-link-text ms-1 mt-2 fw-bold">Adherent</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav ms-auto justify-content-end">
                        @if (Auth::user()->role_id == '1')
                            <li class="nav-item dropdown text-dark pe-2 mx-3 d-flex align-items-center">
                                <a href="javascript:;"
                                    class="nav-link  p-0
                                    @if (DB::table('remboursements')->where('approuve', false)->count() +
                                            DB::table('credits')->where('approuve', false)->count() +
                                            DB::table('depenses')->where('approuve', false)->count() +
                                            DB::table('recettes')->where('approuve', false)->count() >
                                            0) animate__animated animate__headShake animate__infinite text-danger
                                    @else
                                        text-light @endif
                                    "
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell-fill cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end text-dark  px-2 py-3 me-sm-n4"
                                    aria-labelledby="dropdownMenuButton">
                                    <li class="mb-2">
                                        <a class="dropdown-item text-dark border-radius-md"
                                            href="{{ route('approuve.depense.show') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col me-5">
                                                            <p class="text-sm font-weight-normal mb-1">Depenses</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="badge text-danger me-auto">
                                                                {{ DB::table('depenses')->where('approuve', false)->count() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        @php
                                                            $depense = DB::table('depenses')
                                                                ->where('approuve', false)
                                                                ->first();
                                                            if ($depense) {
                                                                $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $depense->created_at);
                                                                $diff = $created_at->diffForHumans();
                                                                echo $diff;
                                                            } else {
                                                                echo '<p class="text-xs text-secondary mb-0">Tout les depenses sont
                                                        approuvé.</p>';
                                                            }
                                                        @endphp
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md"
                                            href="{{ route('approuve.recette.show') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col me-5">
                                                            <p class="text-sm font-weight-normal mb-1">Recettes</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="badge text-danger me-auto">
                                                                {{ DB::table('recettes')->where('approuve', false)->count() }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        @php
                                                            $recette = DB::table('recettes')
                                                                ->where('approuve', false)
                                                                ->first();
                                                            if ($recette) {
                                                                $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $recette->created_at);
                                                                $diff = $created_at->diffForHumans();
                                                                echo $diff;
                                                            } else {
                                                                echo '<p class="text-xs text-secondary mb-0">Tout les recettes sont
                                                        approuvé.</p>';
                                                            }
                                                        @endphp
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="mb-2">
                                        <a class="dropdown-item text-dark border-radius-md"
                                            href="{{ route('approuve.credit.show') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col me-5">
                                                            <p class="text-sm font-weight-normal mb-1">Crédits</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="badge text-danger me-auto">
                                                                {{ DB::table('credits')->where('approuve', false)->count() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        @php
                                                            $credit = DB::table('credits')
                                                                ->where('approuve', false)
                                                                ->first();
                                                            if ($credit) {
                                                                $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $credit->created_at);
                                                                $diff = $created_at->diffForHumans();
                                                                echo $diff;
                                                            } else {
                                                                echo '<p class="text-xs text-secondary mb-0">Tout les credits sont
                                                        approuvé.</p>';
                                                            }
                                                        @endphp
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="mb-2">
                                        <a class="dropdown-item text-dark border-radius-md"
                                            href="{{ route('approuve.remboursement.show') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="col me-5">
                                                            <p class="text-sm font-weight-normal mb-1">Remboursements
                                                            </p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="badge text-danger me-auto">
                                                                {{ DB::table('remboursements')->where('approuve', false)->count() }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        @php
                                                            $remboursement = DB::table('remboursements')
                                                                ->where('approuve', false)
                                                                ->first();
                                                            if ($remboursement) {
                                                                $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $remboursement->created_at);
                                                                $diff = $created_at->diffForHumans();
                                                                echo $diff;
                                                            } else {
                                                                echo '<p class="text-xs text-secondary mb-0">Tout les
                                                        remboursements sont approuvé.</p>';
                                                            }
                                                        @endphp
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif
                        <li class="nav-item dropdown d-flex mx-3 align-items-center">
                            <a class="nav-link dropdown-toggle text-white font-weight-bold px-0" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('storage/images/' . Auth::user()->url) }}"
                                    style="width:40px;height:40px" class="rounded-circle img-thumbnail me-2"
                                    alt="{{ auth()->user()->name }}">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        </li>
                        <li class="nav-item d-flex mx-3 align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item d-lg-none ps-3 mx-3 d-flex align-items-center">
                            <a href="#" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-lg-12 col-sm-12">
                    {{-- Content Section  --}}
                    @if (session('success'))
                        <div class="col-5 mx-auto">
                            <div class="alert alert-success d-flex text-light align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                    aria-label="Success:">
                                    <use xlink:href="#check-circle-fill" />
                                </svg>
                                <div>
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-5 mx-auto">
                            <div class="alert alert-warning text-light d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                    aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                <div>
                                    {{ session('error') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @yield('content')
                    {{-- Content Section  --}}
                </div>
            </div>
        </div>
    </main>
    </div>
    @include('scripts')
</body>

</html>
