<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded mt-10">
        <h2 class="text-2xl font-bold mb-4 text-center">Change Course</h2>

        <form action="{{ route('student.updateCourse') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="course_id" class="block mb-1 font-semibold">Select New Course</label>
                <select name="course_id" id="course_id" class="w-full border border-gray-300 rounded p-2">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ $student->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">⬅️ Back</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    🔄 Update Course
                </button>
            </div>
        </form>
    </div>
</body>
</html>
