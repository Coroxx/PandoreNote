<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/logo-full.png') }}" type="image/x-icon">
    <meta name="description" content="PandoreNote, des notes chiffrées et autodestructrice">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>PandoreNote - Notes chiffrées</title>
</head>

<style>
    @font-face {
        font-family: Outfit;
        src: url("fonts/OutFit-ExtraBold.ttf") format("truetype");
    }

    @font-face {
        font-family: Outfit-regular;
        src: url('fonts/Outfit-Regular.ttf') format("truetype");
    }

    *::-webkit-scrollbar {
        display: none;
    }

    html,
    body {
        height: 100%;
        background-color: #1C1C1C;
    }

    .font-default {
        font-family: Outfit, Arial;
        font-weight: 800;
        font-style: normal;
    }

    .font-default-light {
        font-family: Outfit-regular, Arial;
        font-weight: 400;
        font-style: normal;
    }

</style>


<body class="text-white fadeIn font-default">
    <header class="md:ml-8">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" class="w-16 py-2 m-auto md:m-0" alt="logo"></a>
        <div class="mt-4 text-center md:text-left">

            <span class="px-2 text-xl">La note sera à usage unique et chiffrée au sein de notre base de
                donnée</span>
        </div>
    </header>
    <main class="mt-4 text-center md:ml-8 md:text-left">
        <form action="{{ route('note.create') }}" method="POST">
            @csrf
            @if (session('success'))
                <div class="pb-2 ml-2 text-green-500">
                    <p class="font-default">
                        Succès ! Voici le lien de la note : {{ session('success') }}
                    </p>
                </div>
            @endif
            <textarea name="text" id="text" placeholder="Écrivez ici"
                class="w-9/12 p-4 rounded-lg resize-none font-default-light focus:outline-none h-80"
                style="background-color : #282828"></textarea>
            @error('text')
                <div class="py-2 text-red-500">
                    <p class="font-default">
                        {{ $message }}
                    </p>
                </div>
            @enderror
            <div class="md:w-9/12 md:flex">
                <div class="md:flex-1">
                    <div class="mt-4">
                        <label class="px-2 text-xl" for="expiration_date">Temps d'expiration</label>
                        <br>
                        <select name="expiration_date" id="expiration_date"
                            class="px-2 py-2 m-auto my-2 ml-1.5 text-lg text-white rounded outline-none appearance-none font-default-light lg:py-1 lg:my-2 focus:outline-none"
                            style="background-color : #282828">
                            <option value="never" selected>Jamais</option>
                            <option value="1_hour">Une heure</option>
                            <option value="1_day">Un jour</option>
                            <option value="1_week">Une semaine</option>
                            <option value="1_month">Un mois</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="password_input" class="px-2 text-lg text-white font-default">Mot
                            de passe (Optionnel)
                        </label>

                        <br>

                        <input type="text" name="encrypt_password"
                            class="px-2 py-1 ml-1.5 mt-2 text-white rounded-sm font-default-light focus:outline-none"
                            style="background-color : #282828" id="password_input">
                        @error('encrypt_password')
                            <div class="py-2 text-red-500">
                                <p class="font-default">
                                    {{ $message }}
                                </p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="-mt-4 text-center md:mt-0 md:flex-1">
                    <input type="submit" style="background-color : #282828"
                        class="text-center mb-2 mt-12 focus:outline-none align-middle px-4 font-default font-semibold cursor-pointer pt-1.5 pb-2 text-2xl rounded"
                        value="Créer">
                </div>
            </div>
        </form>
    </main>
    <footer class="w-full pb-2 md:mt-4">
        <div>
            <div class="ml-4 md:text-center md:ml-0">
                <p><a href="https://github.com/Coroxx/PandoreNote" target="_blank" rel="noopener noreferrer">Github -
                        2.0 par Corox</a></p>
            </div>
            <div class="float-right mr-4 -mt-6">

                <p> <a href="{{ route('about') }}">En savoir
                        plus</a></p>
            </div>

        </div>
    </footer>
</body>


</html>
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="PandoreNote, des notes chiffrées et autodestructrice">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <title>PandoreNote - Notes chiffrées</title>
</head>


<body style="background-color : #1d1d1d">
    <div class="absolute w-full h-screen top-44">
        <div id="content" class="fadeIn">

            <header>
                <div id="header" class="w-full py-4 text-white">
                    <div class="ml-6">
                        <div class="text-center md:text-left">
                            <h1 class="inline -ml-4 text-2xl font-extrabold md:ml-0 font-default lg:text-5xl"><a
                                    href="{{ route('home') }}" class="cursor-pointer">PandoreNote</a>
                            </h1>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="lg:h-12 lg:w-12 w-8 h-8 -ml-0.5 -mt-4 lg:-mt-7 inline" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>

                        <div class="mt-1 text-center md:text-lg md:text-left">
                            <h3 class="font-default md:ml-0.5 -ml-4 font-semibold">
                                Notes chiffrées et auto-destructrices <img src="{{ asset('assets/leaf.png') }}"
                                    class="inline w-6 h-6 -mt-2" alt="leaficon">
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
            <main class="text-center md:ml-4 md:text-left">
                <form action="{{ route('note.create') }}" method="POST">
                    @csrf
                    @if (session('success'))
                        <div class="py-2 text-green-500">
                            <p class="font-default">
                                Succès ! Voici le lien de la note : {{ session('success') }}
                            </p>
                        </div>
                    @endif
                    <div class="text-lg text-white">
                        <textarea required name="text" style="background-color : #585858"
                            class="w-11/12 px-4 py-2 font-semibold rounded resize-none focus:outline-none h-96"
                            style="font-family: 'Source Sans Pro', sans-serif;">{{ old('text') }}</textarea>

                    </div>
                    @error('text')
                        <div class="py-2 text-red-500">
                            <p class="font-default">
                                {{ $message }}
                            </p>
                        </div>
                    @enderror

                    <div class="mt-4">
                        <label for="password_input"
                            class="px-2 text-lg font-semibold text-white md:px-0 font-default">Mot
                            de passe (Optionnel)
                        </label>
                        <br>

                        <input type="text" name="encrypt_password"
                            class="px-2 py-1 mt-2 text-white rounded-sm font-default focus:outline-none"
                            style="background-color : #585858" id="password_input">
                        @error('encrypt_password')
                            <div class="py-2 text-red-500">
                                <p class="font-default">
                                    {{ $message }}
                                </p>
                            </div>
                        @enderror

                    </div>
                    <div class="mt-4">
                        <label for="expiration_datet"
                            class="px-2 text-lg font-semibold text-white md:px-0 font-default">
                            Temps d'expiration <img class="inline w-6 h-6 -mt-1"
                                src="{{ asset('assets/sablier.png') }}" alt="">
                        </label>
                        <br>
                        <div class="mt-2"></div>
                        <select name="expiration_date" id="expiration_date"
                            class="px-2 py-1 m-auto my-2 text-white rounded outline-none appearance-none font-default lg:py-0 lg:my-0 focus:outline-none"
                            style="background-color : #585858">
                            <option value="never" selected>Jamais</option>
                            <option value="1_hour">Une heure</option>
                            <option value="1_day">Un jour</option>
                            <option value="1_week">Une semaine</option>
                            <option value="1_month">Un mois</option>
                        </select>

                    </div>
                    <div id="submit" class="mt-12 text-white">
                        <input type="submit" style="background-color : #585858"
                            class="text-center mb-2 focus:outline-none align-middle px-4 font-default font-semibold cursor-pointer pt-1.5 pb-2 text-2xl rounded"
                            value="Créer">
                    </div>
                </form>
            </main>
            <footer id="footer" class="w-full mt-8 mb-4 text-center text-white font-default">
                <p>Fait avec ❤️ par <a href="https://github.com/Coroxx">Corox</a></p>
                <p>PandoreNote {{ $version }} - <a class="underline"
                        href="https://github.com/Coroxx/pandorenote">Github</a></p>
            </footer>
        </div>
    </div>
</body>

</html> --}}