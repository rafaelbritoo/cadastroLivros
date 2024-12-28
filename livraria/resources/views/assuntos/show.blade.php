@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Visualizar assunto</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a class="btn btn-info btn-sm me-1" style="max-height: 32px" href="{{ route('assunto.index') }}">Listar assuntos</a>
                <form action="{{ route('assunto.destroy', ['assunto' => $assunto->codAs]) }}" method="POST" id="delete-form-{{ $assunto->codAs }}">
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
            </span>
        </div>


        <div class="card-body">
            <x-alert />
            <dl class="row">
                <dt class="col-sm-3">Código:</dt>
                <dd class="col-sm-2">{{ $assunto->codAs }}</dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-3">Descrição do assunto:</dt>
                <dd class="col-sm-2">{{ $assunto->descricao }}</dd>
            </dl>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>

