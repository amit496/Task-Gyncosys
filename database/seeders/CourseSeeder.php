<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [];

        for ($i = 1; $i <= 25; $i++) {
            $courses[] = [
                'course_name' => "Course $i",
                'course_brief' => "This is a detailed description for Course $i. Learn various skills and techniques.",
                'fees' => rand(3000, 20000),
                'image' => 'default.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Course::insert($courses);
    }
}
