<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
   protected $guarded = [];

public function department()
{
    return $this->belongsTo(Department::class, 'department_id'); 
}

public function subject()
{
    return $this->belongsTo(DepartmentSubject::class, 'subject_id');
}
}
