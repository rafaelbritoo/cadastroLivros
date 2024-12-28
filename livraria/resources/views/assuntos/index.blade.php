@extends('layouts.admin')


@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Lista de assuntos</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('assunto.create') }}">Cadastrar assunto</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Descrição</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

            @forelse($assuntos as $assunto)
                <tr>
                    <th>{{ $assunto->codAs }}</th>
                    <td>{{ $assunto->descricao }}</td>
                    <td class="text-center">
                        <a href="{{ route('assunto.show', ['assunto' => $assunto->codAs]) }}"  class="btn btn-primary btn-sm"> Visualizar assunto</a>
                        <a href="{{ route('assunto.edit', ['assunto' => $assunto->codAs]) }}"  class="btn btn-warning btn-sm"> Editar assunto</a>
                        <form class="d-inline" action="{{ route('assunto.destroy', ['assunto' => $assunto->codAs]) }}" method="POST" id="delete-form-{{ $assunto->codAs }}">
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
                    </td>
                </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('livro/assets/js/aviso-delete.js') }}"></script>
