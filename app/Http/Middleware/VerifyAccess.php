<?php

namespace App\Http\Middleware;

use Closure;
use Dcblogdev\MsGraph\Models\MsGraphToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerifyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validate_access = MsGraphToken::where('user_id', Auth::user()->id)->first();
        if($validate_access)
        {
            return $next($request);
        }
        else
        {
            Auth::logout();
            Session::flush();

            return redirect('login');
        }
    }
}
