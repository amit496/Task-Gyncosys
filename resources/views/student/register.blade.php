<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded mt-10">
        <h2 class="text-2xl font-bold mb-6 text-center">Student Registration</h2>
        <form action="{{ route('student.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold">First Name <span class="text-red-500">*</span></label>
                <input type="text" name="first_name" class="w-full border border-gray-300 rounded p-2 @error('first_name') border-red-500 @enderror" value="{{ old('first_name') }}">
                @error('first_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Last Name <span class="text-red-500">*</span></label>
                <input type="text" name="last_name" class="w-full border border-gray-300 rounded p-2 @error('last_name') border-red-500 @enderror" value="{{ old('last_name') }}">
                @error('last_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded p-2 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Mobile Number <span class="text-red-500">*</span></label>
                <input type="text" name="mobile" class="w-full border border-gray-300 rounded p-2 @error('mobile') border-red-500 @enderror" value="{{ old('mobile') }}">
                @error('mobile')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-semibold">Select Course <span class="text-red-500">*</span></label>
                <select name="course_id" class="w-full border border-gray-300 rounded p-2 @error('course_id') border-red-500 @enderror">
                    <option value="">Select a course</option>
                    @foreach ($courses as $key => $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                    @endforeach
                </select>
                @error('course_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Next
            </button>
        </form>
    </div>

</body>

</html>
