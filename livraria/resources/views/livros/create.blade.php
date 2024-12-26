@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Cadastro de livro</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('livro.index') }}">Listar livros</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <form action="{{ route('store-livro', ['livro' => $assunto->codl]) }}" method="POST" class="row g-3">
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <label for="titulo" class="form-label">Título:</label>
                    <input class="form-control" id="titulo" type="text" name="titulo" value="{{ old('titulo') }}" placeholder="Título do livro" required>
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
                    <input class="form-control" id="editora" type="text" name="editora" value="{{ old('editora') }}" placeholder="Editora do livro" required>
                </div>

                <div class="col-md-4">
                    <label for="edicao" class="form-label">Edição:</label>
                    <input class="form-control" id="edicao" type="number" name="edicao" value="{{ old('edicao') }}" placeholder="Edição do livro" required>
                </div>

                <div class="col-md-4">
                    <label for="anoPublicacao" class="form-label">Ano de Publicação:</label>
                    <input type="number" min="1500" max="{{ date('Y') }}"  class="form-control" id="anoPublicacao" name="anoPublicacao" value="{{ old('anoPublicacao') }}" placeholder="Selecione o ano" required>
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
<script>
    $(document).ready(function () {
        $('#valor').on('input', function () {
            let value = $(this).val();

            // Remove qualquer caractere não numérico
            value = value.replace(/[^0-9]/g, '');

            // Converte para número float e formata com duas casas decimais
            value = (value / 100).toFixed(2);

            // Substitui o ponto pela vírgula para formato brasileiro
            value = value.replace('.', ',');

            // Adiciona separadores de milhares
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Atualiza o valor no campo com o prefixo "R$ "
            $(this).val(value);
        });

        $('#anoPublicacao').datepicker({
            format: 'yyyy',          // Formato do valor no campo
            minViewMode: 2,          // Exibe apenas anos
            autoclose: true,         // Fecha automaticamente após seleção
            startDate: '1500',       // Ano inicial permitido
            endDate: new Date().getFullYear().toString() // Ano final (atual)
        });
    });
</script>

