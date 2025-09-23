<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentSubject;
use App\Models\qestion;
use Illuminate\Http\Request;

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
}
