<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class Permission {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user      = Auth::user();
        $user_type = $user->role_id;
        if ($user_type != 1) {
            $route_name = \Request::route()->getName();

            /** If User Type = User **/
            if ($route_name != '' && $user_type == 'user') {

                if (explode(".", $route_name)[1] == "update") {
                    $route_name = explode(".", $route_name)[0] . ".edit";
                } else if (explode(".", $route_name)[1] == "store") {
                    $route_name = explode(".", $route_name)[0] . ".create";
                }
                if (!has_permission($route_name)) {
                    if (!$request->ajax()) {
                        return back()->with('error', ('Permission denied !'));
                    } else {
                        return new Response('<h4 class="text-center red">' . ('Permission denied !') . '</h4>');
                    }
                }
            }

        }

        return $next($request);
    }
}
