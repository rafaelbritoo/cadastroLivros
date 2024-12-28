@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Visualizar Autor</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a class="btn btn-info btn-sm me-1" style="max-height: 32px" href="{{ route('autor.index') }}">Listar autores</a>
                <form action="{{ route('autor.destroy', ['autor' => $autor->codAu]) }}" method="POST" id="delete-form-{{ $autor->codAu }}">
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
            </span>
        </div>


        <div class="card-body">
            <x-alert />
            <dl class="row">
                <dt class="col-sm-2">Código:</dt>
                <dd class="col-sm-2">{{ $autor->codAu }}</dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-2">Nome do Autor:</dt>
                <dd class="col-sm-2">{{ $autor->nome }}</dd>
            </dl>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>
