<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classcategory extends Model
{
    protected $guarded = [];

<<<<<<< HEAD
public function classSubjects()
{
    return $this->hasMany(ClassSubject::class, 'class_category_id', 'id');
}

// ClassSubject.php

=======
    public function subjects()
    {
        return $this->hasMany(ClassSubject::class, 'ClassSubject_id');
    }
>>>>>>> 952c8c6e9ead8a299ad8c2485ce07a00b593ad51
}
