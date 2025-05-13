<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirm Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <div class="max-w-xl mx-auto bg-white shadow-md p-6 rounded mt-10">
    <h2 class="text-2xl font-bold mb-4 text-center">Confirm Your Details</h2>
    <ul class="mb-6 space-y-2 text-gray-700">
      <li><strong>First Name:</strong> {{$data->first_name}}</li>
      <li><strong>Last Name:</strong> {{$data->last_name}} </li>
      <li><strong>Email:</strong> {{$data->email}}</li>
      <li><strong>Mobile:</strong> {{$data->mobile}}</li>
      <li><strong>Course:</strong> {{$course->course_name}}</li>
      <li><strong>Fees:</strong> ₹ {{$course->fees}} </li>
    </ul>

    <form action="{{ route('student.enroll') }}" method="POST">
        @csrf

        <input type="hidden" name="student_id" id="student_id" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $data->id }}" @readonly(true)>
        <input type="hidden" name="course_id" id="course_id" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ $course->id }}" @readonly(true)>

        <button class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Confirm & Submit
        </button>
    </form>
  </div>

</body>
</html>
