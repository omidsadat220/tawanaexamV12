<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\uni_answer_q;
use Illuminate\Http\Request;

class Uni_answer_qController extends Controller
{
    public function AllAnswer() {
        $allData = uni_answer_q::with('uni_answer_q.category');
        return view('admin.backend.answer.all_answer' , compact('allData'));
    }
}
