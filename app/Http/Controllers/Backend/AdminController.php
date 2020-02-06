<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function index()
    {
       /* if (Session::has('adminSession')) // we will access all of admin dashboard
        {
            return view('backend.dashboard.index');
        }else{
            return redirect()->route('admin.login')->with('error', 'Please login to access');
        }*/
        return view('backend.dashboard.index');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $admin = Admin::where(['username' => $request->username, 'password' => md5($request->password), 'status' => 1])->count();
            if ($admin){
                Session::put('adminSession', $request->username); // after login we will  check admin or not*/
                return redirect()->route('admin.home')->with('success', 'Your are now login');
            }else{
               return redirect()->route('admin.login')->with('error', 'Invalide username or password');
            }
        }
        return view('backend.auth.login');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Logout success');
    }


    public function setting()
    {
        return view('backend.auth.setting');
    }

    public function checkPassword(Request $request)
    {
        $check = Admin::where(['username' => Session::get('adminSession'), 'password' => md5($request->currentPassword)])->count();
        if ($check == 1){
            echo "true";die();
        }else{
            echo "false";die();
        }
    }


    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($request->isMethod('post'))
        {
            $check = Admin::where(['username' => Session::get('adminSession'), 'password' => md5($request->current_password)])->count();

            if ($check == 1){

                 Admin::where(['username' => Session::get('adminSession')])->update(['password' => md5($request->password)]);
                return redirect()->back()->with('success', 'Password change successfully !');
            }else{

                return redirect()->back()->with('error', 'Incurrect Current Password');
            }
        }else{

            return redirect()->back()->with('error', 'Your request is not currect');
        }


    }




}
