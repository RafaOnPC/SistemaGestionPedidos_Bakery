<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Productos - MouseCake</title>
</head>
<body>
    <p>Lista de Productos</p>

    <p><a href="{{ route('productos.createproducto') }}">Agregar un Producto Nuevo</a></p>

    <table>    
    <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($producto as $product)
                <tr>
                    <td>{{ $product->name_producto }}</td>
                    <td>{{ $product->descrip_prod }}</td>
                    <td>{{ $product->precio}}</td>
                    <td>
                        <a href="{{ route('productos.edit', $product->id) }}">Editar</a>
                    <td>
                        <form action="{{ route('productos.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>