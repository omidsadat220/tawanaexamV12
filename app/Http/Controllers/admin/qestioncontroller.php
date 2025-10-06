<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use App\Models\Exam;
use App\Models\qestion;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Container\Attributes\Auth;

class qestioncontroller extends Controller
{
    public function AllQestion() {
        $alldata = qestion::with(['exam'])->get();
        return view('admin.backend.qestion.all_qestion', compact('alldata' , ));
    }

    //end method 

    public function AddQestion()
{
    $questions = qestion::with('exam')->latest()->get();
    $exams = Exam::all();
    
    return view('admin.backend.qestion.add_qestion', compact('questions', 'exams' , ));
}

    //end method 

    public function StoreQestion(Request $request) {
          if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img->resize(100,90)->save(public_path('upload/qestion/'.$name_gen));
           $save_url = 'upload/qestion/'.$name_gen;

           qestion::create([
                'exam_id' => $request->exam_id,
                'user_id' => auth()->id(),
                'question' => $request->question,
                'option1' => $request->option1,
                'option2' => $request->option2,
                'option3' => $request->option3,
                'option4' => $request->option4,
                'correct_answer' => $request->correct_answer,
                'image' => $save_url,

           ]);
           
              $notification = array(
                'message' => 'qestion Inserted Successfully',
                'alert-type' => 'success'
              );

                return redirect()->route('all.qestion')->with($notification);
        }
        else{
             qestion::create([
                'exam_id' => $request->exam_id,
                'user_id' => auth()->id(),
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

                return redirect()->route('all.qestion')->with($notification);
        }
    }

    //end method

    public function EditQestion($id) {
        $editData = qestion::findOrFail($id);
        $exams = Exam::all();
        return view('admin.backend.qestion.edit_qestion', compact('editData', 'exams'));
    }
    //end method

public function UpdateQestion(Request $request)
{
    $qestion_id = $request->id;
    $qestion = qestion::findOrFail($qestion_id);

    if ($request->file('image')) {
        $image = $request->file('image');
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $img = $manager->read($image);
        $img->resize(100, 90)->save(public_path('upload/qestion/' . $name_gen));
        $save_url = 'upload/qestion/' . $name_gen;

        if (file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }

        $qestion->update([
            'exam_id' => $request->exam_id,
            'user_id' => auth()->id(),
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
            'image' => $save_url,
        ]);
    } else {
        // 🔹 این بخش برای زمانی است که عکس جدید انتخاب نشده
        $qestion->update([
            'exam_id' => $request->exam_id,
            'user_id' => auth()->id(),
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_answer' => $request->correct_answer,
        ]);
    }

    $notification = [
        'message' => 'Question Updated Successfully',
        'alert-type' => 'success',
    ];

    return redirect()->route('all.qestion')->with($notification);
}


    //end method 

    public function DeleteQestion($id) {
        $qestion = qestion::findOrFail($id);
        if (file_exists(public_path($qestion->image))) {
            @unlink(public_path($qestion->image));
        }
        $qestion->delete();

        $notification = array(
            'message' => 'qestion Deleted Successfully',
            'alert-type' => 'success'
          );

            return redirect()->route('all.qestion')->with($notification);
    }

}
