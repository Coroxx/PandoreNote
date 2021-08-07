<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    private function forarray($requests, $array, $string)
    {
        foreach ($requests as $object) {
            array_push($array, $object->$string);
        }

        return $array;
    }




    public function indexLang()
    {
        session()->has('locale') ? app()->setLocale(session()->get('locale')) : session()->put('locale', 'en');

        return redirect()->route('analytics', session()->get('locale'));
    }

    public function index($lang)
    {
        if ($lang != 'fr' && $lang != 'en') {
            return abort(404);
        }

        App::setLocale($lang);
        session()->put('locale', $lang);

        // Collecting unique user count

        $unique_users_today = Call::whereDate('created_at', Carbon::today())->distinct('session_id')->count();
        $unique_users_week = Call::whereDate('created_at', '>=', now()->subWeek(1))->distinct('session_id')->count();

        // Get requests by date 

        $today_requests = Call::whereDate('created_at', Carbon::today())->count();
        $week_requests = Call::whereDate('created_at', '>=', now()->subDays(7))->get();
        $month_requests = Call::whereDate('created_at', '>=', now()->subMonth(1))->get();


        // Collecting the most present country 

        $week_countries = [];

        $week_countries = $this->forarray($week_requests, $week_countries, 'country');
        $most_present_country = collect($week_countries)->filter()->countBy()->sortDesc()->keys();

        // Collecting the most present device 

        $week_devices = [];


        $week_devices = $this->forarray($week_requests, $week_devices, 'device');
        $most_present_device = collect($week_devices)->filter()->countBy()->sortDesc()->keys();

        // Collecting the

        $month_routes = [];

        $month_routes = $this->forarray($month_requests, $month_routes, 'route');
        $month_routes = collect($month_routes)->filter()->countBy()->sortDesc()->keys();

        // Most present route

        $most_visited_route = $month_routes->first();

        // Least visited url

        $no_visited_route = $month_routes->last();



        return view('analytics.index', compact('unique_users_today', 'today_requests', 'unique_users_week', 'month_routes', 'most_present_device', 'most_present_country', 'week_requests', 'most_visited_route', 'no_visited_route'));
    }


    public function loginIndex()
    {
        if (auth()->user()) {
            return redirect()->route('analytics.index');
        } else {
            return view('analytics.login');
        }
    }

    public function loginPost()
    {
        request()->validate([
            'username' => 'required|string|exists:users|string',
            'password' => 'required|min:6|max:24|string',
        ], [
            'username.string' => 'Une erreur est survenue, le champ est peut-être vide',
            'username.required' => 'Une erreur est survenue, le champ est peut-être vide',
            'username.exists' => 'Le nom d\'utilisateur n\'existe pas.',
            'password.min' => 'Le mot de passe fait au moins 6 caractères !',
            'password.max' => 'Le mot de passe fait maximum 24 caractères !',
            'password.string' => 'Une erreur est survenue, le champ est peut-être vide!',
        ]);

        $credentials = request()->only('username', 'password');

        if (Auth::attempt($credentials, true)) {
            request()->session()->regenerate();

            return redirect()->route('analytics.index');
        } else {
            return back()->withErrors(['bad_creds' => 'Identifiants incorrects']);
        }
    }
}