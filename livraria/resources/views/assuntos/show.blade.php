@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Visualizar assunto</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a class="btn btn-info btn-sm me-1" href="{{ route('assunto.index') }}">Listar assuntos</a>
                <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                    Apagar
                </button>
            </span>
        </div>


        <div class="card-body">
            <x-alert />
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-2">{{ $assunto->codAs }}</dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-3">Descrição do assunto:</dt>
                <dd class="col-sm-2">{{ $assunto->descricao }}</dd>
            </dl>
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
