<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use App\Models\TeacherQuestion;
use Illuminate\Http\Request;

class QestionController extends Controller
{
    public function AllTeacherQestion() {
        $alldata = TeacherQuestion::with('subject')->get();

        return view('teacher.backend.qestion.all_teacher_qestion', compact('alldata'));
    }

    //end method 


    public function AddTeacherQestion() {
    $questions = TeacherQuestion::with('subject')->latest()->get();
    $subjects = DepartmentSubject::all();
    
    return view('teacher.backend.qestion.add_teacher_qestion', compact('questions', 'subjects'));
    }
}
