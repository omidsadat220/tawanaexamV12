<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use App\Models\TeacherQuestion;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

    //end method 

    public function StoreTeacherQestion(Request $request) {
        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img->resize(100,90)->save(public_path('upload/teacher/qestion/'.$name_gen));
           $save_url = 'upload/teacher/qestion/'.$name_gen;

           TeacherQuestion::create([
                'subject_id' => $request->subject_id,
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
                'image' => $save_url
           ]);
           
              $notification = array(
                'message' => 'qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.teacher.qestion')->with($notification);
        }
        else{
             TeacherQuestion::create([
                'subject_id' => $request->subject_id,
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
           ]);
           
              $notification = array(
                'message' => 'qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.teacher.qestion')->with($notification);
        }
    }

    //end method 

    public function EditTeacherQestion($id) {
        $editData = TeacherQuestion::findOrFail($id);
        $subjects = DepartmentSubject::all();
        return view('teacher.backend.qestion.edit_teacher_qestion', compact('editData', 'subjects'));
    }

    //end method

    public function UpdateTeacherQestion(Request $request) {

       $qestion = TeacherQuestion::findOrFail($request->id);

    $data = [
        'subject_id'     => $request->subject_id,
        'question'       => $request->question,
        'option1'        => $request->option1,
        'option2'        => $request->option2,
        'option3'        => $request->option3,
        'option4'        => $request->option4,
        'correct_answer' => $request->correct_answer,
    ];

    // Handle image upload
    if ($request->file('image')) {
        $image = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(100, 90)->save(public_path('upload/qestion/' . $name_gen));
        $save_url = 'upload/qestion/' . $name_gen;

        // Delete old image if exists
        if ($qestion->image && file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }

        $data['image'] = $save_url;
    }

    $qestion->update($data);

    $notification = [
        'message'    => 'Question Updated Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.teacher.qestion')->with($notification);
    }

    //end method

    public function DeleteTeacherQestion($id) {
        $qestion = TeacherQuestion::findOrFail($id);
        if (file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }
        $qestion->delete();

        $notification = array(
            'message' => 'qestion Deleted Successfully',
            'alert-type' => 'success'
          );

            return redirect()->route('all.teacher.qestion')->with($notification);
    }
}
