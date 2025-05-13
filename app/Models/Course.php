<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_name',
        'image',
        'course_brief',
        'fees',
    ];

    protected $dates = ['deleted_at'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->using(Enrollment::class)
                    ->withTimestamps();
    }

}
