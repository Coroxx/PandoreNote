<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Call;
use Route;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DeviceDetector\DeviceDetector;
use Stevebauman\Location\Facades\Location;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

// OPTIONAL: Set version truncation to none, so full versions will be returned
// By default only minor versions will be returned (e.g. X.Y)
// for other options see VERSION_TRUNCATION_* constants in DeviceParserAbstract class
AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

class AnalyticMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get userAgent

        $user_agent = new DeviceDetector($request->header('User-Agent'));
        $user_agent->parse();

        // Grabbing IP behind a possible cloudfare proxy
        try {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } catch (\Throwable $th) {
            $ip = request()->ip();
        }

        // Get country by IP

        if ($position = Location::get($ip)) {
            $country = $position->countryName;
        }

        // Send data to the database

        if (!$user_agent->isBot()) {
            Call::create([
                'user_agent' => $request->header('User-Agent'),
                'ip' => request()->ip(),
                'session_id' => session()->getId(),
                'country' => isset($country) ? $country : null,
                'device' => $user_agent->getDeviceName(),
                'route' => Route::getCurrentRoute()->getName()
            ]);
        }



        return $next($request);
    }
}