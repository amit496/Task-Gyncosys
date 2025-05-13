@extends('admin.layout.index')

@section('content')
    @include('admin.course.breadcrub')

    <!-- Success & Error Messages -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="box">
        <div class="box-header flex justify-between items-center flex-wrap gap-4">

            <!-- Search Form -->
            <div class="w-full sm:w-auto">
                <form method="GET" action="{{ route('course.list') }}" class="flex flex-wrap gap-2 items-center mt-2">
                    <input type="text" name="search" placeholder="Search by name or fees"
                        value="{{ request('search') }}"
                        class="border border-gray-300 px-3 py-2 rounded w-full sm:w-64">

                    <!-- Submit Button -->
                    <button type="submit" class="ti-btn-primary text-white px-4 py-2 rounded hover:ti-btn-primary">
                        Submit
                    </button>

                    <!-- Reset Button -->
                    <a href="{{ route('course.list') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Reset
                    </a>
                </form>
            </div>

            <!-- Add Course Button -->
            <div class="w-full sm:w-auto">
                <a href="{{ route('course.create') }}" class="hs-dropdown-toggle py-2 px-3 ti-btn ti-btn-primary w-full">
                    <i class="ti ti-circle-plus"></i> Add New Course
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="box-body overflow-x-auto mt-4">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Course Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Fees</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y">
                        @foreach ($courses as $index => $course)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $index + 1 + ($courses->currentPage() - 1) * $courses->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($course && file_exists(public_path($course->image)))
                                        <img src="{{ asset($course->image) }}" alt="{{ $course->course_name }}" class="w-20 h-20 object-cover rounded-full">
                                    @else
                                        <img src="{{ asset('placeholder.png') }}" alt="Placeholder" class="w-20 h-20 object-cover rounded-full">
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $course->course_name }}</td>
                                <td class="px-6 py-4">{{ Str::limit($course->course_brief, 50) }}</td>
                                <td class="px-6 py-4">{{ $course->fees ? number_format($course->fees, 2) : 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('course.create', ['id' => $course->id, 'page' => $courses->currentPage()]) }}"
                                        class="edit-course ti-btn ti-btn-primary ti-btn-sm mr-2">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <button type="button" class="delete-btn ti-btn ti-btn-danger ti-btn-sm"
                                        data-id="{{ $course->id }}">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-end items-center flex-wrap gap-4">
                <nav role="navigation" aria-label="Pagination Navigation" class="w-full">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div class="hidden"></div> <!-- hide "Showing x to y of z results" -->
                        <div>
                            {{ $courses->links('pagination::tailwind') }}
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const courseId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteCourse(courseId);
                        }
                    });
                });
            });

            function deleteCourse(id) {
                fetch("{{ route('course.delete') }}", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        Swal.fire('Deleted!', data.message, 'success')
                            .then(() => {
                                location.reload();
                            });
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                });
            }
        });
    </script>
@endsection

@section('css')
    <style>
        nav[role="navigation"] p.text-sm {
            display: none !important;
        }
    </style>
@endsection
