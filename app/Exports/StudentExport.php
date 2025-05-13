<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::with('courses')->get()->map(function ($student) {
            return [
                'first_name' => $student->first_name,
                'last_name'  => $student->last_name,
                'email'      => $student->email,
                'mobile'     => $student->mobile,
                'courses'    => $student->courses->pluck('course_name')->implode(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Mobile',
            'Courses',
        ];
    }
}
