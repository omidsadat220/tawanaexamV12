<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\DepartmentSubject;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
     public function AllDepart() {
        $departments = Department::with('subjects')->get();
        return view('admin.backend.department.all_depart', compact('departments'));
    }


    public function AddDepart() {
        return view('admin.backend.department.add_depart');
    }


    public function StoreDepart(Request $request)
        {
            $request->validate([
                'depart_name' => 'required|string|max:255',
                'depart_subjects' => 'required|array|min:1',
                'depart_subjects.*' => 'required|string|max:255'
            ]);

            $department = Department::create([
                'depart_name' => $request->depart_name
            ]);

            foreach ($request->depart_subjects as $subject) {
                DepartmentSubject::create([
                    'department_id' => $department->id,
                    'subject_name' => $subject
                ]);
            }

            return redirect()->back()->with('success', 'Department and subjects saved!');
        }

    //end method


        public function EditDepart($id) {
            $depart = Department::with('subjects')->findOrFail($id);
            return view('admin.backend.department.edit_depart', compact('depart'));
        }
    //end method
public function UpdateDepart(Request $request, $id) {
    $request->validate([
        'depart_name' => 'required|string|max:255',
        'depart_subjects' => 'required|array|min:1',
        'depart_subjects.*' => 'required|string|max:255'
    ]);

    $department = Department::findOrFail($id);
    $department->update([
        'depart_name' => $request->depart_name,
    ]);

    // Get current subjects from DB
    $existingSubjects = $department->subjects->pluck('subject_name', 'id')->toArray();

    // Track subjects we want to keep
    $newSubjectIds = [];

    foreach ($request->depart_subjects as $subjectName) {
        // Try to find if subject already exists
        $subject = $department->subjects()->where('subject_name', $subjectName)->first();

        if ($subject) {
            // Keep the old subject (and its ID, so exams stay linked)
            $newSubjectIds[] = $subject->id;
        } else {
            // Create new subject
            $newSubject = $department->subjects()->create([
                'subject_name' => $subjectName
            ]);
            $newSubjectIds[] = $newSubject->id;
        }
    }

    // Optionally delete subjects not in the updated list
    $department->subjects()->whereNotIn('id', $newSubjectIds)->delete();

    $notification = [
        'message' => 'Department Updated Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('all.depart')->with($notification);
}




    public function DeleteDepart($id) {
        department::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Department Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.depart')->with($notification);
    }
}
