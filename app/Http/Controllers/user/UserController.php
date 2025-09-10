<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserDashboard()
    {
        return view('user.dashboard');
    }

     public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function UserFinalexamdah(){
        return view('user.finalexamdash');
    }

    public function UserProfile(){
        return view('user.userprofile');
    }

    public function UserUnicode(){
        return view('user.uni.unicode');
    }

    public function UserUniexam(){
        return view('user.uni.uniexam');
    }

}


