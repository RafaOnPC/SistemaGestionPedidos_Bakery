<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar un producto - MouseCake</title>
</head>
<body>
    <h1>Editar producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name_producto">Nombre del producto:</label>
            <input type="text" name="name_producto" id="name_producto" value="{{ $producto->name_producto }}" required>
        </div>

        <div>
            <label for="descrip_prod">Descripción:</label>
            <textarea name="descrip_prod" id="descrip_prod" required>{{ $producto->descrip_prod }}</textarea>
        </div>

        <div>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" value="{{ $producto->stock }}" required>
        </div>

        <div>
            <label for="precio">Precio:</label>
            <input type="number" step="any" name="precio" id="precio" value="{{ $producto->precio }}" required>
        </div>

        <div>
            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->name_cat }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>
</html>