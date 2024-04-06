<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/vistaModal.css'])
</head>
<body>
    <div class="bg-gray-200 w-full min-h-screen flex items-center justify-center">
            <div class="w-full py-8">
                <div class="flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                    </svg>
                    
                </div>
                <div class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-8 mx-auto px-16 py-8 rounded-lg shadow-2xl">

                    <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Agregar producto</h2>
                    <hr/>
                    <form action="{{ route('productos.store') }}" method="POST">
                        @csrf
                
                        <div>
                            <label for="name_producto">Nombre del producto:</label>
                            <input type="text" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" name="name_producto" id="name_producto">
                        </div>
                
                        <div>
                            <label for="descrip_prod">Descripción:</label>
                            <textarea name="descrip_prod" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" id="descrip_prod"></textarea>
                        </div>
                
                        <div>
                            <label for="stock">Stock:</label>
                            <input type="number" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" name="stock" id="stock">
                        </div>
                
                        <div>
                            <label for="precio">Precio:</label>
                            <input type="number" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" step="any" name="precio" id="precio">
                        </div>
                
                        <div>
                            <label for="categoria_id">Categoría:</label>
                            <select name="categoria_id" id="categoria_id" required>
                                @foreach ($categorias as $categoria)
                                    <option class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" value="{{ $categoria->id }}">{{ $categoria->name_cat }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div>
                            <button type="submit" class="bg-pink-600 hover:bg-pink-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Enviar</button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="erroneo">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                    
                    
                    </div>
                </div>
            </div>
        </div>
</body>
</html>