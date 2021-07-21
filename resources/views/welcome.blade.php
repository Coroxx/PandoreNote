<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <title>PandoreNote - Notes chiffrées</title>
</head>


<body class="" style="background-color : #1d1d1d">
    <div id="content fadeIn">


        <header>
            <div id="header" class="py-4 w-full text-white">
                <div class="ml-6">
                    <div class="text-center md:text-left">
                        <h1 class="inline -ml-4 md:ml-0 font-default font-extrabold lg:text-5xl text-2xl"><a
                                href="{{ route('home') }}" class="cursor-pointer">PandoreNote</a>
                        </h1>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="lg:h-12 lg:w-12 w-8 h-8 -ml-0.5 -mt-4 lg:-mt-7 inline" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>

                    <div class="mt-1 md:text-lg md:text-left text-center">
                        <h3 class="font-default md:ml-0.5 -ml-4 font-semibold">
                            Notes chiffrées et autodestructrice <img src="{{ asset('assets/leaf.png') }}"
                                class="inline -mt-2 w-6 h-6" alt="leaficon">
                        </h3>
                    </div>
                </div>
            </div>
        </header>
        <style>
            *::-webkit-scrollbar {
                display: none;
            }

        </style>
        <main class="md:ml-4 md:text-left text-center">
            <form action="{{ route('note.create') }}" method="POST">
                @csrf
                @if (session('success'))
                    <div class="text-green-500 py-2">
                        <p class="font-default">
                            Succès ! Voici le lien de la note : {{ session('success') }}
                        </p>
                    </div>
                @endif
                <div class="text-white text-lg">
                    <textarea required name="text" style="background-color : #585858"
                        class="px-4 focus:outline-none py-2 rounded resize-none w-11/12 h-96 font-semibold"
                        style="font-family: 'Source Sans Pro', sans-serif;">{{ old('text') }}</textarea>

                </div>
                @error('text')
                    <div class="text-red-500 py-2">
                        <p class="font-default">
                            {{ $message }}
                        </p>
                    </div>
                @enderror

                <div class="mt-4">
                    <label for="password_input" class="px-2 md:px-0 font-default font-semibold text-lg text-white">Mot
                        de passe
                        (Il
                        sera
                        obligatoire
                        lors du
                        déchiffrement de la
                        note)
                    </label>
                    <br>

                    <input type="text" required name="encrypt_password"
                        class="text-white px-2 font-default focus:outline-none py-1 mt-2 rounded-sm"
                        style="background-color : #585858" id="password_input">
                    @error('encrypt_password')
                        <div class="text-red-500 py-2">
                            <p class="font-default">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror

                </div>
                <div id="submit" class="mt-12 text-white">
                    <input type="submit" style="background-color : #585858"
                        class="text-center mb-2 focus:outline-none align-middle px-4 font-default font-semibold cursor-pointer pt-1.5 pb-2 text-2xl rounded"
                        value="Créer">
                </div>
            </form>
        </main>
    </div>
</body>

</html>
