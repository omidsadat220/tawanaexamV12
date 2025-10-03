<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\User;
use App\Models\SetClassStudent;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class StudentController extends Controller
{
   public function AllStudent()
    {
        $students = User::where('role', 'user')->get();
        return view('teacher.backend.student.manage_student', compact('students'));
    }

    public function SetClass($id) {
            $student = User::find($id);
            $department = department::latest()->get();
            return view('teacher.backend.student.set_class',compact('student','department'));
    } 

    public function StoreSetClass(Request $request){
        SetClassStudent::create([
            'user_id' => $request->user_id,
            'department_id' => $request->department_id,
        ]);
        return redirect()->route('manage.student');
    }  
}
