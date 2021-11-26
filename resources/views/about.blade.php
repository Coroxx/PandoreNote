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

<body class="overflow-hidden text-white">
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


                    <div class="mt-12">
                        <span class="text-2xl font-default">Comment sont stockées mes notes ?</span>
                        <p class="mt-4 font-default-light">Vos notes sont systématiquement chiffrées avec AES-256 au
                            sein
                            de notre
                            base de données, ce qui signifie que même l'auteur du site ne peut pas les lire !
                            <br>
                            NB : Ce chiffrement est <span class="font-default">utilisé par le gouvernement des
                                États-Unis</span> <a rel="noopener noreferrer"
                                href="https://fr.wikipedia.org/wiki/Advanced_Encryption_Standard" target="_blank"
                                rel="no" class="underline">Source</a>
                        </p>
                    </div>
                    <div class="mt-12">
                        <span class="text-2xl font-default">Est-il possible de savoir si une note a déjà été ouverte
                            ?</span>
                        <p class="pr-2 mt-4 font-default-light">Et bien non, contrairement aux autres alternatives,
                            PandoreNote ne stocke aucune information sur l'ouverture d'une note.
                            <br>
                            NB : Il n'est donc <span class="font-default"> pas
                                possible de savoir si une note a déjà existée </span> ou si elle a déjà été ouverte.
                        </p>

                    </div>
                    <div class="mt-12">
                        <span class="text-2xl font-default">PandoreNote peut-il ne stocker que des notes ? </span>
                        <p class="pr-2 mt-4 font-default-light">Des mises à jour arrivent bientôt, notamment pour
                            partager des images une seule fois !
                            <br>
                            NB : Il est probable qu'une <span class="font-default">application mobile </span>sorte.
                        </p>
                    </div>
                </div>
            </div>
        </header>
    </div>
</body>

</html>
