<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

                    <h2 class="text-center text-2xl font-bold tracking-wide text-gray-800">Actualizar un empleado</h2>
                    <hr/>
                    <form 
        class=""
        action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Name:</label>
            <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="name" id="name" value="{{ $usuario->name }}">
        </div>

        <div>
            <label for="surname">Surname:</label>
            <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="surname" id="surname" value="{{ $usuario->surname }}">
        </div>

        <div>
            <label for="nickname">Nickname:</label>
            <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="nickname" id="nickname" value="{{ $usuario->nickname }}">
        </div>

        <div>
            <label for="name_org">Organizacion:</label>
            <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="name_org" id="name_org" value="{{ $usuario->name_org }}">
        </div>

        <div>
            <label for="email">Email:</label>
            <input class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" type="text" name="email" id="email" value="{{ $usuario->email }}">
        </div>

        <div class="col-6">
            <label for="roles">Roles:</label>
            @foreach ($roles as $rol)
                <div class="mb-3 row">
                    <div class="col-sm-3">
                            @if($usuario->hasRole($rol->name))
                            <input type="checkbox" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" id="roles" name="roles[]" value={{ $rol->id }} checked> <label for="products" class="col-sm-2 col-form-label fw-bold">{{ $rol->name }}</label>
                            @else
                            <input type="checkbox" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" id="roles" name="roles[]" value={{ $rol->id }}> <label for="products" class="col-sm-2 col-form-label fw-bold">{{ $rol->name }}</label>
                            @endif
                    </div>
                </div>
            @endforeach
          </div>

        <div>
            <button class="bg-pink-600 hover:bg-pink-700 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl transition duration-150 uppercase" type="submit">Actualizar empleado</button>
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

        @if(session('success'))
            <div class="alert alert-danger">
                {{ session('success') }}
            </div>
        @endif

    </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>