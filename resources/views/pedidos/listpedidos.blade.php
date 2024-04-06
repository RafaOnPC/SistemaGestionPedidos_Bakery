<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Pedidos - MouseCake</title>
</head>
<body>
    <p>Lista de Pedidos</p>
    <p><a href="{{ route('pedidos.createpedido') }}">Agregar un Pedido Nuevo</a></p>
    <table>    
    <thead>
            <tr>
                <th>Direccion</th>
                <th>Estado del Pedido</th>
                <th>Fecha de creacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido as $ped)
                <tr>
                    <td>{{ $ped->dir_envio }}</td>
                    <td>{{ $ped->estado_ped }}</td>
                    <td>{{ $ped->date_ped}}</td>
                    <td>
                        <a href="{{ route('pedidos.edit', $ped->id) }}">Editar</a>
                    <td>
                        <form action="{{ route('pedidos.destroy', $ped->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    
                        <button type="submit">Eliminar</button>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>