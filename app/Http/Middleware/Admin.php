<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Session::has('adminSession')))
        {
            return redirect('admin');
        }else{
            $admin = \App\Admin::where('username', Session::get('adminSession'))->first();
            Session::put('adminDetails', $admin);
            $currentPath = Request::path();
            $adminDeatil = Session::get('adminDetails');
            if ($currentPath == 'admin/product' && $adminDeatil->product_access == 0)
            {
                return redirect('admin/dashboard')->with('warning', 'You are not allow');
            }
            if ($currentPath == 'admin/category' && $adminDeatil->category_access == 0)
            {
                return redirect('admin/dashboard')->with('warning', 'You are not allow');
            }
            if ($currentPath == 'admin/order' && $adminDeatil->order_access == 0)
            {
                return redirect('admin/dashboard')->with('warning', 'You are not allow');
            }
            if ($currentPath == 'admin/coupon' && $adminDeatil->coupon_access == 0)
            {
                return redirect('admin/dashboard')->with('warning', 'You are not allow');
            }
        }
        return $next($request);
    }
}
