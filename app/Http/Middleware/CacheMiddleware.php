<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class CacheMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the cached data exists
        $data = Cache::get('some_key');

        if (!$data) {
            // Retrieve and cache the data
            $data = SomeModel::all();
            Cache::put('some_key', $data, 60); // Cache for 60 minutes
        }

        // Add data to the request for use in controllers or views
        $request->merge(['cached_data' => $data]);

        return $next($request);
    }
}
