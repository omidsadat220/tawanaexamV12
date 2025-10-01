<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $guarded = [];

    public function classcategory()
<<<<<<< HEAD
{
    return $this->belongsTo(ClassCategory::class, 'class_category_id', 'id');
}

public function category()
{
    return $this->belongsTo(ClassCategory::class, 'class_category_id');
}

   

       
=======
    {
        return $this->belongsTo(ClassCategory::class, 'class_category_id', 'id');
    }
>>>>>>> 952c8c6e9ead8a299ad8c2485ce07a00b593ad51
}
