<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('images/sosipologo.png') }}">
    <title>
        Sosipo - Login
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
       <style>
            .invalid-bg{
                background-color: rgb(247, 193, 193);
            }
       </style>
        
        
        
        
</head>

<body class="">

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <form method="POST" action="{{ route('check') }}" autocomplete="off">
                                        @csrf
                                    
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control {{ $errors->has('email') && $errors->has('password') ? 'is-invalid-email-password' : '' }} {{ $errors->has('email') && !$errors->has('password') ? 'is-invalid-email' : '' }} {{ !$errors->has('email') && $errors->has('password') ? 'is-invalid-password' : '' }} form-control-lg"
                                                placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                            @error('email')
                                                <div class="text-danger" style="font-size: 14px">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control {{ $errors->has('email') && $errors->has('password') ? 'is-invalid-email-password' : '' }} {{ !$errors->has('email') && $errors->has('password') ? 'is-invalid-password' : '' }} {{ $errors->has('email') && !$errors->has('password') ? 'is-invalid-email' : '' }} form-control-lg"
                                                placeholder="Password" value="{{ old('password') }}" aria-label="password">
                                            @error('password')
                                                <div class="text-danger" style="font-size: 14px">{{ $message }}</div>
                                            @enderror
                                        </div>                                        
                                        
                                    
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" class="remember" type="checkbox" id="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form> --}}
                                    <form method="POST" action="{{ route('check') }}" autocomplete="off">
                                        @csrf
                                    
                                        <div class="mb-3">
                                            <input type="email" name="email" class="form-control @error('email') is-invalid invalid-bg @enderror form-control-lg"
                                                placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                            @error('email')
                                                <div class="text-danger" style="font-size: 14px">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    
                                        <div class="mb-3">
                                            <input type="password" name="password" class="form-control @error('password') is-invalid invalid-bg @enderror form-control-lg"
                                                placeholder="Password" value="{{ old('password') }}" aria-label="password">
                                            @error('password')
                                                <div class="text-danger" style="font-size: 14px">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" class="remember" type="checkbox" id="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                    
                                   
                                    
                                    

                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?

                                        <a href="{{ route('register') }}"
                                            class="text-primary text-gradient font-weight-bold">Sign up</a>
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
    

</body>

</html>