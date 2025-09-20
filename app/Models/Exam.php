<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
   protected $guarded = [];

 public function classSubjects() {
    return $this->hasMany(ClassSubject::class, 'class_category_id', 'class_category_id');
}

  public function classcategory()
{
    return $this->belongsTo(ClassCategory::class, 'class_category_id', 'id');
}


}

 