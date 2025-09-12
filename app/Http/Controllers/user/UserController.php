<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function UserFinalexamdah()
    {
        return view('user.finalexamdash');
    }

    public function UserProfile()
    {
        $user = auth()->user();  
        return view('user.uprofile.userprofile', compact('user'));
    }

    public function UserEditprofile()
    {
        $user = Auth::user();
        return view('user.uprofile.usereditprofile', compact('user'));
    }


    public function UserProfileUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);

       
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            $avatarName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->photo = 'avatars/'.$avatarName; 
        }

        $user->save();

        return redirect()->route('user.uprofile.userprofile')
                        ->with('success', 'Profile updated successfully!');
    }



    public function UserChangepassword() {
            return view('user.uprofile.change-password');
        }

    public function UserPasswordUpdate(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with([
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.dashboard')->with([
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        ]);
    }





    public function UserUnicode(){
        return view('user.uni.unicode');
    }

    //Exam Page 
    public function UserUniexam($id){
        
        $category = Category::findOrFail($id);
        return view('user.uni.uniexam', compact('category'));
    }


    // userVaryfucode
    public function UserVarifyCode(Request $request){
       
    $request_code = $request->input('code');
   
    $category = Category::where('code', $request_code)->first();

    if ($category) {
       
        return redirect()->route('user.uniexam', ['id' => $category->id]);
    } else {
       
        return redirect()->back()->with('error', 'Invalid voucher code!');
    }
    }

}


