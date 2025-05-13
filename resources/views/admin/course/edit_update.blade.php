@extends('admin.layout.index')

@section('content')

    @include('admin.course.breadcrub')

    <div class="box">
        <div class="box-header flex justify-between items-center flex-wrap gap-4">
            <div class="w-full sm:w-auto">
                <div class="relative">
                   <h3>
                    @if($course->id)
                        Edit Course
                    @else
                        Add Course
                    @endif
                   </h3>
                </div>
            </div>
            <div class="w-full sm:w-auto">
                <a id="add-course-btn" href="{{ route('course.list') }}" class="hs-dropdown-toggle py-2 px-3 ti-btn ti-btn-danger w-full">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('course.store') }}" id="course-form" class="w-full space-y-5"
                  enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="course_id" id="course_id" value="{{ old('course_id', $course->id) }}">
                <input type="hidden" name="page" value="{{ request('page', 1) }}">

                {{-- Course Name --}}
                <div class="w-full">
                    <label for="course_name" class="ti-form-label">Course Name <span class="text-red-500">*</span></label>
                    <input type="text" name="course_name" id="course_name" class="ti-form-input w-full @error('course_name') is-invalid @enderror" placeholder="Enter course name" value="{{ old('course_name', $course->course_name) }}" autofocus @required(true) maxlength="255">
                    <span class="text-red-500 text-sm mt-1 block error-message" id="course_name_error">
                        @error('course_name') {{ $message }} @enderror
                    </span>
                </div>

                {{-- Course Description --}}
                <div class="w-full">
                    <label for="course_description" class="ti-form-label">Description <span class="text-red-500">*</span></label>
                    <textarea name="course_description" id="course_description" class="ti-form-input w-full @error('course_description') is-invalid @enderror" rows="3" placeholder="Enter course description" @required(true) maxlength="1000">{{ old('course_description', $course->course_brief) }}</textarea>
                    <span class="text-red-500 text-sm mt-1 block error-message" id="course_description_error">
                        @error('course_description') {{ $message }} @enderror
                    </span>
                </div>

                {{-- Course Fees --}}
                <div class="w-full">
                    <label for="course_fees" class="ti-form-label">Fees <span class="text-red-500">*</span></label>
                    <input type="number" name="course_fees" id="course_fees"
                           class="ti-form-input w-full @error('course_fees') is-invalid @enderror"
                           placeholder="Enter course fees" step="0.01"
                           value="{{ old('course_fees', $course->fees) }}">
                    <span class="text-red-500 text-sm mt-1 block error-message" id="course_fees_error">
                        @error('course_fees') {{ $message }} @enderror
                    </span>
                </div>

                {{-- Course Thumbnail --}}
                <div class="w-full">
                    <label for="thumbnail" class="ti-form-label">Thumbnail
                        @if (!isset($course->id)) <span class="text-red-500">*</span> @endif
                    </label>
                    <input type="file" name="thumbnail" id="thumbnail"
                           class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-white/70
                           file:border-0 file:bg-gray-100 ltr:file:mr-4 rtl:file:ml-4 file:py-2 file:px-4
                           dark:file:bg-black/20 dark:file:text-white/70 @error('thumbnail') is-invalid @enderror"
                           accept="image/*">
                    <span class="text-red-500 text-sm mt-1 block error-message" id="thumbnail_error">
                        @error('thumbnail') {{ $message }} @enderror
                    </span>
                </div>

                {{-- Submit --}}
                <div class="w-full text-right">
                    <button type="submit" class="ti-btn ti-btn-primary">Save Course</button>
                </div>
            </form>
        </div>

    </div>
@endsection
