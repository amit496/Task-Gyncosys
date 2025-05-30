<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Http\Requests\Student\StudentRequest;
use Illuminate\support\Session;

class StudentController extends Controller
{
    public function showRegistrationForm()
    {
        $courses = Course::all();
        return view('student.register', compact('courses'));
    }

    public function storeStudentDetails(StudentRequest $request)
    {

        if ($request->session()->has('OldRegisterNO')) {
            $newRegNo = $request->session()->get('OldRegisterNO') + 1;
        } else {
            $newRegNo = 12490;
        }

        $request->session()->put('NewRegisterNO', $newRegNo);

        $course_id = $request->course_id;

        $student = new Student();
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->email = $request->input('email');
        $student->mobile = $request->input('mobile');

        if ($student->save()) {
            session()->put('student_data', $student);
            return redirect()->route('student.showCourse', ['course_id' => $course_id])
                             ->with('success', 'Registration successful');
        } else {
            return redirect()->back()
                             ->withErrors(['error' => 'Failed to save student data.'])
                             ->withInput();
        }
    }

    public function showCourseDetails($course_id)
    {
        $changeCourse = '';
        $course = Course::findOrFail($course_id);
        $student = session()->get('student_data');
        if(session()->get('changeCourse')){
            $changeCourse = session()->get('changeCourse');
        }
        return view('student.course-details', compact('course', 'student', 'changeCourse'));
    }

    public function changeCourse()
    {
        $student = session()->get('student_data');
        session()->put('changeCourse', 'Change');
        $courses = Course::all();
        return view('student.change-course', compact('courses','student'));
    }

    public function updateCourse(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = session()->get('student_data');
        $student->course_id = $request->course_id;
        session()->put('student_data', $student);

        return redirect()->route('student.showCourse', ['course_id' => $request->course_id])
                         ->with('success', 'Course updated successfully.');
    }

    public function showConfirmation(request $request)
    {
        $data = session('student_data');
        $course = Course::find($request->course_id);
        return view('student.confirm', compact('data', 'course'));
    }

    public function submitFinal(Request $request)
    {

        if (!isset($request->student_id) || !isset($request->course_id)) {
            return redirect()->route('student.register')->withErrors(['error' => 'Student data missing from session. Please register again.']);
        }

        $enrollCourse = new Enrollment();
        $enrollCourse->student_id = $request->student_id;
        $enrollCourse->course_id  = $request->course_id;

        if ($enrollCourse->save()) {
            session()->forget('student_data');
            return redirect()->route('student.thankyou');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to enroll student. Please try again.']);
        }
    }

    public function thankYou(Request $request)
    {
        $currentRegNo = $request->session()->get('NewRegisterNO');
        $request->session()->put('OldRegisterNO', $currentRegNo);
        session()->forget('changeCourse');
        return view('student.success', compact('currentRegNo'));
    }


}
