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

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('autor.index') }}" class="nav-link px-2 text-white">Livros</a></li>
                <li><a href="{{ route('autor.index') }}" class="nav-link px-2 text-white">Autores</a></li>
                <li><a href="{{ route('assunto.index') }}" class="nav-link px-2 text-white">Assunto</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Relatorio</a></li>
            </ul>

            <div class="col-md-3 text-end">

            </div>
        </header>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
