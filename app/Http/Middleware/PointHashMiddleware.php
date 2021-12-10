<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Point;

class PointHashMiddleware
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
        $point_id = null;
        if ($point = Point::where('hash', $request->hash)->first()) {
            $point_id = $point->id;
        }

        $request->attributes->add(['point_id' => $point_id, ]);

        return $next($request);
    }
}
