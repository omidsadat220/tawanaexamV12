<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classcategory extends Model
{
    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany(ClassSubject::class, 'ClassSubject_id');
    }
}
