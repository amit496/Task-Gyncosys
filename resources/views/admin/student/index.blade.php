@extends('admin.layout.index')

@section('content')

    @include('admin.student.breadcrub')

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
    <div class="w-full sm:w-auto flex flex-wrap sm:flex-nowrap items-center gap-2 mt-2">
        <form method="GET" action="{{ route('student.list') }}" class="flex flex-wrap sm:flex-nowrap gap-2 items-center w-full sm:w-auto">
            <input type="text" name="search" placeholder="Search by name, email or course"
                value="{{ request('search') }}"
                class="border border-gray-300 px-3 py-2 rounded w-full sm:w-64">

            <button type="submit" class="ti-btn-primary text-white px-4 py-2 rounded hover:ti-btn-primary">
                Search
            </button>

            <a href="{{ route('student.list') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Reset
            </a>
        </form>

        <!-- Export Button -->
        <a href="{{ route('student.export') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 sm:ml-4 w-full sm:w-auto text-center">
            Export CSV
        </a>
    </div>
</div>


        <div class="box-body overflow-x-auto mt-4">
            <div class="table-responsive">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium">Courses</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y">
                        @forelse ($students as $index => $student)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $index + 1 + ($students->currentPage() - 1) * $students->perPage() }}
                                </td>
                                <td class="px-6 py-4">{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td class="px-6 py-4">{{ $student->email }}</td>
                                <td class="px-6 py-4">{{ $student->mobile }}</td>
                                <td class="px-6 py-4">
                                    @forelse ($student->courses as $course)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded mr-1 mb-1">
                                            {{ $course->course_name }}
                                        </span>
                                    @empty
                                        N/A
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-end items-center flex-wrap gap-4">
                <nav role="navigation" aria-label="Pagination Navigation" class="w-full">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div class="hidden"></div> <!-- hide "Showing x to y of z results" -->
                        <div>
                            {{ $students->links('pagination::tailwind') }}
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        nav[role="navigation"] p.text-sm {
            display: none !important;
        }
    </style>
@endsection
