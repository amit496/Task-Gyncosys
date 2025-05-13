<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->using(Enrollment::class) // now Enrollment extends Pivot
                    ->withTimestamps();
    }

}
