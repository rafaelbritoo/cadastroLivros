@extends('layouts.admin')


@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Lista de assuntos</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('assunto.create') }}">Cadastrar assunto</a>
            </span>
        </div>

        <div class="container">
            <!-- Formulário de Filtro -->
            <form method="GET" action="{{ route('assunto.index') }}" id="formSearch" class="mb-4 mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" maxlength="20" name="descricao" class="form-control" placeholder="Assunto" value="{{ request()->descricao }}">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
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
                        <th scope="col">Descrição</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (is_null($assuntos[0]))
                        <tr>
                            <th colspan="7" class="text-center"> Não existem assuntos cadastrados ainda!</th>>
                        </tr>
                    @endif
                @forelse($assuntos as $assunto)
                    <tr>
                        <th>{{ $assunto->codAs }}</th>
                        <td>{{ $assunto->descricao }}</td>
                        <td class="text-center">
                            <a href="{{ route('assunto.show', ['assunto' => $assunto->codAs]) }}"  class="btn btn-primary btn-sm"> Visualizar assunto</a>
                            <a href="{{ route('assunto.edit', ['assunto' => $assunto->codAs]) }}"  class="btn btn-warning btn-sm"> Editar assunto</a>
                            <form class="d-inline" action="{{ route('assunto.destroy', ['assunto' => $assunto->codAs]) }}" method="POST" id="delete-form-{{ $assunto->codAs }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger btn-sm"
                                    type="button"
                                    onclick="confirmDelete('{{ $assunto->descricao }}', {{ $assunto->codAs }})"
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
                    {{ $assuntos->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#clearFiltersBtn').on('click', function() {
            // Limpa todos os campos de filtro do formulário
            $('#formSearch')[0].reset();

            // Opcional: Pode redirecionar para a mesma página sem filtros
            window.location.href = '{{ route('assunto.index') }}';
        });
    </script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>
