<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/sosipologo.png') }}">
    <title>
        Sosipo - Inscription
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

</head>

<body class="">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">

                            <div class="my-3">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') ?? '' }}</div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') ?? '' }}</div>
                                @endif
                            </div>
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">S'inscrire</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" class="needs-validation" novalidate=""
                                        action="{{ route('post.register') }}" enctype="multipart/form-data"
                                        autocomplete="off">
                                        @csrf

                                        <div class="mb-3">
                                            <input id="name" type="text" class="form-control" name="name"
                                                placeholder="Nom complet ici" value="{{ old('name') }}" required
                                                autofocus>
                                            @error('name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control "
                                                placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                        </div>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="mb-3">
                                            <select name="role" class="form-control" id="#roleid">
                                                <option value="0" class="text-muted">Veuillez sélectionner le rôle
                                                </option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->libelle }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-2 text-muted">Uploadez votre avatar</label>
                                            <input id="avatar" type="file" class="form-control" name="avatar"
                                                value="{{ old('avatar') }}" accept="image/*">
                                            @error('avatar')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control  "
                                                placeholder="Password" value="{{ old('password') }}"
                                                aria-label="password">
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="mb-3">
                                            <input type="password" name="password_confirmation"
                                                id="password_confirmation" class="form-control  "
                                                placeholder="Password confiramtion"
                                                value="{{ old('password_confirmation') }}" aria-label="password">
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" class="remember" type="checkbox"
                                                id="remember">
                                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">S'inscrire</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Vous avez déjà un compte ?
                                        <a href="{{ route('login') }}"
                                            class="text-primary text-gradient font-weight-bold">Connexion</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative  h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('{{ asset('images/pexels-kasuma-2568913.jpg') }}');
                background-size: cover;">
                                <span class="mask bg-gradient-dark opacity-3"></span>
                                <div class="text-center mb-2">
                                    <img src="{{ asset('images/sosipologo.png') }}" alt="logo" width="100">
                                </div>
                                <p class="text-white position-relative">Le succès dans les affaires nécessite de la
                                    formation et de la discipline et de travailler dur. Mais si vous ne vous amusez pas
                                    en cours de route, vous ne réussirez pas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>
