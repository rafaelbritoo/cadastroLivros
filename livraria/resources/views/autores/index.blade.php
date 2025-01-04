@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Lista de autores</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('autor.create') }}">Cadastrar autor</a>
            </span>
        </div>

        <div class="container">
            <!-- Formulário de Filtro -->
            <form method="GET" action="{{ route('autor.index') }}" id="formSearch" class="mb-4 mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" maxlength="40" name="nome" class="form-control" placeholder="Nome" value="{{ request()->nome }}">
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
                        <th scope="col">Nome</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (is_null($autores[0]))
                        <tr>
                            <th colspan="7" class="text-center"> Não existem autores cadastrados ainda!</th>>
                        </tr>
                    @endif
                @forelse($autores as $autor)
                    <tr>
                        <th>{{ $autor->codAu }}</th>
                        <td>{{ $autor->nome }}</td>
                        <td class="text-center">
                            <a href="{{ route('autor.show', ['autor' => $autor->codAu]) }}"  class="btn btn-primary btn-sm"> Visualizar autor</a>
                            <a href="{{ route('autor.edit', ['autor' => $autor->codAu]) }}"  class="btn btn-warning btn-sm"> Editar autor</a>
                            <form class="d-inline" action="{{ route('autor.destroy', ['autor' => $autor->codAu]) }}" method="POST" id="delete-form-{{ $autor->codAu }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger btn-sm"
                                    type="button"
                                    onclick="confirmDelete('{{ $autor->nome }}', {{ $autor->codAu }})"
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
                    {{ $autores->appends(request()->query())->links() }}
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
            window.location.href = '{{ route('autor.index') }}';
        });
    </script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>
