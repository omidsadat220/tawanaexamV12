<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CorrectAns;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\qestion;
use App\Models\UserAnswer;
use App\Models\SetClassStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\uni_answer_q;

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
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $user->photo = 'avatars/' . $avatarName;
        }

        $user->save();

        return redirect()->route('user.uprofile.userprofile')
            ->with('success', 'Profile updated successfully!');
    }



    public function UserChangepassword()
    {
        return view('user.uprofile.change-password');
    }

    public function UserPasswordUpdate(Request $request)
    {
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





    public function UserUnicode()
    {
        return view('user.uni.unicode');
    }

    //Exam Page
    public function UserUniexam($id)
    {

        $category = Category::findOrFail($id);
        return view('user.uni.uniexam', compact('category'));
    }

    public function UpdateExam(Request $request)
    {

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
    public function UserVarifyCode(Request $request)
    {

        $request_code = $request->input('code');

        $category = Category::where('code', $request_code)->first();

        if ($category) {

            return redirect()->route('user.uniexam', ['id' => $category->id]);
        } else {

            return redirect()->back()->with('error', 'Invalid voucher code!');
        }
    }

    //SubmitExam
    public function SubmitExam(Request $request)
    {
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

    public function UserExamResult()
    {
        $userId = Auth::id(); // current logged in user id

        // Total questions answered by this user
        $totalQuestions = CorrectAns::where('user_id', $userId)->count();

        // Correct answers count
        $correct = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
            ->where('correct_ans.user_id', $userId)
            ->whereColumn('correct_ans.correct_answer', 'uni_answer_qs.correct_answer')
            ->count();

        // Wrong answers count
        $wrong = $totalQuestions - $correct;

        // Score percentage
        $score = $totalQuestions > 0 ? round(($correct / $totalQuestions) * 100, 2) : 0;

        // Wrong questions detail (for review section)
        $wrongQuestions = CorrectAns::join('uni_answer_qs', 'correct_ans.question', '=', 'uni_answer_qs.question')
            ->where('correct_ans.user_id', $userId)
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
    public function UserCertificate()
    {
        return view('user.uni.certificate');
    }


    ////////////////////////////
    public function MockExam(){
        // $user_id = Auth::user()->id;
        // $set_class = SetClassStudent::all();
        // $department = department::all();
        // $department_subject = DepartmentSubject::all();
        $user_id = Auth::id();
             // Get the set_class record for this user
             $set_class = SetClassStudent::where('user_id', $user_id)
                ->with('department.subjects') // eager load department and its subjects
                ->first();
        return view('user.mock.mock_exam', compact('set_class'));
    }

    public function ListExam($id){
         $user_id = Auth::id();

    // Optional: check if the user belongs to the department
    $set_class = SetClassStudent::where('user_id', $user_id)->first();

    if(!$set_class) {
        return redirect()->back()->with('error', 'You are not assigned to any department.');
    }

    $subject = DepartmentSubject::where('id', $id)
                ->where('department_id', $set_class->department_id)
                ->firstOrFail();

    $exams = Exam::where('subject_id', $id)->get();

         return view('user.mock.list_exam', compact('subject', 'exams'));
    }


    // MockExamStart


    public function MockExamStart($id){

    $user_id = Auth::id();

    // Get the exam
    $exam = Exam::findOrFail($id);

    // Get all questions for this exam
    $questions = qestion::where('exam_id', $id)->get();

        return view('user.mock.start_exam', compact('exam', 'questions'));
    }

    //MockExamSubmit

    public function MockExamSubmit (Request $request, $exam_id){
$exam = Exam::findOrFail($exam_id);

    foreach($request->answers as $question_id => $selected) {
        $question = qestion::find($question_id);

        UserAnswer::create([
            'user_id' => Auth::id(),
            'exam_id' => $exam->id,
            'question_id' => $question_id,
            'department_id' => $exam->department_id,
            'uni_id' => $exam->uni_id ?? null, // if your exam has uni_id
            'selected_answer' => $selected,
            'correct_answer' => $question->correct_answer,
        ]);
    }
     return redirect()->route('mock.exam.results', $exam->id)
                     ->with('success', 'Your exam has been submitted successfully!');

    // return redirect()->back();

    }

         public function examResults($exam_id)
        {
          $exam = Exam::findOrFail($exam_id);

    // get latest attempt of this user for this exam
    $latestAttempt = UserAnswer::where('exam_id', $exam_id)
        ->where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->first();

    if (!$latestAttempt) {
        return redirect()->back()->with('error', 'No answers found for this exam.');
    }

    // get all answers created at the same time (that one attempt)
    $userAnswers = UserAnswer::where('exam_id', $exam_id)
        ->where('user_id', Auth::id())
        ->whereDate('created_at', $latestAttempt->created_at->toDateString())
        ->whereTime('created_at', $latestAttempt->created_at->format('H:i:s'))
        ->get();

    return view('user.mock.exam_results', compact('exam', 'userAnswers', 'latestAttempt'));
        }
}
