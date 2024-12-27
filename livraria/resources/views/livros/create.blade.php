@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Cadastro de livro</span>
            <span class="ms-auto">
                <a class="btn btn-info btn-sm" href="{{ route('livro.index') }}">Listar livros</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <form action="{{ route('store-livro') }}" method="POST" class="row g-3">
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <label for="titulo" class="form-label">Título:</label>
                    <input class="form-control" maxlength="40" id="titulo" type="text" name="titulo" value="{{ old('titulo') }}" placeholder="Título do livro" required>
                </div>

                <div class="col-md-6">
                    <label for="autor" class="form-label">Autor:</label>
                    <select class="form-select form-select-md mb-3" name="codAu" id="codAu">
                        <option value="">Selecione...</option>
                        @foreach($autores as $autor)
                            <option value="{{ $autor->codAu }}">{{ $autor->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="assunto" class="form-label">Assunto:</label>
                    <select class="form-select form-select-md mb-3" name="codAs" id="codAs">
                        <option value="">Selecione...</option>
                        @foreach($assuntos as $assunto)
                            <option value="{{ $assunto->codAs }}">{{ $assunto->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="editora" class="form-label">Editora:</label>
                    <input class="form-control" maxlength="40" id="editora" type="text" name="editora" value="{{ old('editora') }}" placeholder="Editora do livro" required>
                </div>

                <div class="col-md-4">
                    <label for="edicao" class="form-label">Edição:</label>
                    <input class="form-control" id="edicao" type="number" name="edicao" value="{{ old('edicao') }}" placeholder="Edição do livro" required>
                </div>

                <div class="col-md-4">
                    <label for="anoPublicacao" class="form-label">Ano de Publicação:</label>
                    <select class="form-select form-select" id="anoPublicacao" name="anoPublicacao" required>
                        <option value="">Selecione...</option>
                        @foreach(range(date('Y'), 1500) as $ano)
                            <option value="{{ $ano }}" {{ old('anoPublicacao') == $ano ? 'selected' : '' }}>{{ $ano }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 form-group">
                    <label for="valor" class="form-label">Valor:</label>
                    <input class="form-control" id="valor" type="text" name="valor" value="{{ old('valor') }}" placeholder="Valor do livro" required>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="{{ asset('livro/assets/js/livro.js') }}"></script>

