<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Livros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<h2>Catálogo de Livros</h2>
<table>
    <thead>
    <tr>
        <th>Código</th>
        <th>Título</th>
        <th>Editora</th>
        <th>Edição</th>
        <th>Ano de Publicação</th>
        <th>Autor</th>
        <th>Assunto</th>
        <th>Valor</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($livros as $livro)
        <tr>
            <td>{{ $livro->codigo_livro }}</td>
            <td>{{ $livro->livro_titulo }}</td>
            <td>{{ $livro->editora }}</td>
            <td>{{ $livro->edicao }}</td>
            <td>{{ $livro->ano_publicacao }}</td>
            <td>{{ $livro->autor_nome }}</td>
            <td>{{ $livro->assunto_nome }}</td>
            <td>{{ $livro->valor_formatado }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
