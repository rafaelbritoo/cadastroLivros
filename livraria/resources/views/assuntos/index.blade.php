@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Lista de assuntos</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('assunto.create') }}">Cadastrar assunto</a>
            </span>
        </div>

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

            @forelse($assuntos as $assunto)
                <tr>
                    <th>{{ $assunto->codAs }}</th>
                    <td>{{ $assunto->descricao }}</td>
                    <td class="text-center">
                        <a href="{{ route('assunto.show', ['assunto' => $assunto->codAs]) }}"  class="btn btn-primary btn-sm"> Visualizar assunto</a>
                        <a href="{{ route('assunto.edit', ['assunto' => $assunto->codAs]) }}"  class="btn btn-warning btn-sm"> Editar assunto</a>
                        <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            Apagar
                        </button>
                    </td>
                </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza de que deseja apagar o assunto <strong>{{  $assunto->descricao }}</strong>? Esta ação não pode ser desfeita.</p>
                    <p><em>Essa exclusão será permanente, todos os dados relacionados ao livro serão removidos.</em></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('assunto.destroy', ['assunto' => $assunto->codAs]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sim, Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
