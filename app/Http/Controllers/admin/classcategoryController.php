<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\classcategory;
use Illuminate\Http\Request;

class classcategoryController extends Controller
{
    public function AllClassCategory() {
        $classcateogry = classcategory::all();

        return view('admin.backend.class_category.all_class_category' , compact('classcateogry'));
    }

    //end method 

    public function AddClassCategory() {
        return view('admin.backend.class_category.add_class_category');
    }

    public function StoreClassCategory(Request $request) {
        classcategory::insert([
            'class_category' =>$request->class_category,
            'slug_name' => strtolower(str_replace(' ', '-', $request->class_category)),

        ]);

         $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.class.category');
    }
}
