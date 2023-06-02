<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ImagineShirt</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    @vite('resources/sass/app.scss')
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid px-3 px-lg-2 mx-3">
            <a class="navbar-brand" href="{{ route('tshirt_images.index') }}">ImagineShirt</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>                               <!-- about page-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
                 <!-- Sidebar Toggle-->
                @guest
                    <ul class="navbar-nav ms-2 me-1 me-lg-3">
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                @else
                    <div class="ms-auto me-0 me-md-2 my-2 my-md-0 navbar-text">
                        {{ Auth::user()->name }}
                    </div>
                    <!-- Navbar-->
                    <ul class="navbar-nav me-1 me-lg-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar" class="bg-dark rounded-circle" width="45" height="45">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if ((Auth::user() ?? ''))
                                    <li>
                                        <a class="dropdown-item"href="{{ route('users.show', ['user' => Auth::user()])}}">Perfil</a>
                                    </li>
                                @endif
                                <li><a class="dropdown-item" href="{{route('password.change.show')}}">Alterar Senha</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>
    <main>
        <div class="container-fluid px-4">
            @if (session('alert-msg'))
                @include('shared.messages')
            @endif
            @if ($errors->any())
                @include('shared.alertValidation')
            @endif
            <div class="mt-4">
                @yield('main')
            </div>
        </div>
    </main>
    <footer class="py-2 bg-light mt-auto" style="bottom:0; width:100%;">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-center small">
                <div class="text-muted">Copyright &copy;Politécnico de Leiria 2023</div>
            </div>
        </div>
    </footer>
    @vite('resources/js/app.js')
</body>

</html>
