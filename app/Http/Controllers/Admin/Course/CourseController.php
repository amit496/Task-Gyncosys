<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Course\CourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{


    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('course_name', 'LIKE', "%{$search}%")
                ->orWhere('fees', 'LIKE', "%{$search}%");
            });
        }

        $courses = $query->orderBy('id', 'DESC')->paginate(5)->withQueryString();

        return view('admin.course.index', compact('courses'));
    }



    public function create($id = null)
    {
        $course = $id ? Course::findOrFail($id) : new Course();
        return view('admin.course.edit_update', compact('course'));
    }

    public function store(CourseRequest $request)
    {
        $image = $request->file('thumbnail');
        $image_rename = null;
        $file_path = public_path('/image/course/');
        $page = $request->input('page', 1); // Preserve page number

        if ($image) {
            $image_rename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
        }

        if ($request->input('course_id')) {
            $course = Course::find($request->input('course_id'));

            if ($course) {
                $course->course_name = $request->input('course_name');
                $course->course_brief = $request->input('course_description');
                $course->fees = $request->input('course_fees');
                if ($image_rename) {
                    $course->image = '/image/course/' . $image_rename;
                }

                if ($course->update()) {
                    if ($image_rename) {
                        $image->move($file_path, $image_rename);
                    }
                    return redirect()->route('course.list', ['page' => $page])
                                    ->with('success', 'Course updated successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to update course.');
                }
            } else {
                return redirect()->back()->with('error', 'Course not found.');
            }
        } else {
            $course = new Course;
            $course->course_name = $request->input('course_name');
            $course->course_brief = $request->input('course_description');
            $course->fees = $request->input('course_fees');
            if ($image_rename) {
                $course->image = '/image/course/' . $image_rename;
            }

            if ($course->save()) {
                if ($image_rename) {
                    $image->move($file_path, $image_rename);
                }
                return redirect()->route('course.list', ['page' => $page])
                                ->with('success', 'Course added successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to add course.');
            }
        }
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');
            $course = Course::findOrFail($id);

            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }

            $course->delete();

            return response()->json([
                'status' => true,
                'message' => 'Course deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting course: '.$e->getMessage()
            ], 500);
        }
    }
}
