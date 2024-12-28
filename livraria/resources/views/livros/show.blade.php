@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Visualizar livro</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a class="btn btn-info btn-sm me-1" href="{{ route('livro.index') }}">Listar livros</a>
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
            </span>
        </div>


        <div class="card-body">
            <x-alert />
            <dl class="row">
                <dt class="col-sm-2">Código:</dt>
                <dd class="col-sm-2">{{ $livro->codl }}</dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-2">Título:</dt>
                <dd class="col-sm-2">{{ $livro->titulo }}</dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-2">Autor:</dt>
                <dd class="col-sm-2">
                    @foreach ($livro->autores as $autor)
                        {{ $autor->nome }}<br>
                    @endforeach
                </dd>
                <dt class="col-sm-2">Assunto:</dt>
                <dd class="col-sm-2">
                    @foreach ($livro->assuntos as $assunto)
                        {{ $assunto->descricao }}<br>
                    @endforeach
                </dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-2">Editora:</dt>
                <dd class="col-sm-2">{{ $livro->editora }}</dd>
                <dt class="col-sm-2">Edição:</dt>
                <dd class="col-sm-2">{{ $livro->edicao }}</dd>
                <dt class="col-sm-2">Ano publicação:</dt>
                <dd class="col-sm-2">{{ $livro->anoPublicacao }}</dd>
            </dl>

            <dl class="row">
                <dt class="col-sm-2">Valor:</dt>
                <dd class="col-sm-2">R$ {{ number_format($livro->valor, 2, ',', '.') }}</dd>
            </dl>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>
@endsection


