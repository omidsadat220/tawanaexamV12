<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CorrectAns;
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

    //Exam Page 
    public function UserUniexam($id){
        
        $category = Category::findOrFail($id);
        return view('user.uni.uniexam', compact('category'));
    }

    public function UpdateExam(Request $request) {

         $cat_id = $request->cat_id;
 
    $correct = CorrectAns::findOrFail($request->cat_id);

    $correct->update([
        'question' => $request->question,
        'correct_answer' => $request->correct_answer,
    ]);

        $notification = [
        'message' => 'Answer Add  Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->back()->with($notification);


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


