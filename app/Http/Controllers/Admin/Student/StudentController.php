<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExport;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['courses' => function($query) {
            $query->select('courses.id', 'course_name');
        }]);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('mobile', 'LIKE', "%{$search}%")
                  ->orWhereHas('courses', function($courseQuery) use ($search) {
                      $courseQuery->where('course_name', 'LIKE', "%{$search}%");
                  });
            });
        }

        $students = $query->paginate(20)->withQueryString();

        return view('admin.student.index', compact('students'));
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'students.csv');
    }
}
