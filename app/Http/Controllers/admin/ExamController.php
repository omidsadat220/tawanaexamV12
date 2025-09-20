<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function AllExam() {
        $allData = Exam::with('exam')->get();


        return view('admin.backend.exam.all_exam' , compact('allData'));
    }
}
