<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\classcategory;
use App\Models\ClassSubject;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function AllExam() {
        $allData = Exam::with('ClassSubjects')->get();

        $categories = classcategory::all();


        return view('admin.backend.exam.all_exam' , compact('allData' , 'categories'));
    }

  public function AddExam() {
    // All exams with their subjects (for listing)
    $allData = Exam::with('classSubjects')->get();

    $categories = classcategory::all();

    // All subjects (for dropdown)
    $ClassSubjects = ClassSubject::all();

    return view('admin.backend.exam.add_exam', compact('allData', 'ClassSubjects' , 'categories'));
}


    //end method

    public function StoreExam(Request $request) {

         $request->validate([
        'exam_name' => 'required',
        'class_category_id'      => 'required',
    ]);

    Exam::create([
        'class_category_id' => $request->class_category_id,
        'class_subject_id' => $request->class_subject_id,
        'exam_name' => $request->exam_name,
        'time' => $request->time,
    ]);

    return redirect()->route('all.exam')->with([
        'message' => 'Subjects Inserted Successfully',
        'alert-type' => 'success'
    ]);


    }

}
