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
                    @if (Auth::user()->role_id == '1' )
                        <li class="nav-item mt-3">
                            <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                                class="nav-link btn btn-gradient-success text-light"
                                href="{{ route('adherents.index') }}">
                                <div
                                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users text-light text-lg"></i>
                                </div>
                                <span class="nav-link-text ms-1 mt-2 fw-bold">Adherent</span>
                            </a>
                        </li>
                       
                    @endif
                @endif
                @if (Auth::user()->role_id == '3' || Auth::user()->role_id == '1')
                    <li class="nav-item mt-3">
                        <a id="loading" onclick="sidebarColor(this); showLoading(event)"
                            class="nav-link btn btn-gradient-success text-light" href="{{ route('document.show') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-filetype-doc text-light text-lg "></i>
                            </div>
                            <span class="nav-link-text ms-1 mt-2 fw-bold">Document </span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </aside>
