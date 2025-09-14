<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $guarded = [];

    public function classcategory() {
        return $this->belongsTo(classcategory::class , 'classcategory_id');
    }

       
}
