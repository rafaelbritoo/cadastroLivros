@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Relatório</span>
        </div>

        <div class="container">
            <h2 class="my-4">Catálogo de Livros</h2>

            <!-- Formulário de Filtro -->
            <form method="GET" action="{{ route('relatorio.index') }}" id="formSearch" class="mb-4">
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
                        <input type="text" maxlength="40" name="autor" class="form-control" placeholder="Nome do autor" value="{{ request()->autor }}">
                    </div>
                    <div class="col-md-4 mt-4">
                        <input type="text" maxlength="20" name="assunto" class="form-control" placeholder="Assunto" value="{{ request()->assunto }}">
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
                <div class="d-flex justify-content-between mt-3">
                    <!-- Formulário para limpar filtros -->
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                        <button type="button" class="btn btn-warning" id="clearFiltersBtn">Limpar Filtros</button>
                    </div>

                    <!-- Botões para exportar Excel e PDF -->
                    <div class="d-flex align-items-center">
                        <!-- Botão para exportar Excel -->
                        <a href="{{ route('relatorio.export.excel') }}" class="btn btn-success me-lg-2">Exportar Excel</a>

                        <!-- Botão para exportar PDF -->
                        <a href="{{ route('relatorio.export.pdf') }}" class="btn btn-danger ml-2">Exportar PDF</a>
                    </div>
                </div>
            </form>


            <div class="mb-3">
                <strong>Ordenar por:</strong>
                <a href="{{ route('relatorio.index', array_merge(request()->all(), ['sort_by' => 'livro_titulo', 'sort_direction' => request()->sort_direction == 'asc' ? 'desc' : 'asc'])) }}" class="btn btn-link">
                    Título
                    @if (request()->sort_by == 'livro_titulo')
                        <i class="fa fa-arrow-{{ request()->sort_direction == 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </a> |
                <a href="{{ route('relatorio.index', array_merge(request()->all(), ['sort_by' => 'autor_nome', 'sort_direction' => request()->sort_direction == 'asc' ? 'desc' : 'asc'])) }}" class="btn btn-link">
                    Autor
                    @if (request()->sort_by == 'autor_nome')
                        <i class="fa fa-arrow-{{ request()->sort_direction == 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </a> |
                <a href="{{ route('relatorio.index', array_merge(request()->all(), ['sort_by' => 'valor_formatado', 'sort_direction' => request()->sort_direction == 'asc' ? 'desc' : 'asc'])) }}" class="btn btn-link">
                    Valor
                    @if (request()->sort_by == 'valor_formatado')
                        <i class="fa fa-arrow-{{ request()->sort_direction == 'asc' ? 'up' : 'down' }}"></i>
                    @endif
                </a>
            </div>

            <!-- Tabela de Livros -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Título</th>
                    <th>Editora</th>
                    <th>Edição</th>
                    <th>Ano de Publicação</th>
                    <th>Autor</th>
                    <th>Assunto</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                @if(empty($livros[0]))
                    <tr>
                        <td colspan="8" class="text-center">Nenhum livros encotrado!</td>
                    </tr>
                @else
                    @foreach ($livros as $livro)
                        <tr>
                            <td>{{ $livro->codigo_livro }}</td>
                            <td>{{ $livro->livro_titulo }}</td>
                            <td>{{ $livro->editora }}</td>
                            <td>{{ $livro->edicao }}</td>
                            <td>{{ $livro->ano_publicacao }}</td>
                            <td>{{ $livro->autor_nome }}</td>
                            <td>{{ $livro->assunto_nome }}</td>
                            <td>{{ $livro->valor_formatado }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $livros->appends(request()->query())->links() }}
            </div>
        </div>

    </div>
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
            window.location.href = '{{ route('relatorio.index') }}';
        });
    </script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection

