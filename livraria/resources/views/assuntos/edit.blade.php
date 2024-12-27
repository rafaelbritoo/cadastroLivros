@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Editar assunto</span>
            <span class="ms-auto d-sm-flex flex-row">
                <a class="btn btn-info btn-sm me-1" href="{{ route('assunto.index') }}">Listar assuntos</a>
            </span>
        </div>


        <div class="card-body">
            <x-alert />

            <form action="{{ route('update-assunto', ['assunto' => $assunto->codAs]) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="nome" class="form-label">Nome:</label>
                    <input class="form-control" maxlength="20"  id="name" type="text" name="descricao" placeholder="Descrição do assunto" value="{{ old('descricao', $assunto->descricao) }}" >
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                </div>
            </form>
        </div>
    </div>

@endsection
