<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

    <!-- Scripts -->
    @vite(['resources/css/admin.css'])

<body>
    @php
        use App\Models\User;
    @endphp
    <div class="header">
        <header>
            <ul>
                <li class="perfil">
                    <img src="img/user.png" alt="">
                    @if (auth()->check())
                        <h1>Bienvenido, {{ auth()->user()->name }}</h1>
                    @endif
                </li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
                <li class="logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="img/logopasteleria.png" alt="LogoPrincipal">
                    </a>
                </li>
            </ul>
        </header>
    </div>

    <div class="container">
        <div class="row1">
            @can('pedidos.listpedidos')
            <div class="partes">
                <div class="image">
                    <img src="img/gestion_pedidos.png" alt="">
                </div>
                <div class="title">
                    <form class="flex flex-col pt-3 md:pt-8" action="{{ route('pedidos.listpedidos') }}" method="GET">
                        @csrf 
                        <button type="submit" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Gestion de Pedidos</button>
                      </form>
                </div>
            </div>
            @endcan
            
            @can('productos.listproductos')
            <div class="partes">
                <div class="image">
                    <img src="img/stock_pasteleria.png" alt="">
                </div>
                <div class="title">
                    <form class="flex flex-col pt-3 md:pt-8" action="{{ route('productos.listproductos') }}" method="GET">
                        @csrf 
                        <button type="submit" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Gestion de Productos</button>
                      </form>
                </div>
            </div>
            @endcan
        </div>

        <div class="row2">
            @can('usuarios.list')
            <div class="partes">
                <div class="image">
                    <img src="img/lista_pedidos.png" alt="">
                </div>
                <div class="title">
                    <form class="flex flex-col pt-3 md:pt-8" action="{{ route('usuarios.list') }}" method="GET">
                        @csrf 
                        <button type="submit" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Gestion de Empleados</button>
                      </form>
                </div>
            </div>
            @endcan
        </div>


    </div>
</body>

</html>