<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Livraria</title>
</head>
<body>

    <div class="container">
        <header class="d-flex text-bg-primary flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand text-white " href="#">Livraria</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('livro.*') ? 'text-dark' : 'text-white' }}" href="{{ route('livro.index') }}">Livros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('autor.*') ? 'text-dark' : 'text-white' }}" href="{{ route('autor.index') }}">Autores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('assunto.*') ? 'text-dark' : 'text-white' }}" href="{{ route('assunto.index') }}">Assuntos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Relatório</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="col-md-3 text-end">

            </div>
        </header>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
