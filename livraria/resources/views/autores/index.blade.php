@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Lista de autores</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('autor.create') }}">Cadastrar autor</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

            @forelse($autores as $autor)
                <tr>
                    <th>{{ $autor->codAu }}</th>
                    <td>{{ $autor->nome }}</td>
                    <td class="text-center">
                        <a href="{{ route('autor.show', ['autor' => $autor->codAu]) }}"  class="btn btn-primary btn-sm"> Visualizar autor</a>
                        <a href="{{ route('autor.edit', ['autor' => $autor->codAu]) }}"  class="btn btn-warning btn-sm"> Editar autor</a>
                        <form class="d-inline" action="{{ route('autor.destroy', ['autor' => $autor->codAu]) }}" method="POST" id="delete-form-{{ $autor->codAu }}">
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
