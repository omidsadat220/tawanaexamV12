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

    //SubmitExam
    public function SubmitExam (Request $request){
    $userId = auth()->id() ?? 1; 
    foreach ($request->answers as $questionId => $answer) {
        $question = \App\Models\uni_answer_q::find($questionId);

        \App\Models\CorrectAns::create([
            'user_id' => $userId,
            'question' => $question->question,
            'correct_answer' => $answer,
        ]);
    }

    return redirect()->route('user.examresult');
    }
    //End Method

    //Start UserExamResult

    public function UserExamResult(){
         // Total questions answered
    $totalQuestions = CorrectAns::count();

    // Correct answers count
    $correct = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
        ->whereColumn('correct_ans.correct_answer', 'uni_answer_qs.correct_answer')
        ->count();

    // Wrong answers count
    $wrong = $totalQuestions - $correct;

    // Score percentage
    $score = $totalQuestions > 0 ? round(($correct / $totalQuestions) * 100, 2) : 0;

    // Wrong questions detail (for review section)
    $wrongQuestions = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
        ->whereColumn('correct_ans.correct_answer', '!=', 'uni_answer_qs.correct_answer')
        ->select(
            'uni_answer_qs.question',
            'uni_answer_qs.correct_answer as real_answer',
            'correct_ans.correct_answer as user_answer',
            'uni_answer_qs.question_one',
            'uni_answer_qs.question_two',
            'uni_answer_qs.question_three',
            'uni_answer_qs.question_four'
        )
        ->get();

    return view('user.uni.exam-result', compact(
        'totalQuestions',
        'correct',
        'wrong',
        'score',
        'wrongQuestions'
    ));

    }

    //UserCertificate
    public function UserCertificate(){
        return view('user.uni.certificate');
    }

}


