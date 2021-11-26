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

<body class="" style="background-color : #1d1d1d">
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
                            Notes chiffrées et autodestructrice <img src="{{ asset('assets/lock.png') }}"
                                class="inline w-5 h-5 -mt-1.5 ml-1" alt="leaficon">
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
            <form action="{{ route('note.decrypt', $note->slug) }}" method="POST">
                @csrf
                <div class="mt-10 ml-2 text-center text-white md:text-left">
                    <div class="w-full">
                        <p class="break-words pl-1.5 pr-8 font-default-light whitespace-pre-line">
                            {{ $note->text }}
                        </p>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
