<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use App\Models\qestion;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class qestioncontroller extends Controller
{
    public function AllQestion() {
        $alldata = qestion::with(['subject'])->get();

        return view('admin.backend.qestion.all_qestion', compact('alldata'));
    }

    //end method 

    public function AddQestion()
{
    $questions = qestion::with('subject')->latest()->get();
    $subjects = DepartmentSubject::all();
    
    return view('admin.backend.qestion.add_qestion', compact('questions', 'subjects'));
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

                return redirect()->route('all.qestion')->with($notification);
        }
        else{
             qestion::create([
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

                return redirect()->route('all.qestion')->with($notification);
        }
    }

    //end method

    public function EditQestion($id) {
        $editData = qestion::findOrFail($id);
        $subjects = DepartmentSubject::all();
        return view('admin.backend.qestion.edit_qestion', compact('editData', 'subjects'));
    }
    //end method

    public function UpdateQestion(Request $request) {


        $qestion_id = $request->id;
        $qestion = qestion::find($qestion_id);

        if ($request->file('image')) {
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $img = $manager->read($image);
           $img->resize(100,90)->save(public_path('upload/qestion/'.$name_gen));
           $save_url = 'upload/qestion/'.$name_gen;

           if (file_exists(public_path($qestion->image))) {
             @unlink(public_path($qestion->image));
           }

           qestion::find($qestion_id)->update([
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

                return redirect()->route('all.qestion')->with($notification);

            }

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
