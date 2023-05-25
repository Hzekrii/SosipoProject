@php
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Sosipo
    </title>

    @include('styles')
</head>

<body class="g-sidenav-show   ">
    <div class="min-height-200 bg-success position-absolute w-100" id="bg-image"
        style="background-image: url('{{ asset('images/light-image.jpg') }}')">
    </div>
    <aside class="sidenav  navbar navbar-vertical navbar-expand-xs rounded my-3 fixed-start ms-4" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-10 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('charts') }}">
                <img src="{{ asset('images/sosipologo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Sosipo</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse h-100">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                        class="nav-link btn btn-gradient-success text-light" href="{{ route('charts') }}"
                        data-color="success">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-dashboard text-light text-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1 mt-2 fw-bold">Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role_id != '3')
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                            class="nav-link btn btn btn-gradient-success text-light" href="{{ route('recette.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-up-arrow text-light text-lg"></i>
                            </div>
                            <span class="nav-link-text ms-2 mt-2 fw-bold">Recette</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                            class="nav-link btn btn-gradient-success text-light" href="{{ route('depense.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-down-arrow text-light text-lg "></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2 fw-bold">Depense</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                            class="nav-link btn btn-gradient-success text-light" href="{{ route('credit.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-down-arrow text-light text-lg "></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2 fw-bold">Crédit</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                            class="nav-link btn btn-gradient-success text-light"
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
                    <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                        class="nav-link btn btn-gradient-success text-light" href="{{ route('document.show') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-filetype-doc text-light text-lg "></i>
                        </div>
                        <span class="nav-link-text ms-1 mt-2 fw-bold">Document</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                        class="nav-link btn btn-gradient-success text-light" href="{{ route('adherents.index') }}">
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

                        <li class="navbar-item d-flex mx-3 align-items-center">
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" id="dark-version">
                                <label class="form-check-label ms-2" for="dark-version">
                                    <span class="light-text">Light/</span>
                                    <span class="dark-text">Dark</span>
                                </label>
                            </div>
                        </li>
                        <li class="nav-item dropdown d-flex mx-3 align-items-center">
                            <a class="nav-link dropdown-toggle text-white font-weight-bold px-0" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('images/' . Auth::user()->url) }}" style="width:40px;height:40px"
                                    class="rounded-circle img-thumbnail me-2" alt="{{ auth()->user()->name }}">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
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
    {{-- <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"></i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Configuration</h5>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <div class="d-flex flex-column">
                    <div class="mt-2 mb-5">
                        <h6 class="mb-0">Sidebar Color</h6>
                        <a href="javascript:void(0)" class="switch-trigger background-color">
                            <div class="badge-colors my-2 text-start">
                                <span class="badge filter bg-gradient-primary active" data-color="primary"
                                    onclick="sidebarColor(this)"> </span>
                                <span class="badge filter bg-gradient-dark" data-color="dark"
                                    onclick="sidebarColor(this)"> </span>
                                <span class="badge filter bg-gradient-info" data-color="info"
                                    onclick="sidebarColor(this)"> </span>
                                <span class="badge filter bg-gradient-success" data-color="success"
                                    onclick="sidebarColor(this)"> </span>
                                <span class="badge filter bg-gradient-warning" data-color="warning"
                                    onclick="sidebarColor(this)"> </span>
                                <span class="badge filter bg-gradient-danger" data-color="danger"
                                    onclick="sidebarColor(this)"> </span>
                            </div>
                        </a>
                    </div>

                    <div class="mt-2 mb-5">
                        <h6 class="mb-0">Light / Dark</h6>
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                                onclick="darkMode(this)">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @include('scripts')
    @stack('script')


</body>

</html>
