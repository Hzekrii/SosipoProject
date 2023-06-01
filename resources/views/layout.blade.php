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
    @include('partials.sidebar')
    <main class="main-content position-relative ">
        @include('partials.navbar')
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
                    {{-- Content Section  --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    </div>

    @include('scripts')
    @stack('script')


</body>

</html>
