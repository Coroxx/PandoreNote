<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function indexAbout()
    {
        return view('about');
    }

    public function create()
    {
        return view('new-note');
    }



    public function store()
    {
        request()->validate(
            [
                'text' => 'string|required|max:20000',
                'encrypt_password' => 'string|min:6|max:100|nullable',
            ],
            [
                'text.required' => 'Ce champ est obligatoire',
                'text.string' => 'Le texte est vide ou une une erreur est survenue',
                'text.max' => 'La limite est de 20 000 caractères.',
                'encrypt_password.string' => 'Désolé une erreur est survenue',
                'encrypt_password.min' => 'Le mot de passe doit faire au moins 6 caractères',
                'encrypt_password.max' => 'Le mot de passe ne peux pas faire plus de 100 caractères, mollo l\'asticot !'
            ]
        );

        $text = Crypt::encryptString(request()->text);

        $slug = Str::slug(Str::random(5));

        if (Note::where('slug', $slug)->get()->isNotEmpty()) {
            $notcomplete = true;
            while ($notcomplete) {
                $slug = Str::slug(Str::random(5));
                if (Note::where('slug', $slug)->get()->isNotEmpty()) {
                    continue;
                } else {
                    $notcomplete = false;
                }
            }
        }

        if (request()->expiration_date !== 'never') {
            switch (request()->expiration_date) {
                case '1_hour':
                    $expiration_date = date_format(now()->addHours(1), 'Y-m-d H:i:s');
                    break;
                case '1_day':
                    $expiration_date = date_format(now()->addDays(1), 'Y-m-d H:i:s');
                    break;
                case '1_month':
                    $expiration_date = date_format(now()->addMonths(1), 'Y-m-d H:i:s');
                    break;
                case '1_week':
                    $expiration_date = date_format(now()->addWeeks(1), 'Y-m-d H:i:s');
                    break;
            }
        } else {
            $expiration_date = null;
        }


        if (request()->encrypt_password) {
            $password = Hash::make(request()->encrypt_password);
        } else {
            $password = 'none';
        }

        Note::create([
            'text' => $text,
            'expiration_date' => $expiration_date,
            'password' => $password,
            'slug' => $slug,
        ]);

        $link = route('home') . '/' . 'note/' . $slug;

        return back()->with(['success' => $link]);
    }

    public function show($slug)
    {
        $note = Note::where('slug', $slug)->get();

        if ($note->isEmpty()) {
            return view('password-note');
        } else {
            $note = $note->first();

            if ($note->expiration_date && $note->expiration_date < now()) {
                $note->delete();
                return view('password-note');
            }

            $note->password === "none" ? $password = false :  $password = true;
        }
        return view('password-note', compact('note', 'password'));
    }

    public function decrypt($slug)
    {
        request()->validate([
            'decrypt_password' => 'string|max:100'
        ], [
            'decrypt_password.string' => 'Le champ est vide ou une erreur est survenue',
            'decrypt_password.max' => 'Le mot de passe ne peut pas faire plus de 100 caractères'
        ]);

        $note = Note::where('slug', $slug)->get();


        if ($note->isEmpty()) {
            return back()->withErrors(['404' => 'Désolé cette note n\'existe pas ou elle a déjà été lue']);
        } else {
            $note = $note->first();
        }

        if ($note->password !== "none") {
            if (Hash::check(request()->decrypt_password, $note->password)) {
                $note->text = Crypt::decryptString($note->text);
            } else {
                return back()->withErrors(['bad_password' => 'Mot de passe incorrect']);
            }
        } else {
            $note->text = Crypt::decryptString($note->text);
        }

        $note->delete();

        return view('show-note', compact('note'));
    }
}