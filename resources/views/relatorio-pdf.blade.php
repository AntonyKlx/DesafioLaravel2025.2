<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatorio</title>

    <style>
        body {
            margin: 10px;
        }

        .table {
            width: 100%;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        th {
            font-size: 13px;
            padding: 10px;
        }

        td {
            padding-top: 5px;
        }

    </style>
</head>
<body>
    <h1>RELATORIO DE VENDAS</h1>
    <h4>Usuario: {{$usuarioLogado}}</h4>
    <p>{{$data}}</p>
        <div class="table">
            <table>
                    <tr>
                        <th>ID VENDA</th>
                        <th>PRODUTO</th>
                        <th>CATEGORIA</th>
                        <th>COMPRADOR</th>
                        <th>VENDEDOR</th>
                        <th>VALOR</th>
                        <th>DATA DA VENDA</th>
                    </tr>
                    <tbody>
                        @if ($vendas->count() === 0)
                            <tr>
                                <td class="py-5 text-white">Nenhuma venda encontrada</td>
                            </tr>
                        @endif
                        @foreach ($vendas as $venda)
                            <tr>
                                <td>{{ $venda->id }}</td>
                                <td>{{ $venda->produto->nome }}</td>
                                <td>{{ $venda->produto->categoria->nome}}</td>
                                <td>{{ $venda->comprador->name }}</td>
                                <td>{{ $venda->vendedor->name }}</td>
                                <td> R$ {{ $venda->valor }}</td>
                                <td>{{ $venda->data_venda }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>

</body>
</html>


