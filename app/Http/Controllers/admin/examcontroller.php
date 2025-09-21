<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class examcontroller extends Controller
{

public function AllExam() {
    $departments = Department::with(['subjects', 'subjects.exams'])->get();
    $exams = Exam::with(['department', 'subject'])->get(); // Add this line
    
    return view('admin.backend.exam.all_exam', compact('departments', 'exams'));
}

   public function AddExam()
{
    $depart = Department::all();
    $firstDepartId = Department::first()->id ?? null;
   
    $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();
    return view('admin.backend.exam.add_exam', compact('depart', 'subjects'));
}

public function StoreExam(Request $request) {

                $validated = $request->validate([
                'department_id' => 'required|exists:departments,id',
                'subject_id' => 'required|exists:department_subjects,id',
                'exam_title' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i'
            ]);


            Exam::create([
                'department_id' => $request->department_id,
                'subject_id' => $request->subject_id,
                'exam_title' => $request->exam_title,
                'start_time' => $request->start_time
            ]);

                 $notification = [
                'message' => 'Exam Created Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.exam')->with($notification);

}

}
