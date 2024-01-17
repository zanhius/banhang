<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   AuthenticateCustomer
{
    /**
     * Handle an incoming request.
     *
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xác thực với guard 'customer'
        if (Auth::guard('customer')->check()) {
            return $next($request);
        }

        // Nếu không xác thực, thực hiện chuyển hướng
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->route('customer.login')->with('error', 'Bạn phải đăng nhập với tư cách là customer.');
    }
}
