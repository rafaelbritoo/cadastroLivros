@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Visualizar livro</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a class="btn btn-info btn-sm me-1" href="{{ route('livro.index') }}">Listar livros</a>
                <form action="{{ route('livro.destroy', ['livro' => $livro->codl]) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Deseja realmente apagar o livro ({{ $livro->titulo }}) ?')">Apagar</button>
                </form>
            </span>
        </div>


        <div class="card-body">
            <x-alert />
            <dl class="row">
                <dt class="col-sm-2">ID:</dt>
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
                <dd class="col-sm-2">{{ $livro->valor }}</dd>
            </dl>
        </div>
    </div>
@endsection
