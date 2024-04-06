<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Login Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>
</head>
<body class="bg-white-400 font-family-karla h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <img class="object-cover w-20 h-100" src="img/logopasteleria.png">
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <h1 class="text-center text-3xl font-bold">Welcome To MouseCake</h1>
                <p class="text-center text-2xl">Somos una pasteleria con años de experiencia haciendo increibles postres</p>
                <form class="flex flex-col pt-3 md:pt-8" action="{{ route('dashboard') }}" method="GET">
                    @csrf 
                    <button type="submit" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Inicia Sesion</button>
                  </form>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl bg-pink-800">
            <img class="object-cover w-full h-screen hidden md:block" src="img/image1.png">
        </div>
    </div>

</body>
</html>