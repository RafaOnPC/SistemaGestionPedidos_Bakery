<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Formulario de Pedidos</title>
</head>
<body>
    <main class="container">
    <h1>Agregar pedidos</h1>

        <form 
        class=""
        action="{{ route('pedidos.store') }}" method="POST">
        @csrf

        <div>
            <label for="dir_envio">Direccion de Envio:</label>
            <input class="form-control" type="text" name="dir_envio" id="dir_envio">
        </div>

        <div class="col-3">
            <label for="estado_ped">Estado del Pedido:</label>
            <select class="form-select" name="estado_ped" id="estado_ped">
                <option value="E">En proceso</option>
                <option value="P">Pendiente</option>
                <option value="F">Finalizado</option>
              </select>
          </div>

          <div class="col-3">
            <label for="date_ped">Fecha del pedido:</label>
            <input class="form-control" type="date" id="date_ped" name="date_ped">
          </div>

          <div class="col-4">
            <label class="form-label" for="user_id">Usuario</label>
            <select class="form-select" name="user_id" id="user_id" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

          <div class="col-6">
            <label for="products">Productos:</label>
            @foreach ($productos as $product)
                <div class="mb-3 row">
                    <label for="products" class="col-sm-2 col-form-label fw-bold">{{ $product->name_producto }}</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="product_{{ $product->id }}"  value="0" required>
                    </div>
                </div>
            @endforeach
          </div>
          <div>
            <button class="btn btn-primary my-2" type="submit">Agregar Pedido</button>
        </div>
    </form>
    </main>

    
</body>
</html>