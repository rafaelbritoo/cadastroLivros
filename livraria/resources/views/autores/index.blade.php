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
                    <th scope="col">ID</th>
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
                        <form action="{{ route('autor.destroy', ['autor' => $autor->codAu]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Deseja realmente apagar o autor {{ $autor->nome }} ?')">Apagar</button>
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
