<div class="block justify-between page-header sm:flex">
    <div>
        <h3 class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-white text-2xl font-medium">
            Courses
        </h3>
    </div>
    <ol class="flex items-center whitespace-nowrap min-w-0">
        <li class="text-sm">
            <a class="flex items-center font-semibold text-primary hover:text-primary dark:text-primary truncate"
               href="{{ route('dashboard') }}">
                Dashboard
                <i class="ti ti-chevrons-right flex-shrink-0 mx-3 overflow-visible text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
            </a>
        </li>

        @if (Request::routeIs('course.list'))
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70" aria-current="page">
                Course List
            </li>
        @elseif (Request::routeIs('course.create'))
            <li class="text-sm">
                <a href="{{ route('course.list') }}" class="text-primary hover:text-primary dark:text-white/70">
                    Course List
                </a>
                <i class="ti ti-chevrons-right mx-3 text-gray-300 dark:text-gray-300 rtl:rotate-180"></i>
            </li>
            <li class="text-sm text-gray-500 hover:text-primary dark:text-white/70" aria-current="page">
                Create Course
            </li>
        @endif
    </ol>
</div>
