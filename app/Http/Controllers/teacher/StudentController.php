<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function AllStudent()
{
    $students = User::where('role', 'user')->get();

    return view('teacher.backend.student.manage_student', compact('students'));
}
}
