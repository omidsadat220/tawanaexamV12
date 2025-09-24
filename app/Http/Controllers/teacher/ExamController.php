<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\DepartmentSubject;
use App\Models\TeacherExam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function AllTeacherExam() {
        $departments = department::with(['subjects', 'subjects.exams'])->get();
        $exams = TeacherExam::with(['department', 'subject'])->get();

        return view('teacher.backend.teacher_exam.all_teacher_exam', compact('departments', 'exams'));
    }

      public function AddTeacherExam()
    {
        $depart = Department::all();
        $firstDepartId = Department::first()->id ?? null;
        $subjects = DepartmentSubject::where('department_id', $firstDepartId)->get();

        return view('teacher.backend.teacher_exam.add_teacher_exam', compact('depart', 'subjects'));
    }

    public function StoreTeacherExam(Request $request)
    {

        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'subject_id' => 'required|exists:department_subjects,id',
            'exam_title' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i'
        ]);


        TeacherExam::create([
            'department_id' => $request->department_id,
            'subject_id' => $request->subject_id,
            'exam_title' => $request->exam_title,
            'start_time' => $request->start_time
        ]);

        $notification = [
            'message' => 'Exam Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.teacher.exam')->with($notification);
    }

     public function EditTeacherExam($id)
    {
        $exam = TeacherExam::with(['department', 'subject'])->findOrFail($id);

        $departments = Department::with(['subjects', 'subjects.exams'])->get();

        $subjects = $exam->department ? $exam->department->subjects : collect();

        return view('teacher.backend.teacher_exam.edit_teacher_exam', compact('exam', 'departments', 'subjects'));
    }

}
