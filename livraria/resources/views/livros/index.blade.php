@extends('layouts.admin')

@section('content')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header hstack gap-7">
            <span>Livraria</span>
            <span class="ms-auto">
                <a class="btn btn-success btn-sm" href="{{ route('livro.create') }}">Cadastrar livro</a>
            </span>
        </div>

        <div class="card-body">
            <x-alert />
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Editora</th>
                    <th scope="col">Edição</th>
                    <th scope="col">Ano de publicação</th>
                    <th scope="col">Valor</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

            @forelse($livros as $livro)
                <tr>
                    <th>{{ $livro->codl }}</th>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->editora }}</td>
                    <td>{{ $livro->edicao }}</td>
                    <td>{{ $livro->anoPublicacao }}</td>
                    <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('livro.show', ['livro' => $livro->codl]) }}"  class="btn btn-primary btn-sm"> Visualizar livro</a>
                        <a href="{{ route('livro.edit', ['livro' => $livro->codl]) }}"  class="btn btn-warning btn-sm"> Editar livro</a>
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
