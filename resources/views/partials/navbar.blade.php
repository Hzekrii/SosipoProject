  @php
      use Illuminate\Support\Carbon;
      use Illuminate\Support\Facades\Storage;
  @endphp
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
                                  <a class="dropdown-item border-radius-md" href="{{ route('approuve.recette.show') }}">
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
                      <a class="nav-link dropdown-toggle text-white font-weight-bold px-0" href="#" role="button"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="{{ asset('images/' . Auth::user()->url) }}" style="width:40px;height:40px"
                              class="rounded-circle img-thumbnail me-2" alt="{{ auth()->user()->name }}">
                          <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                          <form action="{{ route('logout') }}" method="post">
                              @csrf
                              <button class="dropdown-item" type="submit">Logout</button>
                          </form>
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
