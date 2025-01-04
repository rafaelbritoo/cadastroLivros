@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Livraria</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('livro.create') }}">Cadastrar livro</a>
            </span>
        </div>

        <div class="container">
{{--            <h2 class="my-4">Pesquisar Livros</h2>--}}
            <!-- Formulário de Filtro -->
            <form method="GET" action="{{ route('livro.index') }}" id="formSearch" class="mb-4 mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" maxlength="40" name="titulo" class="form-control" placeholder="Título do livro" value="{{ request()->titulo }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" maxlength="40" name="editora" class="form-control" placeholder="Editora" value="{{ request()->editora }}">
                    </div>

                    <div class="col-md-4">
                        <input type="number" name="edicao" class="form-control" placeholder="Edição" value="{{ request()->edicao }}">
                    </div>

                    <div class="col-md-4 mt-4">
                        <select class="form-select form-select" id="anoPublicacao" name="anoPublicacao">
                            <option value="">Ano de publicação</option>
                            @foreach(range(date('Y'), 1500) as $ano)
                                <option value="{{ $ano }}" {{ request()->anoPublicacao == $ano ? 'selected' : '' }}>{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mt-4">
                        <input class="form-control" id="valor_min" type="text" name="valor_min"
                               value="{{ request()->valor_min }}" placeholder="Valor mínimo">
                    </div>
                    <div class="col-md-4 mt-4">
                        <input class="form-control" id="valor_max" type="text" name="valor_max"
                               value="{{ request()->valor_max }}" placeholder="Valor máximo">
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <!-- Formulário para limpar filtros -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                        <button type="button" class="btn btn-warning" id="clearFiltersBtn">Limpar Filtros</button>
                    </div>
                </div>
            </form>


            <div class="card-body">
                <x-alert />
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Edição</th>
                        <th scope="col">Ano de publicação</th>
                        <th scope="col">Valor</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                @if (is_null($livros[0]))
                    <tr>
                        <th colspan="7" class="text-center"> Não existem livros cadastrados ainda!</th>>
                    </tr>
                @endif
                @forelse($livros as $livro)
                    <tr>
                        <th>{{ $livro->codl }}</th>
                        <td>{{ $livro->titulo }}</td>
                        <td>{{ $livro->editora }}</td>
                        <td>{{ $livro->edicao }}</td>
                        <td>{{ $livro->anoPublicacao }}</td>
                        <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('livro.show', ['livro' => $livro->codl]) }}"  class="btn btn-primary btn-sm"> Visualizar livro</a>
                            <a href="{{ route('livro.edit', ['livro' => $livro->codl]) }}"  class="btn btn-warning btn-sm"> Editar livro</a>
                            <form class="d-inline" action="{{ route('livro.destroy', ['livro' => $livro->codl]) }}" method="POST" id="delete-form-{{ $livro->codl }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger btn-sm"
                                    type="button"
                                    onclick="confirmDelete('{{ $livro->titulo }}', {{ $livro->codl }})"
                                >
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>

                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $livros->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#valor_min, #valor_max').mask('000.000.000.000,00', { reverse: true });
        });

        $('#clearFiltersBtn').on('click', function() {
            // Limpa todos os campos de filtro do formulário
            $('#formSearch')[0].reset();

            // Opcional: Pode redirecionar para a mesma página sem filtros
            window.location.href = '{{ route('livro.index') }}';
        });
    </script>
@endsection

