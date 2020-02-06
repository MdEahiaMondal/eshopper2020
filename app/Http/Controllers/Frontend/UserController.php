<?php

namespace App\Http\Controllers\Frontend;

use App\Country;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


    public function loginRegisterFormShow()
    {
        return view('frontend.pages.login_register');
    }


    public function RegisterStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pass' => 'required',
            'email' => 'required|unique:users,email',
        ]);
        $request['password'] = bcrypt($request->pass);

        User::create($request->except('_token','pass'));

        $messageData = [
            'email' => $request->email,
            'name' => $request->name,
            'code' => base64_encode($request->email)
        ];
        $email = $request->email;
    /*    // send to email
        Mail::send('frontend.mail.register', $messageData, function ($message) use($email){
            $message->to($email)->subject("Registration with E-Shopper-2020 Site.");
        });*/

        // send confirmation mail
        Mail::send('frontend.mail.confirmation', $messageData, function ($message) use($email){
            $message->to($email)->subject("Confirmation in your mail E-Shopper-2020 Site.");
        });

        return redirect()->back()->with('success', 'Please confirm your email');

     /* if (auth()->attempt(['email' =>$request->email, 'password' => $request->pass]))
        {
            Session::put('frontendUserEmail',$request->email);
            return redirect()->route('cart.index')->with('success', 'you are now login');
        }else{
            return redirect()->back()->with('error', 'Invalid email or password');
        }*/
    }


    public function emailConfirmation($email)
    {
        $email = base64_decode($email);
        $check = User::where('email', $email)->first();
        if ($check->status == 1)
        {
            return redirect()->route('login.register')->with('error', 'Your Account Alredy Activated!');
        }else{
            User::where('email', $email)->update(['status' => 1]);

            return redirect()->route('login.register')->with('success', 'Your Account  Activated!. you can now login');
        }
    }


    public function userLogout()
    {
        auth()->logout();
        Session::forget('frontendUserEmail'); // user redirection to other use middleware
        return redirect('/')->with('success', 'Your are now logout');
    }

    public function loginChack(Request $request)
    {
        $request->validate([
            'loginpassword' => 'required|min:8',
            'loginemail' => 'required|email',
        ]);

        if (auth()->attempt(['email' => $request->loginemail, 'password' => $request->loginpassword, 'status' => 1]))
        {
            Session::put('frontendUserEmail',$request->loginemail);
            return redirect()->route('cart.index')->with('success', 'you are now login');
        }else{
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function userProfileShow()
    {
        $countries = Country::all();
        return view('frontend.pages.user_profile', compact('countries'));
    }

    public function userProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.auth()->id(),
        ]);
        User::where('id', auth()->id())->update($request->except('_token'));
        return redirect()->back()->with('success', 'Profile updated success');
    }

    public function loginRegisterEmailCheck(Request $request)
    {
        $check = User::where('email', $request->email)->count();
        if ($check > 0){
            return response()->json('Email already exists!');
        }else{
            return response()->json('true');
        }
    }

    public function userPasswordUpdate(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required',
        ]);
        $check = User::where('id', auth()->id())->first();
        if (Hash::check($request->currentPassword, $check->password))
        {
            $hasMake = Hash::make($request->password);
            $check->update([
                'password' => $hasMake,
            ]);
            return redirect()->back()->with('success', 'Profile Password updated success');
        }else{
            return redirect()->back()->with('error', 'Password invalid');
        }


    }

    public function userPasswordChecked(Request $request)
    {

        $checkpassword = User::where('id', auth()->id())->first();

        if (Hash::check($request->password, $checkpassword->password))
        {
            return response()->json('true');
        }else{
            return response()->json('false');
        }

    }


}
