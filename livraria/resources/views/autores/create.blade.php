@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Cadastra autor</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('autor.index') }}">Listar autores</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <form action="{{ route('store-autor') }}" method="POST" class="row g-3">
                @csrf
                @method('POST')

                <div class="col-md-12">
                    <label for="nome" class="form-label">Nome:</label>
                    <input class="form-control" maxlength="40" id="name" type="text" name="nome" placeholder="Nome do autor"><br><br>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
