@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Cadastra Assunto</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('assunto.index') }}">Listar assuntos</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <form action="{{ route('store-assunto') }}" method="POST" class="row g-3">
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <input class="form-control" id="name" type="text" name="descricao" placeholder="Descrição do livro"><br><br>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
