<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

<body class="overflow-hidden">
    <div id="content" class="fadeIn">

        <header>
            <div id="header" class="w-full py-4 text-white">
                <div class="ml-6">
                    <div class="text-center md:text-left">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/logo.png') }}" class="w-16 py-2 m-auto md:m-0" alt="logo"></a>
                    </div>

                    <div class="mt-1 text-center md:text-lg md:text-left">
                        <h3 class="font-default md:ml-0.5 -ml-4 font-semibold">
                            Notes chiffrées et autodestructrices <img src="{{ asset('assets/lock.png') }}"
                                class="inline w-5 h-5 ml-1 -mt-1.5" alt="leaficon">
                        </h3>
                    </div>
                </div>
            </div>
        </header>
        <main class="text-center md:ml-4 md:text-left">
            @if (!isset($note))
                <div class="text-red-500 py-2 text-xl px-2 md:px-0 md:ml-2.5">
                    <p class="font-default">
                        Désolé cette note n'existe pas, elle a déjà été lue ou sa date d'expiration est dépassée
                    </p>
                </div>
            @else
                <form action="{{ route('note.decrypt', $note->slug) }}" method="POST">
                    @csrf
                    <div class="ml-2.5 mt-10">
                        @if ($password)
                            <h2 class="px-2 text-xl font-bold text-white font-default md:px-0">Entrez le mot de passe de
                                la
                                note</h2>
                            <input type="password" placeholder="Ici" required
                                class="rounded-sm focus:outline-none font-default-light text-white px-2 py-0.5 w-64 mt-2"
                                style="background-color : #282828" name="decrypt_password">
                            <br>
                            <br>
                            @if ($errors->any())
                                <div class="py-2 text-red-500">
                                    <p class="font-default">
                                        {{ $errors->first() }}
                                    </p>
                                </div>

                            @endif
                        @endif
                        <input type="submit" style="background-color : #282828"
                            class="text-center focus:outline-none text-white align-middle px-4 font-default font-semibold cursor-pointer pt-1.5 pb-2 text-xl rounded"
                            value="Déchiffrer" onclick="disableButton(this)">
                        <p class="px-2 mt-8 text-white font-default md:px-0">Après avoir déchiffré cette note, elle
                            sera
                            supprimée de
                            la
                            base
                            de donnée</p>

                    </div>
                </form>
            @endif
        </main>
    </div>

    <script>
        function disableButton(e) {
            setTimeout(function() {
                e.disabled = true;
            }, (100));
        }
    </script>
</body>

</html>
