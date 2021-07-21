<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function create()
    {
        request()->validate(
            [
            'text' => 'string|required|max:20000',
            'encrypt_password' => 'string|min:6|required|max:100',
        ],
            [
                'text.required' => 'Ce champ est obligatoire',
                'text.string' => 'Le texte est vide ou une une erreur est survenue',
                'text.max' => 'La limite est de 20 000 caractères.',
                'encrypt_password.string' => 'Désolé une erreur est survenue',
                'encrypt_password.required' => 'Ce champ est obligatoire',
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
        
        Note::create([
            'text' => $text,
            'password' => Hash::make(request()->encrypt_password),
            'slug' => $slug,
        ]);

        $link = 'https://pandorenote.tk/note/' . $slug ;

        return back()->with(['success' => $link]);
    }

    public function show($slug)
    {
        $note = Note::where('slug', $slug)->get();

        if ($note->isEmpty()) {
            return view('password-note');
        } else {
            $note = $note->first();
        }

        return view('password-note', compact('note'));
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
        // dd($slug);


        if ($note->isEmpty()) {
            return back()->withErrors(['404' => 'Désolé cette note n\'existe pas ou elle a déjà été lue']);
        } else {
            $note = $note->first();
        }

        if (Hash::check(request()->decrypt_password, $note->password)) {
            $note->text = Crypt::decryptString($note->text);
        } else {
            return back()->withErrors(['bad_password' => 'Mot de passe incorrect']);
        }

        $note->delete();

        return view('show-note', compact('note'));
    }
}
