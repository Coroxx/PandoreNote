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
            <form action="{{ route('note.decrypt', $note->slug) }}" method="POST">
                @csrf
                <div class="ml-2 mt-10 text-white md:text-left text-center">
                    <div class="w-full">
                        <p class="break-words pl-1.5 pr-8 font-default whitespace-pre-line">
                            {{ $note->text }}
                        </p>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
