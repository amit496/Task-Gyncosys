<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Course Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded mt-10">
        <h2 class="text-2xl font-bold mb-4">Laravel Basics</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($course && file_exists(public_path($course->image)))
            <img src="{{ asset($course->image) }}" alt="{{ $course->course_name }}" class="w-20 h-20 object-cover rounded-full">
        @else
            <img src="{{ asset('placeholder.png') }}" alt="Placeholder" class="w-20 h-20 object-cover rounded-full">
        @endif

        <p class="text-gray-700 mb-2">{{$course->course_name}}</p>
        <p class="text-gray-700 mb-2">{{$course->course_brief}}</p>
        <p class="text-lg font-semibold mb-6">Fees: {{$course->fees}}</p>
        <!-- Form -->
        <form action="{{ route('student.confirm') }}" method="POST">
            @csrf

            <input type="hidden" name="student_id" id="student_id" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $student->id }}" @readonly(true)>
            <input type="hidden" name="course_id" id="course_id" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $course->id }}" @readonly(true)>
            <!-- Name Input -->
            @if(!$changeCourse)
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $student->first_name .  ' ' . $student->last_name }}" @readonly(true)>
                    @error('name')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $student->email }}" @readonly(true)>
                    @error('email')
                        <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="flex justify-between">
                <a href="{{ route('student.changeCourse') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">🔄 Change Course</a>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    ✅ Buy Now
                </button>
            </div>
        </form>
    </div>

</body>

</html>
